<?php

namespace App\Database\Dictionary;

use App\Database\Dictionary\BaseDictionary;

class Users extends BaseDictionary
{

    public $table = 'users';

    public $tableName = 'FormLabels.users.table_name';

    public $relations = [
        'countries_id' => [
            'target_table' => 'countries',
            'target_id' => 'id',
            'target_desc' => 'name',
            'target_url' => 'api/Countries/List',
            'target_relation' => [
                'id' => 'countries_id'
            ],
        ],
    ];

    public $relationsDeleteCheck = [
        'approvals' => ['approved_by' => 'id'],
        'news' => ['users_id' => 'id'],
        'news_target' => ['users_id' => 'id'],
    ];

    public $rowActions = [
        'edit' => [
            'roles' => ['admin', 'sys_admin', 'clinic_admin'],
            'title' => 'Framework.change',
            'icon' => 'fas fa-pencil',
            'link' => 'href:Admin/Users/Form/[id]',
        ],
        'setpassword' => [
            'roles' => ['admin', 'sys_admin'],
            'title' => 'Framework.password_set',
            'icon' => 'fas fa-key',
            // 'link' => 'modal:Admin/Users/SetPassword/[id]',
            'link' => 'modal:Admin/Users/SendTempPassword/[id]',
        ],
        'access_logs' => [
            'roles' => ['admin', 'sys_admin'],
            'title' => 'Framework.login_access_logs',
            'icon' => 'fas fa-user-shield',
            'link' => 'modal:Admin/Users/LogAccess/[id]',
        ],
        'audit' => [
            'roles' => ['audit', 'admin', 'sys_admin'],
            'title' => 'Framework.changelog',
            'icon' => 'fas fa-user-secret',
            'link' => 'modal:Admin/Audit/ModalOpen/users/[id]',
        ],
    ];

    public $listActions = [
        'new' => [
            'roles' => ['admin', 'sys_admin'],
            'title' => 'Framework.new',
            'icon' => 'fas fa-plus',
            'link' => 'href:Admin/Users/Form',
        ],
    ];

    public $uniques = ['email'];

