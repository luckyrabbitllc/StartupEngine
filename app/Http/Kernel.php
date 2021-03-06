<?php

namespace App\Http;

use App\Http\Middleware\Backend;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\HttpsProtocol::class,
            \App\Http\Middleware\PromoCode::class,
            //\App\Http\Middleware\ForceHttps::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class
        ],

        'backend' => [\App\Http\Middleware\Backend::class],

        'api' => ['throttle:200,1', 'bindings', 'auth:api', 'apirbac']
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        //'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        // 'auth.optional' => \App\Http\Middleware\OptionalAuthentication::class,*/
        'auth' => \App\Http\Middleware\OptionalAuthentication::class,
        'apirbac' => \App\Http\Middleware\ApiRbac::class,
        'webrbac' => \App\Http\Middleware\WebRbac::class,
        'auth.default' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' =>
            \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'permission' =>
            \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'cors' => \App\Http\Middleware\Cors::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'promo-code' => \App\Http\Middleware\PromoCode::class,
        'feature' => \App\Http\Middleware\PreReleaseFeature::class
    ];
}
