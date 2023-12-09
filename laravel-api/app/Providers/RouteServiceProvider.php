<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->namespace($this->namespace)
                ->group(function () {
                    /*
                     * Routes for api
                     */
                    Route::middleware([])
                        ->prefix('api')
                        ->namespace('Api')
                        ->group(function () {
                            Route::prefix('users')
                                ->name('users.')
                                ->group(base_path('routes/V1/User.php'));

                            Route::prefix('restaurants')
                            ->name('restaurants.')
                            ->group(base_path('routes/V1/Restaurant.php'));

                            Route::prefix('categories')
                            ->name('categories.')
                            ->group(base_path('routes/V1/Category.php'));

                            Route::prefix('foods')
                            ->name('foods.')
                            ->group(base_path('routes/V1/Food.php'));

                            Route::prefix('contacts')
                            ->name('contacts.')
                            ->group(base_path('routes/V1/Contact.php'));

                            Route::prefix('socials')
                            ->name('socials.')
                            ->group(base_path('routes/V1/Social.php'));
                        });
                });

            /*
             * Removed because not using
             */
            // Route::middleware('web')
            //     ->group(base_path('routes/web.php'));
        });
    }
}
