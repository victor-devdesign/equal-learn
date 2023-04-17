<?php

/**
 * Retorna array/string identado (print_r melhorado).
 * @author Paulo Vitor de Lima
 * @param array Array ou String
 * @param boolean true: echo | false: return
 * @return string Array formatado.
 * @since 03/02/2014
 */
function pre($array, $return = false)
{
    if ($return) {
        return '<pre>' . print_r($array, true) . '</pre>';
    } else {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}

/**
 * Retorna o dump de uma variável e para execução do script
 *
 * @param [type] $var
 * @return void
 */
function dpre($var)
{
    return die(var_dump($var));
}

/**
 * Função que preenche uma string com um determinado caracter até um determinado tamanho.
 * @param string $string
 * @param char $char
 * @param int $num
 * @param string $orientacao D = Direita | E = Esquerda
 * @return string
 * @since 21/07/2014
 */
function preencher($string, $char = '0', $num = 2, $orientacao = 'E')
{
    while (strlen($string) < $num) {
        $string = ($orientacao == 'D' ? $string . $char[0] : $char[0] . $string);
    }

    return $string;
}

/**
 * <b>Descrição: </b> Retira acentos.
 * @author https://www.blogger.com/profile/16348587664312958665
 * @param string Texto.
 * @return string
 * @since 03/02/2014
 */
function retira_acentos($texto)
{
    $array1 = array(
        "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "à", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç"
    );
    $array2 = array(
        "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C"
    );
    return str_replace($array1, $array2, $texto);
}

/**
 * Força transformação para float.
 *
 * @param [type] $num
 * @return float
 */
function toFloat($num)
{
    $num = is_null($num) ? '0' : '' . $num;
    $minus = $num[0] == '-' ? -1 : 1;
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num)) * $minus;
    }

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
    ) * $minus;
}

/**
 * Função que cria uma determinada pasta
 */
function create_folders($dir, $file = false)
{
    if ($file) {
        $parts = explode('/', $dir);
        array_pop($parts);
        $dir = implode('/', $parts);
    }
    if (is_dir($dir)) {
        return true;
    }
    return mkdir($dir, 0644, true);
}

/**
 * Lista de meses em formato de array
 *
 * @return void
 */
function listaMeses()
{
    return ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
}

/**
 * Busca preferencia de usuário
 *
 * @param int $user Id de usuário
 * @param string $key Chave de preferencia
 * @param string $val Valor padrão caso não encontrado
 * @return string
 */
function getUserPref(int $user, string $key, $val = null)
{
    $model = new App\Models\Core\DefaultModel();
    $model->setTable('users_preferences')->setAllowedFields(['preference', 'info', 'users_id']);
    $ret = $model->select('info')->where('users_id', $user)->where('preference', $key)->first();
    if (!isset($ret->info)) {
        return $val;
    }
    return $ret->info;
}

/**
 * Define preferencia de usuário
 *
 * @param int $user Id de usuário
 * @param string $key Chave de preferencia
 * @param string $val Valor padrão caso não encontrado
 * @return void
 */
function setUserPref(int $user, string $key, $val = null)
{
    $model = new App\Models\Core\DefaultModel();
    $model->setTable('users_preferences')->setAllowedFields(['preference', 'info', 'users_id']);
    $ret = $model->select('id')->where('users_id', $user)->where('preference', $key)->first();
    if (isset($ret->id)) {
        return $model->update($ret->id, ['info' => $val]);
    }
    return $model->insert([
        'preference' => $key,
        'info' => $val,
        'users_id' => $user,
    ]);
}

/**
 * Consulta um valor único de registro
 *
 * @param string $table
 * @param string $collumn
 * @param mixed $value
 * @param string $camId
 * @param array $where
 * @return mixed
 */
