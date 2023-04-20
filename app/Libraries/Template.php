<?php

namespace App\Libraries;

class Template
{

    /**
     * Instância do parser
     *
     * @var \CodeIgniter\View\Parser
     */
    public $parser;

    /**
     * Configurações do cliente
     *
     * @var \Config\Cliente
     */
    protected $cfgCliente;

    public function __construct()
    {
        $this->cfgCliente = new \Config\Cliente();
        $this->parser = \Config\Services::parser();

        $this->parser->setData([
            'layout_scripts_before' => '',
            'layout_scripts_after' => '',
            'layout_content' => '',
            'roles_menu' => '',
            'theme_color' => $this->cfgCliente->themeColor,
            'secondary_color' => $this->cfgCliente->secondaryColor,
            'cache_version' => getenv('CI_ENVIRONMENT') == 'development' ? date('YmdHis') : $this->cfgCliente->cacheVersion,
            'base_url' => base_url(),
            'favicon_url' => base_url($this->cfgCliente->favicon),
            'logo_url' => base_url($this->cfgCliente->smallLogo),
        ]);
        $this->parser->setData([
            'csrf_field' => csrf_field(),
            'csrf_hash' => csrf_hash(),
        ], 'raw');

        $this->setSeoData('default')->setOgData('default')->generateUserRolesMenus();
    }

    /**
     * Define meta tags para SEO
     *
     * @param string $chave
     * @return Template
     */
    public function setSeoData(string $chave)
    {
        $data = $this->cfgCliente->seoConfig[$chave] ?? $this->cfgCliente->seoConfig['default'];
        $this->parser->setData([
            'seo_title_page' => $data['title_page'],
            'seo_title_content' => $data['title_content'],
            'seo_description' => $data['description'],
        ]);
        return $this;
    }

    /**
     * Define Open Graph por chave
     *
     * @param string $chave
     * @return Template
     */
    public function setOgData(string $chave)
    {
        $data = $this->cfgCliente->openGraph[$chave] ?? $this->cfgCliente->openGraph['default'];
        $this->parser->setData([
            'og_title' => $data['title'],
            'og_type' => $data['type'],
            'og_url' => $data['url'],
            'og_image' => base_url($data['image']),
        ]);
        return $this;
    }

    /**
     * Gera o menu de ações do usuário logado
     *
     * @return Template
     */
    public function generateUserRolesMenus()
    {
        $cfgRoles = new \Config\Roles();
        $this->parser->setData([
            'current_user_roles' => $cfgRoles->getMenuHtml(),
        ], 'raw');
        return $this;
    }

    /**
     * Define dados do usuário logado
     *
     * @param object $oUser
     * @return Template
     */
    public function setCurrentUserData(object $oUser)
    {
        $userData = [
            'current_user_id' => $oUser->id,
            'current_user_name' => $oUser->name,
            'current_user_role' => $oUser->role,
            'current_user_email' => $oUser->email,
        ];
        if (!empty($oUser->file_photo)) {
            $userData['current_user_photo'] = $oUser->file_photo;
        }
        $this->parser->setData($userData);
        return $this;
    }
}
