<?php

namespace App\Controllers\Core;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->response = \CodeIgniter\Config\Services::response();
        helper(['framework', 'projeto']);
    }

    /**
     * Verifica se o usuário está logado
     *
     * @return boolean
     */
    protected function isLogged()
    {
        return getCurrentUser() !== false;
    }

    /**
     * Recupera de maneira formatada as opções de listagem da API
     *
     * @param int $segment Indica o segmento da url que contém a página atual
     * @return array
     */
    protected function browserOptions(?int $segment = 4)
    {
        $currentPage = (int) $this->request->uri->getSegment($segment);
        $perPage = (int) $this->request->getPost('perPage');
        if ($perPage < 5) {
            $perPage = 5;
        } elseif ($perPage > 50) {
            $perPage = 50;
        }
        $select = explode(',', $this->request->getPost('select'));
        if (!empty($select)) {
            foreach ($select as &$cam) {
                $cam = filter_var($cam, FILTER_SANITIZE_STRING);
            }
        }
        $options = [
            'select' => $select,
            'segment' => $segment,
            'searchAny' => esc($this->request->getPost('searchAny')),
            'searchColumns' => esc($this->request->getPost('searchColumns')),
            'orderBy' => esc($this->request->getPost('orderBy')),
            'currentPage' => $currentPage > 0 ? $currentPage : 1,
            'perPage' => $perPage,
            'distinct' => false,
        ];
        return $options;
    }

    /**
     * Formata o retorno de opções para listagem
     *
     * @param array $details Resultado do pager
     * @param array $options Opções iniciais
     * @return array
     */
    protected function browserOptionsOutput(array $details, array $options)
    {
        unset($options['segment']);
        unset($options['select']);
        return array_merge($options, [
            'total' => $details['total'],
            'perPage' => $details['perPage'],
            'pageCount' => $details['pageCount'],
            'currentPage' => $details['currentPage'],
            'links' => $details['links'],
        ]);
    }

    /**
     * Faz a listagem de dados com base na Model, Opções e condições estabelecidas
     *
     * @param \App\Models\Core\DefaultModel $model
     * @param array|null $options
     * @param array|null $whereAdc
     * @return array
     */
    protected function browserGetData($model, ?array $options = null, ?array $whereAdc = null, ?string $target_add = null)
    {
        if (is_null($options)) {
            $options = $this->browserOptions();
        }
        $tempSlct = $options['select'];
        $sumCam = '';
        //-- Tratamento de campos para seleção
        if (!empty($options['select']) && is_string($options['select'])) {
            $tempSlct = explode(',', $options['select']);
        }
        $tempSlct = array_map('trim', $tempSlct);
        $select = $tempSlct;

        //-- Ordenação de registros
        if (!empty($options['orderBy'])) {
            foreach ($options['orderBy'] as $cam => $val) {
                $val = strtoupper($val);
                $model->orderBy(esc($cam), in_array($val, ['ASC', 'DESC']) ? $val : 'ASC');
            }
        }

        //-- Filtros vindos do PHP
        if (!empty($whereAdc)) {
            $model->groupStart()->where($whereAdc)->groupEnd();
        }

        $searchedAny = !empty($options['searchAny']);

        //-- Adiciona filtros adicionais vindos do usuário
        if ($searchedAny) {
            //-- Filtro simples de registros é mandatório
            $model->orLikeBatch($model->allowedFields, $options['searchAny']);
        } else if (!empty($options['searchColumns'])) {
            //-- Validador de campos de filtragem concatenados
            if ($target_add == 'concat') {
                $select = [$tempSlct[0], 'CONCAT('];
                foreach ($tempSlct as $key => $cam) {
                    if ($key > 0) {
                        $sumCam .= $cam;
                        $select[1] .= $cam . '," - ",';
                    }
                    if ($cam == end($tempSlct)) {
                        $select[1] = rtrim($select[1], '," - ",') . ") AS " . $sumCam;
                    }
                }
            }

            $groupStarted = false;
            foreach ($options['searchColumns'] as $col => $val) {
                if (trim($val) === '') {
                    continue;
                }
                //-- Ignora campos que são de relacionamento, pois são tratados na parte de join
                if (!isset($model->dictionary->relations[$col])) {
                    if (!$groupStarted) {
                        $model->groupStart();
                        $groupStarted = true;
                    }
                    $model->like($model->table . '.' . $col, $val);
                }
            }
            if ($groupStarted) {
                $model->groupEnd();
            }
        }

        //-- Join de relacionamentos
        $joinAlias = 'A';
        if (!empty($model->dictionary->relations)) {
            $joinAlias = 'A';
            $aliasCount = 0;
            foreach ($model->dictionary->relations as $camRel => $info) {
                $arrPos = $this->findFieldInSelect($camRel, $select);
                if ($arrPos !== false) {
                    $select[$arrPos] = "`{$joinAlias}`.`{$info['target_desc']}` AS {$camRel}";
                }
                $model->join(
                    $info['target_table'] . ' AS ' . $joinAlias,
                    "`$joinAlias`.`{$info['target_id']}`=`{$model->table}`.`{$camRel}` AND `$joinAlias`.`sys_del` IS NULL",
                    'left'
                );

                if (!$searchedAny && isset($options['searchColumns'][$camRel]) && !empty($options['searchColumns'][$camRel])) {
                    //-- Filtro por campo é complementar
                    $model->groupStart();
                    if ($aliasCount === 0) {
                        $model->like("`{$joinAlias}`.`{$model->dictionary->relations[$camRel]['target_desc']}`", $options['searchColumns'][$camRel]);
                        ++$aliasCount;
                    } else {
                        $model->orLike("`{$joinAlias}`.`{$model->dictionary->relations[$camRel]['target_desc']}`", $options['searchColumns'][$camRel]);
                    }

                    $model->groupEnd();
                }
                $joinAlias++;
            }

            foreach ($select as $inc => $val) {
                if (strpos($val, ' AS ') === false) {
                    $_val = array_reverse(explode('.', $val));
                    if (count($_val) > 1) {
                        $select[$inc] = "`{$_val[1]}`.`{$_val[0]}` AS {$_val[0]}";
                    } else {
                        $select[$inc] = "`{$model->table}`.`{$_val[0]}` AS {$_val[0]}";
                    }
                }
            }
        }

        //-- Aplica seleção de campos
        if (!empty($select)) {
            $select = array_unique($select);
            $select = implode(', ', $select);
            $model->select($select);
            //-- Tem distinct?
            if ($options['distinct']) {
                $model->distinct();
            }
        }

        //-- Faz a consulta de registros
        try {
            $data = $model->paginate($options['perPage'], 'default', $options['currentPage'], $options['segment']);
        } catch (\Throwable$th) {
            // echo $model->getLastQuery();die;
            throw new \Exception(lang('Framework.query_invalid'));
        }

        //-- Retorna resultados
        $details = $model->pager->getDetails();
        $details['links'] = $model->pager->links('default', 'bs_full');
        return [
            'pager' => $this->browserOptionsOutput($details, $options),
            'data' => $data,
        ];
    }

    /**
     * Verifica se existe campo em select
     *
     * @param string $field
     * @param array $select
     *
     * @return int|false
     */
    private function findFieldInSelect(string $field, array $select)
    {
        foreach ($select as $key => $item) {
            if (array_reverse(explode('.', $item))[0] == $field) {
                return $key;
            }
        }

        return false;
    }

    /**
     * Verifica os campos a serem excluídos permanentemente
     *
     * @param int $id
     * @param mixed $model
     *
     * @return array|string string=err
     */
    protected function permanentDeleteCheck(int $id, $model)
    {
        //-- verifica permissão para deletar
        $patient = $model->find($id);
        if (empty($patient)) {
            return lang('Framework.reg_not_found');
        }
        if (!hasAccess('admin') && !hasClinicAccess($patient->clinics_id)) {
            return lang('Framework.auth_roles_denied');
        }

        $ret = $model->relationDeleteCheck($id);

        return $ret;
    }
}
