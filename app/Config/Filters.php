<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Adminauth;
use App\Filters\Pdmauth;
use App\Filters\Tnhauth;
use App\Filters\Gdbauth;
use App\Filters\Jijauth;
use App\Filters\Atlauth;
use App\Filters\Kdpauth;

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
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'adminauth'     => Adminauth::class,
        'pdmauth'       => Pdmauth::class,
        'tnhauth'       => Tnhauth::class,
        'gdbauth'       => Gdbauth::class,
        'jijauth'       => Jijauth::class,
        'atlauth'       => Atlauth::class,
        'kdpauth'       => Kdpauth::class,
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
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
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
        'adminauth' => ['before' => ['admin', 'admin/*']],
        'pdmauth' => ['before' => ['pdm', 'pdm/*']],
        'tnhauth' => ['before' => ['tnh', 'tnh/*']],
        'gdbauth' => ['before' => ['gdb', 'gdb/*']],
        'jijauth' => ['before' => ['jij', 'jij/*']],
        'atlauth' => ['before' => ['atl', 'atl/*']],
        'kdpauth' => ['before' => ['kdp', 'kdp/*']],
    ];
}
