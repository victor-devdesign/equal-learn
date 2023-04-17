<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * @param IncomingRequest $request
     * @param mixed|null      $arguments
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $isAPI  = $request->hasHeader('Accept') && $request->header('Accept')->getValue() === 'application/json';
        $isAjax = $request->isAJAX();

        if ($isAPI || $isAjax) {
            return;
        }

        $tpl = new \App\Libraries\Template();

        return service('response')->setBody(
            $tpl->parser->render('layout/layout')
        );
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
