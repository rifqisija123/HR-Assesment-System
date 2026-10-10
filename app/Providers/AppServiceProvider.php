<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('system_settings')) {
            try {
                $lifetime = SystemSetting::getValue('session_lifetime_minutes');
                if ($lifetime && is_numeric($lifetime)) {
                    config(['session.lifetime' => (int) $lifetime]);
                }
            } catch (\Throwable $e) {
                // Ignore
            }
        }
    }
}
