<?php

namespace App\Providers;
use Illuminate\Support\Facades\Request;

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
        $layout = 'layouts.frontend'; 

        if (auth()->check()) {
            if (auth()->user()->role === USER_ROLE_ADMIN || auth()->user()->role === USER_ROLE_STAFF) {
                $layout = 'layouts.admin';
            } elseif (auth()->user()->role === USER_ROLE_USER) {
                $layout = 'layouts.user';
            }
        } elseif (Request::is('admin/*')) {
            $layout = 'layouts.admin';
        } elseif (Request::is('user/*')) {
            $layout = 'layouts.user';
        }
        config(['livewire.layout' => $layout]);
    }
}
