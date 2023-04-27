<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Honeypot extends BaseConfig
{
    /**
     * Makes Honeypot visible or not to human
     */
    public bool $hidden = true;

    /**
     * Honeypot Label Content
     */
    public string $label = 'Pooh Captcha';

    /**
     * Honeypot Field Name
     */
    public string $name = '_pooh';

    /**
     * Honeypot HTML Template
     */
    public string $template = '<label>{honeypot_label}</label><input type="text" name="{honeypot_name}" value=""/>';

    /**
     * Honeypot container
     *
     * If you enabled CSP, you can remove `style="display:none"`.
     */
    public string $container = '<div class="d-none">{template}</div>';

    /**
     * The id attribute for Honeypot container tag
     *
     * Used when CSP is enabled.
     */
    public string $containerId = 'hpc';

    /**
     * Retorna o campo honeypot
     *
     * @return string
     */
    public function getField()
    {
        $parser = \Config\Services::parser();
        $field = $parser->setData([
            'honeypot_name' => $this->name,
            'honeypot_label' => $this->label,
        ])->renderString($this->template);
        return '<div class="d-none">' . $field . '</div>';
    }

}
