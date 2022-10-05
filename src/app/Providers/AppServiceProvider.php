<?php

namespace App\Providers;

use App\Repositories;
use App\Services\DynamicLink\GeneratorForLocal;
use App\Services\DynamicLink\GeneratorForProduction;
use App\Services\DynamicLink\GeneratorInterface;
use Generator;
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
            Repositories\UserRepositoryInterface::class,
            Repositories\UserRepository::class
        );
        $this->app->bind(
            Repositories\AdminRepositoryInterface::class,
            Repositories\AdminRepository::class
        );
        $this->app->bind(
            Repositories\ProductRepositoryInterface::class,
            Repositories\ProductRepository::class
        );
        $this->app->bind(
            Repositories\StoreRepositoryInterface::class,
            Repositories\StoreRepository::class
        );
        $this->app->bind(
            Repositories\CouponRepositoryInterface::class,
            Repositories\CouponRepository::class
        );
        $this->app->bind(
            Repositories\StampRepositoryInterface::class,
            Repositories\StampRepository::class
        );
        $this->app->bind(
            Repositories\InformationRepositoryInterface::class,
            Repositories\InformationRepository::class
        );
        // プッシュ通知
        $this->app->bind(
            Repositories\NotificationRepositoryInterface::class,
            Repositories\NotificationRepository::class
        );

        if (config('mobile.env') == 'local') {
            $this->app->bind(
                GeneratorInterface::class,
                GeneratorForLocal::class
            );
        } else {
            $this->app->bind(
                GeneratorInterface::class,
                GeneratorForProduction::class
            );
        }
        $this->app->bind(
            Repositories\PointGiftRepositoryInterface::class,
            Repositories\PointGiftRepository::class
        );
        $this->app->bind(
            Repositories\PointRepositoryInterface::class,
            Repositories\PointRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->isSecure()) {
            \URL::forceScheme('https');
        }
    }
}
