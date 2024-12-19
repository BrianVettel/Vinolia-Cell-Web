<?php

namespace App\Providers;

use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::model('user', User::class);
        Route::model('order', ServiceOrder::class);

        Gate::before(function (User $user) {
            if ($user->isAdmin())
            {
                return true;
            }

            return null;
        });

        Gate::define('read-user-orders', function (User $user, User $userInput) {
            return $user->id === $userInput->id;
        });
    }
}
