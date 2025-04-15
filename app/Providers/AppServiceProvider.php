<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        Inertia::share([
            'auth' => fn () => [
                'user' => Auth::user(),
            ],
            'chatDriver' => fn () => Auth::check()
                ? User::where('user_type', 0)->select('id', 'first_name', 'last_name')->get()
                : [],
            'adminId' => fn () => User::where('user_type', 1)->value('id'), // ✅ FIXED
        ]);
    }
}
