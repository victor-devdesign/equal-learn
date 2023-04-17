<?php

namespace App\Controllers;

use App\Controllers\Core\BaseController;

class About extends BaseController
{
    public function index()
    {
        $tpl = new \App\Libraries\Template();
        return $tpl->parser->setData([
            'name' => 'Victor',
        ])->render('pages/About/index.html');
    }

    // --------------------------------------------------------------------
}
