<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'auth'          => AuthFilter::class, //-- Filtro de autenticação de padrão
        'invalid_chars'  => InvalidChars::class,
        'honeypot'      => Honeypot::class,
        'secure_headers' => SecureHeaders::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            'honeypot',
            'csrf' => [
                'except' => [
                    'Api/Payments/Notification/*',
                    'tools/cron/*',
                    'api/*'
                ],

            ],
            'invalid_chars',
            'auth',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secure_headers',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        'auth_admin' => ['before' => ['admin', 'admin/*'], 'after' => ['admin', 'admin/*']],
        'auth_assistant' => ['before' => ['assistant', 'assistant/*'], 'after' => ['assistant', 'assistant/*']],
    ];
}
