<?php
/**
 * Created by PhpStorm.
 * User: Neha
 * Date: 3/20/2020
 * Time: 5:58 PM
 */

namespace chirag\Employee;

use Illuminate\Http\Resources\Json\Resource;
use \Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class EmployeeBaseServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Console\CreateEmployeeCommand::class,
            Console\GetEmployeeCommand::class,
            Console\DeleteEmployeeConsole::class,
            Console\CreateEmpWebHistory::class,
            Console\GetEmpWebHistory::class,
            Console\DeleteEmpWebHistory::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerRoutes();
        $this->registerPublishing();
        Resource::withoutWrapping();
    }

    /**
     * Register the migration.
     */
    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        });
    }


    /**
     * Get the Employee route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'prefix' => CustomSetting::path(),
            'middleware' => "api",
            'namespace' => 'chirag\Employee\Http\Controllers',
        ];
    }

    protected function registerPublishing() {
        $this->publishes([
            __DIR__ . '/../config/employee-config.php' => config_path('employeeconfig.php'),
        ], 'employee-config');
    }

}