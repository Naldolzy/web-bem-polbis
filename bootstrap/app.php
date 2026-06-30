<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => route('admin.login'));
        $middleware->alias([
            'superadmin' => \App\Http\Middleware\IsSuperAdmin::class,
            'site.locked' => \App\Http\Middleware\CheckSiteLocked::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (isset($_ENV['VERCEL']) || isset($_ENV['VERCEL_URL'])) {
    $tmpStorage = '/tmp/storage';
    if (!is_dir($tmpStorage)) {
        mkdir($tmpStorage, 0777, true);
        mkdir($tmpStorage . '/framework/cache/data', 0777, true);
        mkdir($tmpStorage . '/framework/views', 0777, true);
        mkdir($tmpStorage . '/framework/sessions', 0777, true);
        mkdir($tmpStorage . '/logs', 0777, true);
    }
    $app->useStoragePath($tmpStorage);
    putenv('LOG_CHANNEL=stderr');
    
    // Pindahkan semua file cache Laravel ke /tmp (Vercel Read-Only Filesystem Fix)
    putenv('APP_SERVICES_CACHE=' . $tmpStorage . '/framework/cache/services.php');
    putenv('APP_PACKAGES_CACHE=' . $tmpStorage . '/framework/cache/packages.php');
    putenv('APP_CONFIG_CACHE=' . $tmpStorage . '/framework/cache/config.php');
    putenv('APP_ROUTES_CACHE=' . $tmpStorage . '/framework/cache/routes.php');
    putenv('APP_EVENTS_CACHE=' . $tmpStorage . '/framework/cache/events.php');
}

return $app;

