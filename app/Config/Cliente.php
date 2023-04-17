<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Cliente extends BaseConfig
{
    /**
     * Versão de cache de recursos estáticos
     *
     * @var string
     */
    public $cacheVersion = '0.0,1';

    /**
     * Título padrão da página quando não informado
     *
     * @var string
     */
    public $defaultTitle = 'Equal Learn';

    /**
     * Descrição padrão da página
     *
     * @var string
     */
    public $defaultDescription = '';

    /**
     * Cor de tema padrão para ser utilizada em meta tags
     *
     * @var string
     */
    public $themeColor = '';

    /**
     * Cor de tema secundária para ser utilizada em fins secundários
     *
     * @var string
     */
    public $secondaryColor = '';

    /**
     * Favicon
     *
     * @var string
     */
    public $favicon = '';

    /**
     * Logo
     *
     * @var string
     */
    public $portalLogo = '';

    /**
     * Conjunto de definições para open graph
     *
     * [identificador] => [opcoes]
     *
     * @var array<int,Item>
     */
    public $openGraph = [];

    /**
     * Conjunto de definições para SEO
     *
     * [identificador] => [opcoes]
     *
     * @var array
     */
    public $seoConfig = [];

    /**
     * Método padrão de upload
     * 
     * local = Interno
     * aws = AWS
     * azure = Azure
     *
     * @var string
     */
    public $defaultUploader = 'local'; 

    public function __construct()
    {
        parent::__construct();
        helper('url');
        //-- Definições padrões de openGraph
        $this->openGraph = [
            'default' => [
                'title' => $this->defaultTitle,
                'type' => 'website',
                'url' => current_url(),
                'image' => $this->favicon,
            ],
        ];
        //-- Definições padrões de SEO
        $this->seoConfig = [
            'default' => [
                'title_page' => $this->defaultTitle,
                'title_content' => $this->defaultTitle,
                'description' => $this->defaultDescription,
            ],
        ];
    }

}
