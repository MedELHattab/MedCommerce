<?php

namespace App\Providers;

use App\Repositories\FavorisRepository;
use App\Repositories\FavorisRepositoryInterface;
use App\Repositories\HomeRepository;
use App\Repositories\HomeRepositoryInterface;
use App\Services\FavorisService;
use App\Services\HomeService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Services\CategoryService;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Services\ProductService;
use App\Repositories\CommentRepository;
use App\Repositories\CommentRepositoryInterface;
use App\Services\CommentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Category bindings
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService($app->make(CategoryRepositoryInterface::class));
        });

        // Product bindings
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepositoryInterface::class));
        });

        // Comment bindings
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CommentService::class, function ($app) {
            return new CommentService($app->make(CommentRepositoryInterface::class));
        });

        // Home bindings
        $this->app->bind(HomeRepositoryInterface::class, HomeRepository::class);
        $this->app->bind(HomeService::class, function ($app) {
            return new HomeService($app->make(HomeRepositoryInterface::class));
        });

         // Favoris bindings
         $this->app->bind(FavorisRepositoryInterface::class, FavorisRepository::class);
         $this->app->bind(FavorisService::class, function ($app) {
             return new FavorisService($app->make(FavorisRepositoryInterface::class));
         });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
