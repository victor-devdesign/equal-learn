<?php

namespace App\Controllers\Api;

use App\Controllers\Core\ApiController;

class MetaTags extends ApiController
{
    public function getMetaTags()
    {
        $post = $this->request->getPost();
        if (!isset($post['app'])) {
            $post['app'] = "http://localhost:3000";
        }

        $ret = [
            "url" => $post['app'] . "/",
            "logo" => [
                "small" => $post['app'] . "/assets/img/logo/small_logo.png",
                "medium" => $post['app'] . "/assets/img/logo/medium_logo.png",
                "large" => $post['app'] . "/assets/img/logo/large_logo.png",
            ],
            "metas" => [],
            "user" => [
                "id" => "1",
                "name" => "Cléber da Costa",
                "role" => "free_user",
                "profile" => $post['app'] . "/assets/img/avatar.jpg",
                "roles" => [],
                "permissions" => [],
            ],
        ];

        return $this->respond($ret, 200, "OK");
    }
}
