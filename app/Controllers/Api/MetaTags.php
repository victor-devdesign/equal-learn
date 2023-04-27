<?php

namespace App\Controllers\Api;

use App\Controllers\Core\ApiController;

class MetaTags extends ApiController
{
    public function getMetaTags()
    {
        header("Access-Control-Allow-Headers: Authorization, Content-Type");
        header("Access-Control-Allow-Origin: *");
        header('content-type: application/json; charset=utf-8');

        return json_encode('teste');
    }
}
