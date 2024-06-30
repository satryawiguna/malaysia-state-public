<?php
namespace FreshCMS\MalaysiaState;

use Illuminate\Support\ServiceProvider;

class MalaysiaStateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        $this->publishes([
            __DIR__ . '/Database/Seeders/' => database_path('seeders'),
        ], 'seeders');
    }

    public function register()
    {
        $this->commands([
            Console\Commands\ImportMalaysiaState::class,
        ]);
    }
}
