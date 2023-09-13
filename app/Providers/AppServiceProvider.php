<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domain\Services\HgbrasilService;
use App\Lib\HttpClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HgbrasilService::class, function ($app) {
            $baseUrl = config('services.hgbrasil.base_url');
            $token = config('services.hgbrasil.api_token');
            $code = config('services.hgbrasil.api_code');

            return new HgbrasilService(new HttpClient(), $baseUrl, $token, $code);
        });
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
