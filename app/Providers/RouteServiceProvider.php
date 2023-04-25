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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    public const DashBord = '/dash';

    protected $namespace='App\\Http\\Controllers';
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            //Admin Routes
            Route::prefix('dash')
             ->middleware('admin:admin')
            ->namespace($this->namespace)
           ->group(base_path('routes/admin.php'));
//            End Admin Routes

//            Api Routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
//         End Api Routes

//            User Routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
//        End User Routes
        $this->configureRateLimiting();

    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
