<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = Setting::all();
            $appearance = [];
            foreach ($settings as $setting) {
                $appearance[$setting->key] = trim($setting->value);
            }
            $view->with('appearance', $appearance);
        });
    }
}
