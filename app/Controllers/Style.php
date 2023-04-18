<?php

namespace App\Controllers;

use App\Controllers\Core\BaseController;

class Style extends BaseController
{
    public function index()
    {
        $tpl = new \App\Libraries\Template();
        return $tpl->parser->render('pages/Style/index.html');
    }

    // --------------------------------------------------------------------
}
