<?php

namespace App\Providers;

use App\Models\ProductCategories;
use App\Models\Task;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * 
     * 
     * 
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('dashboard-list', Auth::user());
                if (auth()->user()->role == 'employee') {
                    $countTask = Task::where('status', 'pending')
                        ->where('employee_id', auth()->user()->employeeProfile->id)
                        ->count();
                    View::share('countTask', $countTask);
                }
            } else {
                $view->with('dashboard-list', null);
            }
        });
    }
}
