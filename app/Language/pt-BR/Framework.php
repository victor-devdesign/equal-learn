<?php

return [
    //-- Login
    'login_user_not_found' => 'Usuário não encontrado!',
    'login_user_blocked' => 'Bloqueio temporário por excesso de tentativas de login incorretas!',
    'login_user_not_confirmed' => 'Seu cadastro ainda não foi confirmado!',
    'login_user_disabled' => 'Usuário desabilitado pelo gestor!',
    'login_user_authenticated' => 'Usuário autenticado com sucesso!',
    'login_user_timeblock' => 'Você não pode acessar o portal neste horário!',
    'login_mfa_title' => 'Autenticação 2 fatores',
    'login_mfa_required' => 'Código de autenticação 2 fatores é obrigatório!',
    'login_mfa_wrong' => 'Código de autenticação 2 fatores incorreto!',
    'login_mfa_sent' => 'Verifique seu e-mail com o código de autorização!',
    'login_recaptcha_missing' => 'ReCAPTCHA inválido!',
    'login_user_required' => 'Usuário requerido!',
    'login_google_fail' => 'Falha na autenticação com o Google!',
    'login_access_logs' => 'Histórico de acessos',
    'redirect_to_login' => 'Você será redirecionado à página de login!',

    //-- Senhas
    'password_set' => 'Definir senha',
    'password_recovery_duplicate' => 'Já existe um processo de recuperação em andamento!',
    'password_token_invalid' => 'Código de recuperação inválido!',
    'password_token_expired' => 'Código de recuperação inválido ou expirado!',
    'password_token_reset' => 'Código de recuperação expirado, inicie o processo de recuperação novamente!',
    'password_temporary' => 'Senha temporária',
    'password_wrong' => 'Usuário ou senha incorreta!',
    'password_change' => 'Alteração de senha!',
    'password_changed' => 'Senha alterada com sucesso!',
    'password_same_as_old' => 'A senha não pode ser a mesma que a atual!',
    'password_same_as_older' => 'A senha não pode ser a mesma que as últimas {qtd} senhas utilizadas!',
    'password_old_invalid' => 'Senha antiga incorreta!',
    'password_is_weak' => 'Senha muito fraca, a senha de ter ao menos 8 caracteres misturando letras maiúsculas e minúsculas, números e símbolos.',
    'password_recovery' => 'Recuperação de Senha',
    'password_recovery_email' => 'E-mail enviado com instruções para recuperação de sua senha!',
    'password_recovery_email_pwd' => 'Foi enviado um e-mail com a sua senha temporária',
    'password_recovery_email_pwd_fail' => 'Falha ao enviar e-mail com a senha temporária, anote sua senha: ',
    'password_recovery_prompt' => 'Preencha seu e-mail para recuperação de senha!',
    'password_required' => 'Senha é obrigatória!',
    'password_too_old' => 'Senha vencida, cadastre uma nova senha!',
    'password_reset_sent' => 'E-mail de redefinição de senha enviado!',

    //-- Email
    'email_invalid' => 'E-mail inválido!',
    'email_sent_fail' => 'Falha ao enviar e-mail, tente novamente!',
    'email_test' => 'E-mail teste',
    'email_sent_to' => 'Email enviado com sucesso para: ',
    'email_not_configured' => 'E-mail de disparos não configurado, entre em contato com o suporte!',
    'email_confirmation' => 'Confirmação de email',
    'email_confirmed' => 'Confirmação de email realizada com sucesso! Enviamos um e-mail com sua senha provisória.',
    'email_confirmed_fail' => 'Falha ao confirmar email!',
    'email_confirmation_again' => 'Token informado inválido ou expirado, um novo token foi enviado para seu e-mail!',
    'email_temp_password_subject' => 'Senha para primeiro acesso',
    'email_automatic' => 'Este e-mail é uma notificação automática. Favor, não responder.',
    'email_recovery' => [
        'line_1' => 'Você solicitou a recuperação de senha para o portal',
        'line_2' => 'Para prosseguir com a recuperação de senha',
        'line_3' => 'Caso não tenha solicitado a troca de senha não se preocupe, nenhuma alteração foi realizada.',
        'line_4' => 'Tenha um ótimo dia.',
        'line_5' => 'Sua senha temporária é:',
        'line_6' => 'Será necessário a atualização da senha no primeiro acesso.',
    ],
    'email_account_confirmation' => 'Foi criada uma conta com este email, para confirmar clique no link a seguir:',

    //-- Libraries
    'recaptcha_invalid' => 'Recaptcha inválido!',

    //-- Auth
    'auth_method_not_supported' => 'Método de autenticação não suportado!',
    'auth_roles_denied' => 'Usuário sem acesso neste recurso!',
    'honeypot_caught' => 'Preenchimento indevido de formulário!',
    'invalid_request' => 'Requisição inválida!',
    'not_found' => 'O registro não foi encontrado',
    'empty_request' => 'O registro encontrado está vazio',

    //-- Parâmetros
    'param_does_not_exist' => 'Parâmetro não existe!',

    //-- Consultas
    'query_invalid' => 'Consulta inválida!',

    //-- Termos de uso
    'term_not_found' => 'Termo informado não encontrado!',

    //-- Commom
    'invalid_operation' => 'Operação inválida!',
    'access_denied' => 'Acesso negado',
    'reg_saved' => 'Registro gravado com sucesso!',
    'reg_save_fail' => 'Falha ao gravar registro!',
    'reg_not_found' => 'Registro não encontrado!',
    'reg_load_success' => 'Registro carregado com sucesso!',
    'reg_valid' => 'Registro válido!',
    'reg_code_exists' => 'Já existe um registro com estas características!',
    'reg_in_use' => 'Este registro está em uso e não pode ser deletado',
    'file_not_received' => 'Arquivo {campo} não recebido!',
    'file_invalid_extension' => 'A extensão {extension} não é suportada pelo servidor!',
    'file_invalid_size' => 'Arquivo com {size}MB, tamanho excede o limite do servidor de 15MB!',
    'unique_fail' => 'Já existe um registro com o valor informado em: {campo}',
    'new' => 'Incluir',
    'change' => 'Alterar',
    'users' => 'Usuários',
    'log_activities' => 'Logs de atividades',
    'log_access' => 'Logs de acesso',
    'save' => 'Gravar',
    'remove' => 'Remover',
    'order_already_exists' => 'Já existe pedido semelhante em aberto!',
    'changelog' => 'Histórico de alterações',
    'apply' => 'Aplicar',
    'clean' => 'Limpar',
    'actions' => 'Ações',
    'back' => 'Voltar',
    'saudacao' => 'Olá',
    'click_here' => 'Clique aqui',

    //-- Forms
    'only_edit_mode' => 'Disponível apenas em modo de edição',
    'no_regs_found' => 'Nenhum registro encontrado!',
    'validation_unique_error' => 'Já existe um registro com o valor informado',
    'validation_required' => 'Campo {campo} é requerido',

    //-- Listagem
    'filters_clean' => 'Limpar filtros',
    'filters' => 'Filtros',
    'filters_apply' => 'Aplicar filtros',
    'filters_any' => 'Filtra por qualquer campo',
    'filters_by_field' => 'Filtra por campo',

    //-- Comot 15
    'comot_not_found' => 'Comot não encontrado',
    'comot_already_exists' => 'Comot já existe',
    'comot_not_active' => 'Comot não ativo',
    'error_create_comot' => 'Erro ao criar comot',
    'error_update_comot' => 'Erro ao atualizar comot',
    'error_delete_comot' => 'Erro ao excluir comot',

    //-- PDF
    'pdf_subject' => 'PDF Automático gerado a partir de informações dinâmicas do portal',
];
