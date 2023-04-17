<?php

namespace App\Controllers;

use App\Controllers\Core\BaseController;

class Contact extends BaseController
{
    public function index()
    {
        $tpl = new \App\Libraries\Template();
        return $tpl->parser->render('pages/Contact/index.html');
    }

    // --------------------------------------------------------------------
}
