<?php 

namespace Kyawthet\ErrorShout;

use Illuminate\Support\ServiceProvider;

class ErrorShoutServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
          __DIR__.'/config/config.php', 'errorshout'
      );
    }
    
    public function boot()
    {
       /*  if ($this->app->runningInConsole()) {
            // Export the migration
            if ( !class_exists('CreateNotifyTable') ) {
              $this->publishes([
                __DIR__ . '/database/migrations/create_notifies_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_notifies_table.php'),
                // you can add any number of migrations here
              ], 'migrations');
            }
        }       */

        if ($this->app->runningInConsole()) {

            $this->publishes([
              __DIR__.'/config/config.php' => config_path('errorshout.php'),
            ], 'es-config');

            $this->publishes([
              __DIR__.'/resources/views' => resource_path('views/vendor/errorshout'),
            ], 'es-views');

            $this->publishes([
              __DIR__.'/resources/assets' => public_path('errorshout'),
              ], 'es-assets');
        
          }

          $this->routes();
          $this->migrations();
          $this->views();

    }

    protected function routes()
    {
       $this->loadRoutesFrom(__DIR__.'/routes/web.php');   
    }

    protected function migrations()
    {
       return $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    protected function views()
    {
      // Loading Migrations Automatically (method 2)
      $this->loadViewsFrom(__DIR__.'/resources/views', 'errorshout');
    }
   
}