function dbValue(string $table, string $collumn, $value, string $camId = 'id', $where = null)
{
    $model = new App\Models\Core\DefaultModel();
    $model->setTable($table);
    if (!is_null($where)) {
        $model->where($where);
    }
    $ret = $model->select($collumn . ' AS value')->where($camId, $value)->first();
    if (isset($ret->value)) {
        return $ret->value;
    }
    return '';
}

/**
 * Consulta um registro
 *
 * @param string $table
 * @param mixed $value
 * @param string $camId
 * @param array $where
 * @return object
 */
function dbRow(string $table, $value, string $camId = 'id', $where = null)
{
    $model = new App\Models\Core\DefaultModel();
    $model->setTable($table);
    if (!is_null($where)) {
        $model->where($where);
    }
    return $model->where($camId, $value)->first();
}

/**
 * Consulta registros
 *
 * @param string $table
 * @param mixed $value
 * @param string $camId
 * @param array $where
 * @return object
 */
function dbRows(string $table, $value, string $camId = 'id', $where = null)
{
    $model = new App\Models\Core\DefaultModel();
    $model->setTable($table);
    if (!is_null($where)) {
        $model->where($where);
    }
    return $model->where($camId, $value)->findAll();
}

/**
 * Busca o usuário corrente
 *
 * @return object|false
 */
function getCurrentUser()
{
    //-- Procura na sessão
    $oUser = session()->get('user');
    if (isset($oUser->id)) {
        return $oUser;
    }
    //-- Procura na memória
    if (isset($GLOBALS['__user__'])) {
        return $GLOBALS['__user__'];
    }
    return false;
}

/**
 * Retorna uma informação da sessão do usuário logado
 *
 * @param string $key
 * @return mixed
 */
function getUserInfo(string $key)
{
    $oUser = getCurrentUser();
    if ($oUser === false) {
        return false;
    }
    return $oUser->{$key} ?? false;
}

/**
 * Verifica se um usuário tem uma das funções necessárias para acesso
 *
 * @param string|array $allowed
 * @return boolean
 */
function hasAccess($allowed)
{
    $oUser = getCurrentUser();
    if (is_string($allowed)) {
        return in_array($allowed, $oUser->roles);
    }

    foreach ($allowed as $role) {
        if (in_array($role, $oUser->roles)) {
            return true;
        }
    }
    return false;
}

/**
 * Interpreta uma string contendo função, separando seu nome e argumentos passados.
 * @param  string $funcao
 * @return array
 */
function separarFuncaoArgs(string $funcao)
{
    $nome = substr($funcao, 0, strpos($funcao, '('));
    $args = trim(substr($funcao, strlen($nome) + 1, -1));
    if ($args !== '') {
        $args = explode(',', $args);
        foreach ($args as $inc => $info) {
            if (($info[0] == '"' || $info[0] == "'") && $info[0] == $info[strlen($info) - 1]) {
                $args[$inc] = substr($info, 1, -1);
            }
        }
    } else {
        $args = array();
    }
    return [$nome, $args];
}

/**
 * Chama e executa uma dada função.
 * @param  string $funcao
 * @return string
 */
function chamaFuncao(string $funcao)
{
    $info = separarFuncaoArgs($funcao);
    if (function_exists($info[0])) {
        return call_user_func_array($info[0], $info[1]);
    }
    return '';
}

/**
 * Chama e executa uma dada função.
 * @param  string $funcao
 * @return mixed|string
 */
function chamaFuncao2(string $funcao, ?array $argumentos = [])
{
    if (function_exists($funcao)) {
        return call_user_func_array($funcao, $argumentos);
    }
    return '';
}

/**
 * Lista valor de um dado combo
 *
 * @param string $str
 * @param string $val
 * @return string
 */
function listaValorCombo(string $str, string $val)
{
    $arr = arrayOpcoesAssoc($str);
    if (isset($arr[$val])) {
        return $arr[$val];
    }
    return '';
}

/**
 * Retorna array associativo de opções de uma dada string
 *
 * @param string $str
 * @return array
 */
