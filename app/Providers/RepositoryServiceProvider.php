<?php

namespace App\Providers;

use App\Repositories\MessageRepository;
use App\Repositories\MessageRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MessageRepository::class, MessageRepositoryEloquent::class);
        //:end-bindings:
    }
}
