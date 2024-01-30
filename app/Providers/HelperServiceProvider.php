<?php 

namespace App\Providers;

use Artisan;
use Hashids\Hashids;
use ReflectionClass;
use Sentinel\Commands\SentinelPublishCommand;
use Sentinel\Repositories\Session\SentrySessionRepository;
use Sentinel\Repositories\Group\SentryGroupRepository;
use Sentinel\Repositories\User\SentryUserRepository;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Find path to the package
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register the Sentry Service Provider
        
       foreach (glob(app_path().'/Helpers/*.php') as $filename){
            require_once($filename);
        }

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return true;
    }

    /**
     * Register the Artisan Commands
     */
    

}
