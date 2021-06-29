<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            \App\Repositories\DocumentRepositoryInterface::class,
            \App\Repositories\DocumentRepository::class
        );
        $this->app->bind(
            \App\Repositories\ContactRepositoryInterface::class,
            \App\Repositories\ContactRepository::class
        );

        $this->app->bind(
            \App\Repositories\ContentRepositoryInterface::class,
            \App\Repositories\ContentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
