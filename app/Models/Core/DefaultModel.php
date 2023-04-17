<?php

namespace App\Models\Core;

use CodeIgniter\Model;

class DefaultModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = '';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'object'; //-- object/array
    protected $useSoftDeletes = true; //-- Não exclui o registro, altera
    protected $protectFields = true;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = true; //-- Define automaticamente os registros de inclusão e alteração
    protected $dateFormat = 'datetime';
    protected $createdField = 'sys_cri'; //-- Datetime
    protected $updatedField = 'sys_alt'; //-- Datetime
    protected $deletedField = 'sys_del'; //-- Datetime

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    protected $logOperations = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = ['auditSave'];
    protected $beforeUpdate = [];
    protected $afterUpdate = ['auditSave'];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = ['checkUsage'];
    protected $afterDelete = ['auditSave'];

    /**
     * Dicionario de dados
     *
     * @var \App\Database\Dictionary
     */
    protected $dictionary;

    /**
     * Relacionamentos com outras tabelas exemplo:
     *
     * Usuários x Log Auditoria
     *
     * [logs_activity] => [
     *  ['users_id' => 'id'] //-- campo na tabela relacionada, campo na tabela da model
     * ]
     *
     * Usado na validação de registro em uso (checkUsage).
     * Se necessário, criar uma estrutura onde além do relacionamento, é informado se deve ser utilizado na checagem de utilização.
     *
     * Melhores práticas: sempre colocar as tabelas que possivelmente tenham mais registro primeiro.
     *
     * NOTA: é carregado pelas models automaticamente pelo respectivo dicionário.
     *
     * @var array
     */
    protected $relationships = [];

    public function __construct()
    {
        parent::__construct();
        helper('framework');
        helper('log');
    }

    /**
     * Habilita logs de operações
     *
     * @return DefaultModel
     */
    public function enableLog()
    {
        $this->logOperations = true;
        return $this;
    }

    /**
     * Desabilita logs de operações
     *
     * @return DefaultModel
     */
    public function disableLog()
    {
        $this->logOperations = false;
        return $this;
    }

    /**
     * Confere com base nos relacionamentos se o registro está em uso
     *
     * @param array $info
     * @return DefaultModel
     */
    protected function checkUsage(array $info)
    {
        try {
            $check = $this->dictionary->getDeleteRelations();
        } catch (\Throwable $th) {
            //-- Sem suporte para dicionário ignora
            return true;
        }

        //-- Nenhum relacionamento, pula checagem
        if (empty($check)) {
            return true;
        }
        //-- Varre os ids recebidos
        foreach ($info['id'] as $idReg) {
            //-- Encontra o registro a ser deletado
            $oReg = $this->where('id', $idReg)->first();
            if (!isset($oReg->id)) {
                throw new \Exception(lang('Framework.reg_not_found'));
                return;
            }
            //-- Varre relacionamentos em busca de algum registro válido
            foreach ($check as $targetTable => $cams) {
                $builder = $this->builder($targetTable)->where('sys_del', null);
                foreach ($cams as $cam => $ref) {
                    $builder->where($cam, $oReg->{$ref});
                }
                if ($builder->countAllResults() > 0) {
                    throw new \Exception(lang('Framework.reg_in_use'));
                    return;
                }
            }
        }
        return true;
    }

    /**
     * Audita toda criação, alteração e exclusão de registros
     *
     * @param array $info
     * @return boolean
     */
    protected function auditSave(array $info)
    {
        //-- Exceções que não devem gravar log
        if (in_array($this->table, ['', 'logs_access', 'logs_activity', 'users_passwords']) || $this->logOperations === false) {
            return true;
        }
        if (is_array($info['id'])) {
            foreach ($info['id'] as $idReg) {
                logAudit([
                    'tabela' => $this->table,
                    'registro' => $idReg,
                    'fingerprint' => $this->withDeleted()->where('id', $idReg)->first(),
                ]);
            }
        } else {
            logAudit([
                'tabela' => $this->table,
                'registro' => $info['id'],
                'fingerprint' => $this->withDeleted()->where('id', $info['id'])->first(),
            ]);
        }
        return true;
    }

    /**
     * Adiciona um conjunto condicional de validações
     *
     * @param array $where
     * @param mixed $value
     * @return DefaultModel
     */
    public function orWhereBatch(array $where, $value)
    {
        if (empty($where)) {
            return;
        }

        $this->groupStart();
        foreach ($where as $inc => $cam) {
            if ($inc === 0) {
                $this->where($this->table . '.' . $cam, $value);
            } else {
                $this->orWhere($this->table . '.' . $cam, $value);
            }
        }
        $this->groupEnd();
        return $this;
    }

    /**
     * Adiciona um conjunto condicional de validações
     *
     * @param array $where
     * @param mixed $value
     * @return DefaultModel
     */
    public function orLikeBatch(array $where, $value)
    {
        if (empty($where)) {
            return;
        }
        $this->groupStart();
        foreach ($where as $inc => $cam) {
            $tableAlias = 'A';
            if (!isset($this->dictionary->relations[$cam])) {
                continue;
            }
            $table = $tableAlias;
            $cam = $this->dictionary->relations[$cam]['target_desc'];
            if ($inc === 0) {
                $this->like($table . '.' . $cam, $value);
            } else {
                $this->orLike($table . '.' . $cam, $value);
            }
            $tableAlias++;
        }
        $this->groupEnd();
        return $this;
    }

    /**
     * Retorna somente registros com campo 'active' = 'S'
     *
     * @return DefaultModel
     */
    public function onlyActive()
    {
        $this->where($this->table . '.active', 'S');
        return $this;
    }

    /**
     * Validação de únicos
     *
     * @param mixed $value
     * @param mixed $idIgnore
     * @return boolean
     */
    public function validateUnique($cam, $value, ?int $idIgnore = null)
    {
        if (!in_array($cam, $this->dictionary->uniques)) {
            return true;
        }
        if (!is_null($idIgnore)) {
            $this->where('id<>', $idIgnore);
        }
        $oReg = $this->where($cam, $value)->first();
        if (isset($oReg->id)) {
            return false;
        }
        return true;
    }

    /**
     * Validação de únicos
     *
     * @return array
     */
    public function validateAllUniques($data, ?int $id = null)
    {

        $uniques = $this->dictionary->uniques;

        $fieldsNotUniques = [];
        foreach ($uniques as $u) {
            if (!$this->validateUnique($u, $data[$u], $id)) {
                $fieldsNotUniques[] = $this->dictionary->definition[$u]['form']['label'];
            }
        }

        if (count($fieldsNotUniques) > 0) {
            return [
                'accepted' => false,
                'fields' => implode(',', $fieldsNotUniques),
            ];
        }

        return ['accepted' => true];
    }

    /**
     * Validação de relacionamentos para exclusão segura
     *
     * @return array
     */
    public function relationDeleteCheck(int $id)
    {
        $relations = [];
        foreach ($this->deleteRelations as $table => $rel) {
            foreach ($rel as $camRel => $cam) {
                $verify = $this->select($cam . ' AS value')->where($cam, $id)->first();
                if (!empty($verify)) {
                    $select = [
                        $table . '.id AS rel_id',
                    ];
                    $query = $this
                        ->select($select)
                        ->from($table)
                        ->where($table . '.' . $camRel, $verify->value)
                        ->groupBy('rel_id')
                        ->findAll();
                    if (!empty($query)) {
                        $relations[$table] = $query;
                    }
                }
            }
        }

        return $relations;
    }
}
