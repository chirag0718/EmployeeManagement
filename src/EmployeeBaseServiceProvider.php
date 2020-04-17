<?php


namespace chirag\Employee;

use chirag\Employee\Repositories\EmployeeRepositoryInterface;
use chirag\Employee\Repositories\EmployeeRepository;
use chirag\Employee\Repositories\EmpWebHistoryRepository;
use chirag\Employee\Repositories\EmpWebHistoryRepositoryInterface;
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
        // Passing the all commands
        $this->commands([
            Console\CreateEmployeeCommand::class,
            Console\GetEmployeeCommand::class,
            Console\DeleteEmployeeConsole::class,
            Console\CreateEmpWebHistory::class,
            Console\GetEmpWebHistory::class,
            Console\DeleteEmpWebHistory::class,
        ]);

        // Binding the employee reepositry
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        // Binding the employeewebhistory repository
        $this->app->bind(
            EmpWebHistoryRepositoryInterface::class,
            EmpWebHistoryRepository::class
        );
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
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
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

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/employee-config.php' => config_path('employeeconfig.php'),
        ], 'employee-config');
    }

}