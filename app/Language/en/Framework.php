<?php

return [
    //-- Login
    'login_user_not_found' => 'User not found!',
    'login_user_blocked' => 'Temporary blocking due to too many incorrect login attempts!',
    'login_user_not_confirmed' => 'Your login has not been confirmed yet!',
    'login_user_disabled' => 'User disabled by manager!',
    'login_user_authenticated' => 'User authenticated successfully!',
    'login_user_timeblock' => 'You cannot access the portal at this time!',
    'login_mfa_title' => '2-factor authentication',
    'login_mfa_required' => '2-factor authentication code is required!',
    'login_mfa_wrong' => 'Incorrect 2-factor authentication code!',
    'login_mfa_sent' => 'Check your email with the authorization code!',
    'login_recaptcha_missing' => 'Invalid ReCAPTCHA!',
    'login_user_required' => 'User required!',
    'login_google_fail' => 'Authentication with Google failed!',
    'login_access_logs' => 'Access logs',
    'redirect_to_login' => 'You will be redirected to the login page!',

    //-- Passwords
    'password_set' => 'Set password',
    'password_recovery_duplicate' => 'There is already a recovery process in progress!',
    'password_token_invalid' => 'Invalid recovery code!',
    'password_token_expired' => 'Invalid or expired recovery code!',
    'password_token_reset' => 'Recovery code expired, start recovery process again!',
    'password_temporary' => 'Temporary password',
    'password_wrong' => 'Incorrect username or password!',
    'password_change' => 'Change password!',
    'password_changed' => 'Password changed successfully!',
    'password_same_as_old' => 'The password cannot be the same as the current one!',
    'password_same_as_older' => 'The password cannot be the same as the last {qty} passwords used!',
    'password_old_invalid' => 'Invalid old password!',
    'password_is_weak' => 'Very weak password, the password must be at least 8 characters long, mixing uppercase and lowercase letters, numbers and symbols.',
    'password_recovery' => 'Password Recovery',
    'password_recovery_email' => 'Email sent with instructions for recovering your password!',
    'password_recovery_email_pwd' => 'Email has been sent with your temporary password, you may close this window.',
    'password_recovery_email_pwd_fail' => 'Failed to send email with temporary password, write down your password: ',
    'password_recovery_prompt' => 'Fill in your password recovery email!',
    'password_required' => 'Password is required!',
    'password_too_old' => 'Password expired, enter a new password!',
    'password_reset_sent' => 'Password reset email sent!',

    //-- Email
    'email_invalid' => 'Invalid email!',
    'email_sent_fail' => 'Failed to send email, try again!',
    'email_test' => 'Email test',
    'email_sent_to' => 'Email successfully sent to: ',
    'email_not_configured' => 'Trigger email not configured, contact support!',
    'email_confirmation' => 'Email confirmation',
    'email_confirmed' => 'Email confirmation was successful! We have sent you an email with your temporary password.',
    'email_confirmed_fail' => 'Failed to confirm email!',
    'email_confirmation_again' => 'Invalid or expired token entered, a new token has been sent to your email!',
    'email_temp_password_subject' => 'Temporary password',
    'email_automatic' => 'This is an automatic email, please do not reply!',
    'email_recovery' => [
        'line_1' => 'A password recovery proccess was requested!',
        'line_2' => 'Click here to receive a temporary password ',
        'line_3' => 'If you haven\'t asked for a password recovery, don\'t worry! Nothing has changed.',
        'line_4' => 'Have a nice day!',
        'line_5' => 'Your temporary password is:',
        'line_6' => 'You must change this password at the next access!',
    ],
    'email_account_confirmation' => 'An account was created for this email, click here to confirm:',
    //-- Libraries
    'recaptcha_invalid' => 'Recaptcha invalid!',

    //-- Auth
    'auth_method_not_supported' => 'Auth method not supported!',
    'auth_roles_denied' => 'User has no access to this feature!',
    'honeypot_caught' => 'Improper form filling!',
    'invalid_request' => 'Invalid request!',
    'not_found' => 'The requested feature is not found',
    'empty_request' => 'Empty request!',

    //-- Parameters
    'param_does_not_exist' => 'Parameter does not exist!',

    //-- Queries
    'query_invalid' => 'Invalid query!',

    //-- Terms of use
    'term_not_found' => 'Informed term not found!',

    //-- Common
    'invalid_operation' => 'Invalid operation!',
    'access_denied' => 'Access Denied',
    'reg_saved' => 'Record saved successfully!',
    'reg_save_fail' => 'Failed to save record!',
    'reg_not_found' => 'Record not found!',
    'reg_load_success' => 'Record loaded successfully!',
    'reg_valid' => 'Valid registration!',
    'reg_code_exists' => 'A record with these characteristics already exists!',
    'reg_in_use' => 'This record is in use and cannot be deleted',
    'file_not_received' => 'File {field} not received!',
    'file_invalid_extension' => 'The extension {extension} is not supported by the server!',
    'file_invalid_size' => 'File with {size}MB, size exceeds server limit of 15MB!',
    'unique_fail' => 'There is already a record with the value entered in: {field}',
    'new' => 'New',
    'change' => 'Edit',
    'users' => 'Users',
    'log_activities' => 'Activity logs',
    'log_access' => 'Access logs',
    'save' => 'Save',
    'remove' => 'Remove',
    'order_already_exists' => 'There is already an open similar order!',
    'changelog' => 'Changelog',
    'apply' => 'Apply',
    'clean' => 'Clean',
    'actions' => 'Actions',
    'back' => 'Back',
    'exit' => 'Exit',
    'saudacao' => 'Hi',
    'click_here' => 'Click here',

    //-- Forms
    'only_edit_mode' => 'Only available in edit mode',
    'no_regs_found' => 'No records found!',
    'validation_unique_error' => 'A record with the entered value already exists',
    'validation_required' => 'The field {field} is required',
    'permanent_delete'  => '{value} occurrences were permanently deleted',
    'error_create' => 'Error creating record',

    //-- Listing
    'filters_clean' => 'Clean filters',
    'filters' => 'Filters',
    'filters_apply' => 'Apply filters',
    'filters_any' => 'Filter by any fields',
    'filters_by_field' => 'Filter by field',

    //-- Patients API's errors
    'patient_code_generate_error' => 'Patient code not generated',
    'not_future_date' => 'Future dates is not permitted',

    //-- Clinics Users
    'user_has_role' => 'User already registered',
    'clinic_user_invite' => 'Clinic User Invite',
    'email_salutation' => 'Hi',
    'invite_decline_error' => 'error when declining invitation',
    'invite_accept_error' => 'error accepting invite',
    'invite_accepted_msg' => 'invitation successfully accepted',
    'invite_declined_msg' => 'invitation successfully declined',

    //-- Exams
    'pre_intervention_has_child' => 'Pre intervention already in use!',
    'exam_in_use' => 'Exam in use!',
    'error_desc' => 'The following error has occurred: “{error_type}" And {error_action} is not allowed. Please try again or contact support for assistance.',
    'remove_exam' => 'Remove exam',
    'exam_removed' => 'Exam removed successfully!',
    'exam_removed_desc' => 'The exam was removed successfully!',
    'exam_remove_fail' => 'Failed to remove exam!',
    'exam_failed' => 'Exam in use or not allowed to change!',
    'confirm_remove' => 'Confirm remove',
    'exam_check' => 'Are you sure you want to remove this exam?',

    //-- Answers Default
    'default' => [
        'yes' => 'Yes',
        'no' => 'No',
    ],

    //-- Idioms
    'idioms' => [
        'en' => 'English',
        'es' => 'Spanish',
        'tr' => 'Turkish',
        'de' => 'German',
        'hu' => 'Hungarian',
    ],

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
