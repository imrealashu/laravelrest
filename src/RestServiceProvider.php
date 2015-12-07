<?php

namespace imrealashu\laravelrest;

use Illuminate\Support\ServiceProvider;

class RestServiceProvider extends ServiceProvider
{

    protected $commands = [
        'imrealashu/LaravelRest/Console/RestInstallCommand',
        'imrealashu/LaravelRest/Console/RestNewCommand',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/laravel-rest-config.php' => config_path('laravel-rest-config.php'),
        ]);
        $this->publishes([
            __DIR__.'/Controllers/ApiController.php' => app_path('Http/Controllers/API/ApiController.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
       //$this->commands($this->commands);
//        $this->registerCommands();
        $this->commands([
            'imrealashu\laravelrest\Console\RestInstallCommand',
            'imrealashu\laravelrest\Console\RestNewCommand'
        ]);
    }
//
//    protected function registerCommands(){
//        $this->registerInstallCommand();
//    }
//
//    protected function registerInstallCommand(){
//
//    }

//    /**
//     * Get the services provided by the provider.
//     *
//     * @return array
//     */
//    public function provides()
//    {
//        return ['LaravelRest.install'];
//    }
}