function arrayOpcoesAssoc(string $str)
{
    $arr = arrayOpcoes($str);
    $ret = [];
    if (empty($arr)) {
        return $ret;
    }
    foreach ($arr as $item) {
        $ret[$item['valor']] = $item['descricao'];
    }
    return $ret;
}

/**
 * Formata um checkbox com uma lista de opções
 *
 * @param string $opcoes
 * @param string $valores
 * @param string $glue
 * @param string $sep
 * @return string
 */
function formatarCheckbox(string $opcoes, string $valores, ?string $glue = ' & ', ?string $sep = '|')
{
    $opcoes = arrayOpcoesAssoc($opcoes);
    $ret = [];
    $valores = explode($sep, $valores);
    foreach ($valores as $val) {
        if (isset($opcoes[$val])) {
            $ret[] = $opcoes[$val];
        }
    }
    return implode($glue, $ret);
}

/**
 * Retorna um array de opções
 *
 * @param string $opcoes
 * @return array
 */
function arrayOpcoes($opcoes)
{
    $ret = [];
    $opcoes = explode(';', str_replace('&reg;', '|REG|', $opcoes));
    foreach ($opcoes as $info) {
        $info = explode('=', str_replace('|REG|', '&reg;', $info));
        $ret[] = [
            'valor' => $info[0],
            'descricao' => isset($info[1]) ? $info[1] : $info[0],
        ];
    }
    return $ret;
}

/**
 * Função para prevenção de sujeiras simples
 *
 * @param array $arr
 * @return array
 */
function sanitizePostData(array $arr)
{
    $ret = [];
    foreach ($arr as $key => $val) {
        $val = trim($val);
        //-- Se o nome do campo está comprometido... ignora o campo
        if ($key != esc($key)) {
            continue;
        }
        //-- Se está vazio, joga nulo
        if (empty($val) && $val !== '0') {
            $val = null;
        }
        $ret[$key] = $val;
    }
    return $ret;
}

/**
 * Adiiona uma chave no array de string
 *
 * @param string $arr array em string
 * @param mixed $valor
 * @param string $delim
 * @return string
 */
function addToStrArr($arr, $valor, string $delim = '|')
{
    if (is_string($arr)) {
        $arr = explode($delim, $arr);
    }
    $arr[] = $valor;
    return implode($delim, $arr);
}

/**
 * Tratamento de upload vindo de uma requisição post
 *
 * @param object $model
 * @param array $post
 * @param string $oper
 * @return string|array
 */
