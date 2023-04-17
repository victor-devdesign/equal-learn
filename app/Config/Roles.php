<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Roles extends BaseConfig
{
    /**
     * Definições de funções internas
     *
     * @var array
     */
    protected $internal = [
        'admin' => [
            ['url' => 'Home', 'name' => 'FormLabels.countries.home', 'icon' => 'far fa-home'],
        ],
        'assistant' => [
            ['url' => 'Home', 'name' => 'FormLabels.countries.home', 'icon' => 'far fa-home'],
        ],
    ];

    /**
     * Funções definidas no projeto (cliente)
     *
     * @var array
     */
    protected $project = [];

    /**
     * Template de item de menu
     *
     * @var string
     */
    protected $template = '<div class="menu-item"><a href="{menu__url}" alt="{menu__name}" class="text-body"><i class="{menu__icon} fa-fw float-end"></i> {menu__name}</a></div>';

    public function __construct()
    {
        parent::__construct();
        //-- Tradução de roles
        foreach ($this->internal as $role => $items) {
            foreach ($items as $inc => $item) {
                $langKey = $item['name'];
                $translated = lang($langKey);
                if ($translated != $langKey) {
                    $this->internal[$role][$inc]['name'] = $translated;
                }
            }
        }
    }

    /**
     * Gera o menu HTML
     *
     * @return void
     */
    public function getMenuHtml()
    {
        $rolesMenu = $this->getMenuArray();
        if (empty($rolesMenu)) {
            return '';
        }
        $parser = \Config\Services::parser();
        $menuHtml = '';
        foreach ($rolesMenu as $name => $item) {
            $tmp = [];
            $tmp['menu__url'] = base_url($item['url']);
            $tmp['menu__name'] = $item['name'];
            $tmp['menu__icon'] = $item['icon'];
            $menuHtml .= $parser->setData($tmp, 'raw')->renderString($this->template);
        }
        return $menuHtml;
    }

    /**
     * Organiza os menus de acordo com os direitos de acesso do usuário logado
     *
     * @return array
     */
    public function getMenuArray()
    {
        // $oUser = getCurrentUser();
        // if ($oUser === false) {
        //     return [];
        // }
        // $rolesMenu = [];
        // foreach ($oUser->roles as $role) {
        //     if (isset($this->internal[$role])) {
        //         foreach ($this->internal[$role] as $item) {
        //             $rolesMenu[$item['name']] = $item;
        //         }
        //     }
        //     if (isset($this->project[$role])) {
        //         foreach ($this->project[$role] as $item) {
        //             $rolesMenu[$item['name']] = $item;
        //         }
        //     }
        // }
        // ksort($rolesMenu);
        // $rolesMenu['logoff'] = ['url' => 'Login/Sair', 'name' => lang('Roles.logoff'), 'icon' => 'far fa-sign-out'];
        // return $rolesMenu;
    }
}
