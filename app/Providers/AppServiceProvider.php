<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Service\User\UserService;
use App\Service\User\UserServiceImpl;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Exceptions\RateLimiterSetupException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind( UserService::class,UserServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
            RateLimiter::for('auth', function (Request $request) {
                return Limit::perMinute(3)->by(optional($request->user())->id ?: $request->ip())->response(function (Request $request, array $headers){
                    return response('Too many attempts', 429, $headers);
                });
            });
     
    }
}
