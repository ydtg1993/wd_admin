<?php

namespace App\Providers\Es;


use App\Providers\Es\Model\VideoModel;
use Illuminate\Support\ServiceProvider;


class EsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(VideoModel::class,'video');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
