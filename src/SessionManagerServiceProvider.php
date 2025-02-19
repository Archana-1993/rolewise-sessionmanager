<?php

namespace Itpathsolutions\Sessionmanager;

use Illuminate\Support\ServiceProvider;
use Itpathsolutions\Sessionmanager\Http\Middleware\RoleBasedSessionMiddleware;
use Illuminate\Routing\Router;

class SessionManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'sessionmanager');
        $this->loadMigrationsFrom(database_path('migrations'));
        $this->publishes([
            __DIR__.'/Config/sessionmanager.php' => config_path('sessionmanager.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'migrations');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app['router']->aliasMiddleware('session.timeout', RoleBasedSessionMiddleware::class);

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('role.session', RoleBasedSessionMiddleware::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/sessionmanager.php', 'sessionmanager');
    }
}