    public $definition = [
        'id' => [
            'forge' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'auto_increment' => true,
            ],
            'form' => [
                'label' => 'ID',
            ],
            'list' => [
                'display' => 'hidden',
            ],
        ],
        'sys_cri' => [
            'forge' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'form' => [
                'label' => 'FormLabels.common.sys_cri',
            ],
            'list' => [
                'display' => 'no',
            ],
        ],
        'sys_alt' => [
            'forge' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'form' => [
                'label' => 'FormLabels.common.sys_alt',
            ],
            'list' => [
                'display' => 'no',
            ],
        ],
        'sys_del' => [
            'forge' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'form' => [
                'label' => 'FormLabels.common.sys_del',
            ],
            'list' => [
                'display' => 'no',
            ],
        ],
        'name' => [
            'forge' => [
                'name' => 'name',
                'type' => 'VARCHAR',
                'null' => false,
                'default' => null,
                'constraint' => '80',
            ],
            'form' => [
                'label' => 'FormLabels.users.name',
                'decimals' => 0,
                'protected' => false,
                'type' => 'text',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'livre',
                'validation' => 'required|max_length[80]',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'yes',
                'order' => 1,
                'filter' => true,
            ],
        ],
        'email' => [
            'forge' => [
                'name' => 'email',
                'type' => 'VARCHAR',
                'null' => false,
                'default' => null,
                'constraint' => '120',
            ],
            'form' => [
                'label' => 'FormLabels.users.email',
                'decimals' => 0,
                'protected' => false,
                'type' => 'email',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'email',
                'validation' => 'required|max_length[120]',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'yes',
                'order' => 2,
                'filter' => true,
            ],
        ],
        'phone' => [
            'forge' => [
                'name' => 'phone',
                'type' => 'VARCHAR',
                'null' => false,
                'default' => null,
                'constraint' => '20',
            ],
            'form' => [
                'label' => 'FormLabels.users.phone1',
                'decimals' => 0,
                'protected' => false,
                'type' => 'text',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'phone',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'yes',
                'order' => 3,
                'filter' => true,
            ],
        ],
        'password' => [
            'forge' => [
                'name' => 'password',
                'type' => 'VARCHAR',
                'null' => false,
                'default' => null,
                'constraint' => '120',
            ],
            'form' => [
                'label' => 'FormLabels.users.password',
                'decimals' => 0,
                'protected' => true,
                'type' => 'password',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'livre',
                'validation' => 'max_length[120]',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'password_changed' => [
            'forge' => [
                'name' => 'password_changed',
                'type' => 'VARCHAR',
                'null' => false,
                'default' => null,
                'constraint' => '10',
            ],
            'form' => [
                'label' => 'FormLabels.users.password_changed',
                'decimals' => 0,
                'protected' => true,
                'type' => 'text',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'livre',
                'validation' => 'permit_empty|valid_date|max_length[10]',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'role' => [
            'forge' => [
                'name' => 'role',
                'type' => 'VARCHAR',
                'null' => false,
                'default' => null,
                'constraint' => '45',
            ],
            'form' => [
                'label' => 'FormLabels.users.role',
                'decimals' => 0,
                'protected' => false,
                'type' => 'select',
                'class' => '',
                'help' => '',
                'options' => 'FormOptions.users.roles',
                'format' => 'livre',
                'validation' => 'required|in_list[platform_assitant,admin,clinic_user]',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'yes',
                'order' => 5,
                'filter' => true,
                'format' => 'options',
            ],
        ],
        'last_access' => [
            'forge' => [
                'name' => 'last_access',
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'form' => [
                'label' => 'FormLabels.users.last_access',
                'decimals' => 0,
                'protected' => true,
                'type' => 'text',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'datetime',
                'validation' => 'permit_empty|valid_date',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'yes',
                'order' => 4,
                'filter' => false,
            ],
        ],
        'recovery_key' => [
            'forge' => [
                'name' => 'recovery_key',
                'type' => 'VARCHAR',
                'null' => true,
                'default' => null,
                'constraint' => '14',
            ],
            'form' => [
                'label' => 'FormLabels.users.recovery_key',
                'decimals' => 0,
                'protected' => true,
                'type' => 'text',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'livre',
                'validation' => 'permit_empty|max_length[14]',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'active' => [
            'forge' => [
                'name' => 'active',
                'type' => 'VARCHAR',
                'null' => false,
                'default' => 'S',
                'constraint' => '1',
            ],
            'form' => [
                'label' => 'FormLabels.common.active',
                'decimals' => 0,
                'protected' => false,
                'type' => 'select',
                'class' => '',
                'help' => '',
                'options' => 'FormOptions.common.sim_nao',
                'format' => 'livre',
                'validation' => 'required|in_list[S,N]',
                'attr' => [],
                'default_value' => 'S',
            ],
            'list' => [
                'display' => 'yes',
                'order' => 6,
                'filter' => true,
            ],
        ],
        'gender' => [
            'forge' => [
                'name' => 'gender',
                'type' => 'VARCHAR',
                'null' => true,
                'default' => null,
                'constraint' => '1',
            ],
            'form' => [
                'label' => 'FormLabels.users.gender',
                'decimals' => 0,
                'protected' => false,
                'type' => 'select',
                'class' => '',
                'help' => '',
                'options' => 'FormOptions.common.gender',
                'validation' => 'permit_empty|in_list[M,F,O]',
                'format' => 'livre',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'birthday' => [
            'forge' => [
                'name' => 'birthday',
                'type' => 'VARCHAR',
                'null' => true,
                'default' => null,
                'constraint' => '10',
            ],
            'form' => [
                'label' => 'FormLabels.users.birthday',
                'decimals' => 0,
                'protected' => false,
                'type' => 'date',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'data',
                'validation' => 'max_length[10]|valid_date|permit_empty',
                'attr' => [
                ],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'access_type' => [
            'forge' => [
                'name' => 'access_type',
                'type' => 'VARCHAR',
                'null' => true,
                'default' => null,
                'constraint' => '10',
            ],
            'form' => [
                'label' => 'FormLabels.users.access_type',
                'decimals' => 0,
                'protected' => false,
                'type' => 'select',
                'class' => '',
                'help' => '',
                'options' => 'FormOptions.users.access_type',
                'validation' => 'required|in_list[any,api,portal,app]',
                'format' => 'livre',
                'attr' => [],
                'default_value' => 'any',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'terms_accepted_at' => [
            'forge' => [
                'name' => 'terms_accepted_at',
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
                'constraint' => '20',
            ],
            'form' => [
                'label' => 'FormLabels.users.terms_accepted_at',
                'decimals' => 0,
                'protected' => true,
                'type' => 'text',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'datetime',
                'validation' => 'permit_empty|valid_date',
                'attr' => [],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'yes',
                'order' => 8,
                'filter' => true,
            ],
        ],
        'file_photo' => [
            'forge' => [
                'name' => 'file_photo',
                'type' => 'VARCHAR',
                'null' => true,
                'default' => null,
                'constraint' => 255,
            ],
            'form' => [
                'label' => 'FormLabels.users.file_photo',
                'decimals' => 0,
                'protected' => false,
                'type' => 'file',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'livre',
                'validation' => 'max_length[255]',
                'attr' => [
                    'accept' => '.png,.jpg,.jpeg',
                ],
                'default_value' => '',
                'upload_rules' => 'uploaded[file_photo]|mime_in[file_photo,image/png,image/jpg,image/jpeg]|ext_in[file_photo,png,jpg,jpeg]|max_size[file_photo,5240]',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'default_lang' => [
            'forge' => [
                'name' => 'default_lang',
                'type' => 'VARCHAR',
                'null' => true,
                'default' => null,
                'constraint' => 255,
            ],
            'form' => [
                'label' => 'FormLabels.users.default_lang',
                'decimals' => 0,
                'protected' => false,
                'type' => 'select',
                'class' => '',
                'help' => '',
                'options' => 'FormOptions.common.default_lang',
                'format' => 'livre',
                'validation' => 'required|in_list[en,es,tr,de,hu]',
                'attr' => [
                ],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
        'countries_id' => [
            'forge' => [
                'name' => 'countries_id',
                'type' => 'INT',
                'null' => false,
                'default' => NULL,
            ],
            'form' => [
                'label' => 'FormLabels.users.countries_id',
                'decimals' => 0,
                'protected' => false,
                'type' => 'text',
                'class' => '',
                'help' => '',
                'options' => '',
                'format' => 'inteiro',
                'validation' => 'required|max_length[11]|integer',
                'attr' => [
                ],
                'default_value' => '',
            ],
            'list' => [
                'display' => 'no',
                'order' => 0,
                'filter' => false,
            ],
        ],
    ];
}
