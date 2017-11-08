<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $interfaceDirectory = __DIR__ .'/../Repositories/Interfaces';
        $interfaceFiles = scandir($interfaceDirectory);

        foreach ($interfaceFiles as $interfaceFile){
            if($interfaceFile === '.' || $interfaceFile === '..'){
                continue;
            }

            $interfaceFile = rtrim($interfaceFile, '.php');
            $repositoryFile = ltrim($interfaceFile, 'I').'Repository';

            $this->app->bind("App\Repositories\Interfaces\\$interfaceFile", "App\Repositories\\$repositoryFile");
        }
    }
}
