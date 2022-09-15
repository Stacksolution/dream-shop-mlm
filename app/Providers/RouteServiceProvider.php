<?php
namespace App\Providers;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
class RouteServiceProvider extends ServiceProvider {
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot() {
        parent::boot();
        $this->configureRateLimiting();
    }
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        $this->mapAdminRoutes();
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapCronRoutes();
    }
    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes() {
        Route::middleware('web')->group(base_path('routes/back-end.php'));
    }
    /**
     * Define the "api's" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::middleware('web')->group(base_path('routes/api.php'));
    }
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
        Route::middleware('web')->group(base_path('routes/web.php'));
    }
    /**
     * Define the "cron jobs" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapCronRoutes() {
        Route::middleware('web')->group(base_path('routes/crons.php'));
    }
    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting() {
        RateLimiter::for ('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user() ?->id ? : $request->ip());
        });

        RateLimiter::for ('payout', function (Request $request) {
            return Limit::perMinute(15)->by($request->user() ?->id ? : $request->ip());
        });
    }
}
