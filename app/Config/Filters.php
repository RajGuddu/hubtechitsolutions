<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\JWTAuthenticationFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'AuthCheck'     => \App\Filters\AuthCheckFilter::class,
        'AlreadyLoggedIn' => \App\Filters\AlreadyLoggedInFilter::class,
        'NoAccessFilter' => \App\Filters\NoAccessFilter::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => JWTAuthenticationFilter::class, // add this line
        'InternAlreadyLoggedIn' => \App\Filters\InternAlreadyLoggedInFilter::class,
        'InternAuthCheck' => \App\Filters\InternAuthCheckFilter::class,
        'internProfileComplete' => \App\Filters\internProfileComplete::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => ['except' => ['home/save_contact_us','/intern-update-examinee-duration','/intern-exam-save-result']],
            // 'invalidchars',
        ],
        'after' => [
            //'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'auth' => [
            'before' => [
                'client/*',
                'client'
          ],
        ]
    ];
}