function handleUpload($model, array &$post, string $oper)
{
    $mParams = model('\App\Models\ParamsModel');
    $request = \Config\Services::request();

    //-- Valida no dicionário tipos de campo arquivo
    $uplFiles = $model->dictionary->getUploadFields();
    if (empty($uplFiles)) {
        return []; //-- Não tem arquivos de upload, ignora
    }

    $parser = \Config\Services::parser();
    $ret = [];

    $apiKey = $mParams->get('tinypng_apikey', '');
    $apiLim = (int) $mParams->get('tinypng_limit', 500);
    $extOpt = ['png', 'jpg', 'jpeg'];
    $otimizarImg = false;

    if (!empty($apiKey)) {
        $imgOpt = new \App\Libraries\ImageOptimizer();
        $imgOpt->setKey($apiKey, $apiLim);
        $otimizarImg = $imgOpt->getCurrentUsage();
        $otimizarImg = $otimizarImg !== false && !$otimizarImg['reached'];
    }

    $request = Config\Services::request();
    foreach ($uplFiles as $cam => $info) {

        //-- Valida se o campo é obrigatório
        $required = strpos($info['form']['validation'], 'required') !== false;

        $file = $request->getFile($cam);

        //-- Valida se recebeu o arquivo
        $hasFile = !empty($file) && !is_null($file);

        if (!$hasFile) {
            try {
                unset($post[$cam]);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
            continue;
        }
        if ($hasFile) {
            //-- Havendo arquivo valida o recebimento
            if (!$file->isValid()) {
                return $file->getErrorString() . '(' . $file->getError() . ')';
            }

            //-- Valida de acordo com dicionário
            $erros = [];
            $validator = Config\Services::validation();
            $validator->setRules([$cam => $info['form']['upload_rules']], $erros);
            $validated = $validator->withRequest($request)->run();

            if (!$validated) {
                return str_replace($cam, '"' . $info['form']['label'] . '"', $validator->getError());
            }
        }

        //-- Trata tipo de operação
        if ($oper === 'create' && $required && !$hasFile) {
            return $parser->setData(['campo' => $cam])->renderString(lang('Framework.file_not_received'));
        }
        if ($oper === 'update' && $required && !$hasFile) {
            if (isset($post[$cam])) {
                unset($post[$cam]);
            }
            continue;
        }

        //-- Otimização de imagens
        $regPath = 'uploads/' . $model->table . '/' . $cam;
        $fileName = $file->getRandomName();
        $ext = $file->getClientExtension();

        if ($otimizarImg && in_array($ext, $extOpt)) {
            try {
                $imgOpt->optimizeFile(WRITEPATH . $regPath);
            } catch (\Throwable $th) {
                // echo $th->getMessage();
            }
        }

        try {
            //-- Define caminho de upload
            $cfgCliente = config('Config\\Cliente');
            $file->move(FCPATH . $regPath, $fileName);
            $regPath .= '/' . $fileName;
            switch ($cfgCliente->defaultUploader) {
                    // case 'azure':
                    //     $regPath .= '/' . $fileName;
                    //     $AzureStorage = new \App\Libraries\AzureStorage();
                    //     if (empty($AzureStorage->azureConfig)) {
                    //         return 'Falha ao conectar com servidor de arquivos!';
                    //     }
                    //     $tof = $AzureStorage->storeObject($_FILES[$cam]['tmp_name'], $regPath, $_FILES[$cam]['type']);
                    //     if ($tof === false) {
                    //         return $AzureStorage->getError();
                    //     }
                    //     break;
                case 'aws':
                    $aws = new \App\Libraries\AwsBucket();
                    // Salva o arquivo gerado no servidor aws
                    $awsUpload = $aws->upload(WRITEPATH . $regPath, 'uploads/' . $model->table . '/' . $cam, $fileName);
                    if (!isset($awsUpload['status'])) {
                        return 'Falha ao comunicar com o servidor de arquivos!';
                    }
                    if ($awsUpload['status'] > 300) {
                        return 'Erro: ' . $awsUpload['status'] . ' - ' . $awsUpload['message'];
                    }
                    // Exclusão do arquvio gerado no servidor local
                    unlink(WRITEPATH . $regPath);
                    $regPath = $awsUpload['message'];
                    break;
                case 'local':
                default:
            }
        } catch (\Throwable $th) {
            if (isset($post[$cam])) {
                unset($post[$cam]);
            }
            return $th->getMessage();
        }

        $post[$cam] = $regPath;
        $ret[] = $regPath;
    }
    return $ret;
}

/**
 * # Tratamento de upload vindo de um arquivo em específico
 *
 * - Função específica para upload de um único arquivo tendo em vista a utilização de
 *   um campo "âncora" como nome para relacionar o arquivo ao "{$request->getFile($file_cam)}".
 *
 * ## Campos para envio
 *
 * @param string $file_cam Nome do arquivo "(Âncora)"
 * @param string $regPath Caminho do arquivo
 * @param string $camName Campo da tabela
 * @param array $rules
 * @param string $update
 *
 * ### $file_cam
 *
 * - Nome do arquivo a ser chamado na função do request "getFile". Recomendasse o uso de padrão
 *   de nomenclatura em casos de upload de um ou mais arquivos utilizando o mesmo campo input
 *   pois essa será a forma de ancorar o arquivo a execução da função.
 * - "{FormData().append($file_cam,$('input[type="file"]')[0].files[0])}"
 *
 * ### $regPath
 *
 * - Caminho que será salvo o arquivo, caso seja validado como true o retorno da função trará o
 *   $regPath + o nome do arquivo salvo no servidor.
 *
 * ### $camName
 *
 * - Nome do campo da tabela onde o caminho do diretório será salvo.
 *
 * ### $rules
 *
 * - Definição de regras de validação de arquivo;
 *
 * ### $update
 *
 * - Link de arquivo ja salvo no banco de dados, quando o valor for diferente de nulo o sistema
 *   irá pegar esse link e excluir esse arquivo do sistema para realizar o upload do arquivo gerado
 *
 * ## Retorno
 *
 * @return string|array
 *
 * - string em casos de validação concluída;
 * - array em casos de erro.
 *
 * #### Versão (09/2022)
 * ##### - A função a partir desta data possui possibilidade de integração 100% finalizada com o padrão SVI e AWS Bucket;
 * ##### - A função a partir desta data possui a integração com Azure Storage em desenvolvimento.
 *
 */
function handleSingleUpload(string $file_cam, string $regPath, string $camName, array $rules, ?string $update = null)
{
    $mParams = model('\App\Models\ParamsModel');
    $request = \Config\Services::request();
    $parser = \Config\Services::parser();
    $ret = [];

    $apiKey = $mParams->get('tinypng_apikey', '');
    $apiLim = (int) $mParams->get('tinypng_limit', 500);
    $extOpt = ['png', 'jpg', 'jpeg'];
    $otimizarImg = false;

    if (!empty($apiKey)) {
        $imgOpt = new \App\Libraries\ImageOptimizer();
        $imgOpt->setKey($apiKey, $apiLim);
        $otimizarImg = $imgOpt->getCurrentUsage();
        $otimizarImg = $otimizarImg !== false && !$otimizarImg['reached'];
    }

    $file = $request->getFile($file_cam);
    //-- Valida se recebeu o arquivo
    $hasFile = !empty($file) && !is_null($file);

    if (!$hasFile) {
        return 'Não há arquivos para upload!';
    }
    if ($hasFile) {
        //-- Havendo arquivo valida o recebimento
        if (!$file->isValid()) {
            return [$file->getErrorString() . '(' . $file->getError() . ')'];
        }

        //-- Validação padrão de arquivos
        $erros = [];
        $validator = Config\Services::validation();
        $validator->setRules($rules, $erros);
        $validated = $validator->withRequest($request)->run();

        if (!$validated) {
            return [str_replace($camName, 'Arquivo', $validator->getError())];
        }
    }

    //-- Trata tipo de operação
    if (!$hasFile) {
        return [$parser->setData(['campo' => $camName])->renderString(lang('Framework.file_not_received'))];
    }

    //-- Define caminho de upload

    //-- Otimização de imagens
    $ext = explode('.', $regPath);
    $ext = array_pop($ext);
    if ($otimizarImg && in_array($ext, $extOpt)) {
        try {
            $imgOpt->optimizeFile(WRITEPATH . $regPath);
        } catch (\Throwable $th) {
            // echo $th->getMessage();
        }
    }

    try {
        $cfgCliente = config('Config\\Cliente');
        $fileName = $file->getRandomName();
        $file->move(WRITEPATH . $regPath, $fileName);
        $regPath .= '/' . $fileName;
        switch ($cfgCliente->defaultUploader) {
                // case 'azure':
                //     $regPath .= '/' . $fileName;
                //     $AzureStorage = new \App\Libraries\AzureStorage();
                //     if (empty($AzureStorage->azureConfig)) {
                //         return 'Falha ao conectar com servidor de arquivos!';
                //     }
                //     $tof = $AzureStorage->storeObject($_FILES[$cam]['tmp_name'], $regPath, $_FILES[$cam]['type']);
                //     if ($tof === false) {
                //         return $AzureStorage->getError();
                //     }
                //     break;
            case 'aws':
                $aws = new \App\Libraries\AwsBucket();
                // Salva o arquivo gerado no servidor aws
                $awsUpload = $aws->upload(WRITEPATH . $regPath, $regPath, $fileName);
                if (!isset($awsUpload['status'])) {
                    return ['Falha ao comunicar com o servidor de arquivos!'];
                }
                if ($awsUpload['status'] > 300) {
                    return ['Erro: ' . $awsUpload['status'] . ' - ' . $awsUpload['message']];
                }
                // Exclusão do arquvio gerado no servidor local
                unlink(WRITEPATH . $regPath);
                $regPath = $awsUpload['message'];
                break;
        }

        if ($update != null && explode('/', $update == 'uploads')) {
            $change = rollbackUploads([$update]);
            if (is_string($change)) {
                return ['Houve um erro ao atualizar o arquivo!'];
            }
        }
    } catch (\Throwable $th) {
        return [$th->getMessage()];
    }

    $ret = $regPath;

    return $ret;
}

/**
 * Função de apoio obtenção de link público de um arquivo
 *
 * @param [type] $file
 * @return string|void
 */
function downloadPublicFile($file)
{
    $cfgCliente = config('Config\\Cliente');
    if (strpos($file, '://', 0) !== false) {
        return $file;
    }
    switch ($cfgCliente->defaultUploader) {
            // case 'azure':
            //     $AzureStorage = new \App\Libraries\AzureStorage();
            //     if (empty($AzureStorage->azureConfig)) {
            //         return 'Falha ao conectar com servidor de arquivos!';
            //     }
            //     $filePath = $AzureStorage->downloadObject($file);
            //     break;
        case 'aws':
            $aws = new \App\Libraries\AwsBucket();
            if (is_null($file)) {
                return '';
            }
            $filePath = $aws->download($file);
            break;
        default:
            $filePath = base_url($file);
            break;
    }
    return $filePath;
}

/**
 * Rollback de uploads
 *
 * @param array $uplList
 * @return void
 */
function rollbackUploads(array $uplList)
{

    $cfgCliente = config('Config\\Cliente');
    try {
        switch ($cfgCliente->defaultUploader) {
            case 'aws':
                foreach ($uplList as $filePath) {
                    $aws = new \App\Libraries\AwsBucket();
                    $aws->delete($filePath);
                }
                break;
            default:
                foreach ($uplList as $filePath) {
                    $path = FCPATH . $filePath;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                break;
        }
        return true;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

/**
 * Tratamento de sanitização dos caminhos de upload
 *
 * @param string $filePath
 * @return string
 */
function handleFilePathUpload($filePath)
{
    helper('text');
    $newPath = convert_accented_characters($filePath);
    $newPath = str_replace(' ', '_', $newPath);
    $newPath = str_replace('\\', '/', $newPath);
    $newPath = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0080-\u7fff] remove', $newPath);
    $newPath = str_replace([
        ':', '!', '@', '#', '$', '%', '¨', '¬', '&', '*', '(', ')', '-', '+', '=', '+', '§', ';', 'º',
        ']', '[', 'ª', '´', '`', '~', '^', "/", '\\', '?', '°', '"', "'", ' ', '\n',
    ], '_', $newPath);

    return $newPath;
}

/**
 * Retorna o MIME de um arquivo vindo de uma URL
 *
 * @param string $buffer
 * @return string
 */
function getUrlMimeType($buffer)
{
    $buffer = file_get_contents($buffer);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    return $finfo->buffer($buffer);
}

/**
 * Adiciona dias em uma data
 *
 * @param string $date
 * @param string $format
 * @param int $daysAdded
 * @return void
 */
function addDaysWithoutWeekend(string $date, string $format, int $daysAdded)
{
    $date = \Carbon\Carbon::createFromFormat($format, $date);
    while ($daysAdded > 0) {
        $date->addDay();
        if (!$date->isWeekend()) {
            $daysAdded--;
        }
    }
    return $date->format($format);
}

/**
 * Tenta negociar qual a lingua correta à ser aplicada
 *
 * @param string $default Opcional, linguagem padrão caso não identificado no usuário ou pelo request
 * @return string
 */
function getCurrentLang(string $default = '')
{
    $oUser = getCurrentUser();
    //-- Prioridade para preferência do usuário
    if (isset($oUser->default_lang) && !empty($oUser->default_lang)) {
        return $oUser->default_lang;
    }
    //-- Tenta identificar automaticamente dentro das linguas suportadas
    $lang = service('request')->getLocale();
    if (!empty($lang)) {
        return $lang;
    }
    //-- Se tem uma lingua padrão enviada na função respeita
    if (!empty($default)) {
        return $default;
    }
    //-- Se não tem nada retorna a lingua padrão do sistema
    return config('App')->defaultLocale;
}

/**
 * Tradução com failsafe do framework para linguagem padrão do portal
 *
 * @param string $key
 * @param array|null $args
 * @param string|null $forcedLang
 * @return string
 */
function fwTranslate(string $key, ?array $args = [], ?string $forcedLang = '')
{
    $translated = lang($key, $args, $forcedLang);
    if ($translated == $key) {
        return lang($key, $args, config('App')->defaultLocale);
    }
    return $translated;
}

/**
 * Tratamento de segurança para termos autocompletar
 *
 * @param string $termo
 * @return string
 */
function trataTermoAutocomplete(string $termo)
{
    return retira_acentos(strtolower(str_replace(' ', '%', addslashes($termo))));
}

/**
 * Tela simples com mensagem de alerta
 *
 * @param string $msg
 * @return void
 */
function alert($msg = '', ?string $layout = 'layout/default.html', ?bool $renderString = false)
{
    $tpl = new \App\Libraries\Template();
    $tpl->parser->setData([
        'layout_content' => $tpl->parser->render('layout/alert.html'),
        'msg' => $msg,
    ], 'raw');

    if ($renderString) {
        return $tpl->parser->renderString($layout);
    }

    return $tpl->parser->render($layout);
}

/**
 * Formatação de campos cpf e cnpj
 *
 * @param int $value
 * @param string $format
 * @return int|false
 */
function formatValue($value, string $format)
{
    if ($value == false || $value == null || $value == '' || empty($value) || empty($format)) {
        return null;
    }

    switch ($format) {
        case 'cpf': // 000.000.000-00
            $newValue = substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
            break;

        case 'cnpj': // 00.000.000/0000-00
            $newValue = substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, -2);
            break;

        case 'extense-pt-br':
            $newValue = valorPorExtenso($value, false, false, 'pt-br');
            break;

        case 'extense-en':
            $newValue = valorPorExtenso($value, false, false, 'en');
            break;

        default:
            $newValue = null;
            break;
    }

    return $newValue;
}

/**
 * Valor por extenso
 *
 * @param integer $valor
 * @param boolean $bolExibirMoeda
 * @param boolean $bolPalavraFeminina
 * @param string $language
 * @param integer $depth
 * @return void
 */
function valorPorExtenso($valor = 0, $bolExibirMoeda = false, $bolPalavraFeminina = false, $language = 'pt-br', $depth = 0)
{
    if ($language == 'pt-br') {
        $valor = trim($valor);

        $singular = null;
        $plural = null;

        if ($bolExibirMoeda) {
            $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
        } else {
            $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("", "", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
        }

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezessete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
        $e = " e ";

        if ($bolPalavraFeminina) {

            if ($valor == 1) {
                $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
            } else {
                $u = array("", "um", "duas", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
            }

            $c = array("", "cem", "duzentas", "trezentas", "quatrocentas", "quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
        }

        $z = 0;

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);

        for ($i = 0; $i < count($inteiro); $i++) {
            for ($ii = mb_strlen($inteiro[$i]); $ii < 3; $ii++) {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }

        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $rt = null;
        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? $e : "") . $rd . (($rd && $ru) ? $e : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000") {
                $z++;
            } elseif ($z > 0) {
                $z--;
            }

            if (($t == 1) && ($z > 0) && ($inteiro[0] > 0)) {
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            }

            if ($r) {
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : $e) : " ") . $r;
            }
        }

        $rt = mb_substr($rt, 1);

        return ($rt ? trim($rt) : "zero");
    } else if ($language == "en") {
        $result = array();
        $number = trim($valor);
        $tens = floor($number / 10);
        $units = $number % 10;

        $words = array(
            'units' => array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'),
            'tens' => array('', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'),
        );

        if ($tens < 2) {
            $result[] = $words['units'][$tens * 10 + $units];
        } else {
            $result[] = $words['tens'][$tens];

            if ($units > 0) {
                $result[count($result) - 1] .= '-' . $words['units'][$units];
            }
        }

        if (empty($result[0])) {
            $result[0] = 'Zero';
        }

        return trim(implode(' ', $result));
    }
}

/**
 * Mostra o mês por extenso
 *
 * @param string $language
 * @param int $m
 *
 * @return string
 */
function formatMonth(string $language, int $m)
{
    $months = [];
    if ($language == "pt-BR") {
        $months = [
            0 => "",
            1 => "Janeiro",
            2 => "Fevereiro",
            3 => "Março",
            4 => "Abril",
            5 => "Maio",
            6 => "Junho",
            7 => "Julho",
            8 => "Agosto",
            9 => "Setembro",
            10 => "Outubro",
            11 => "Novembro",
            12 => "Dezembro",
        ];
        return $months[$m];
    } else if ($language == "en") {
        $months = [
            0 => "",
            1 => "January",
            2 => "February",
            3 => "March",
            4 => "April",
            5 => "May",
            6 => "June",
            7 => "July",
            8 => "August",
            9 => "September",
            10 => "October",
            11 => "November",
            12 => "December",
        ];
        return $months[$m];
    }
}

/**
 * Função que gera uma string com tamanho e caracteres aleatórios desejados
 *
 * @param int $tamanho Tamanho de Caracteres
 * @param boolean $maiusculas Existencia de letras maiusculas
 * @param boolean $minusculas Existencia de letras minusculas
 * @param boolean $numeros Existencia de numeros
 * @param boolean $simbolos Existencia de caracteres especiais
 *
 * @return string
 */
function randomCharacters($tamanho, $maiusculas, $minusculas, $numeros, $simbolos)
{
    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
    $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
    $nu = "0123456789"; // $nu contem os números
    $si = "!@#$%¨&*()_+="; // $si contem os símbolos
    $senha = '';

    if ($maiusculas) {
        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($ma);
    }

    if ($minusculas) {
        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($mi);
    }

    if ($numeros) {
        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($nu);
    }

    if ($simbolos) {
        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($si);
    }

    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
    return substr(str_shuffle($senha), 0, $tamanho);
}

/**
 * Criptografa um valor passado como base64[sha512]
 *
 * @param {type} $value
 *
 * @return base64
 */
function fwEncrypt($value)
{
    $crypt = \Config\Services::encrypter();
    $value = base64_encode($crypt->encrypt($value));

    return $value;
}

/**
 * Decifra um valor passado como base64[sha512]
 *
 * @param base64|string $value
 *
 * @return {type}
 */
function fwDecrypt($value)
{
    $crypt = \Config\Services::encrypter();
    $value = $crypt->decrypt(base64_decode($value));

    return $value;
}

/**
 * Verifica acesso na clínica
 *
 * @param [type] $clinicId
 * @return boolean
 */
function hasClinicAccess($clinicId)
{
    $mClinicsUsers = model('App\Models\ClinicsUsersModel');
    return $mClinicsUsers->hasClinicAccess($clinicId);
}
