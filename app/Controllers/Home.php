<?php

namespace App\Controllers;

use App\Controllers\Core\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $tpl = new \App\Libraries\Template();
        return $tpl->parser->setData([
            'teste' => 'Isso é um teste',
        ])->render('pages/Home/index.html');
    }

    // --------------------------------------------------------------------
}
