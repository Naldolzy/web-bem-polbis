<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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
        // === Security: force HTTPS in production ===
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // === Performance: disable mass assignment guard (sudah pake $fillable di semua model) ===
        // Hemat overhead validasi tiap insert/update di server kecil
        Model::unguard();

        // === Performance: log slow queries di local untuk debugging ===
        if ($this->app->environment('local')) {
            DB::listen(function ($query) {
                if ($query->time > 500) {
                    \Illuminate\Support\Facades\Log::warning('Slow query detected', [
                        'sql'      => $query->sql,
                        'bindings' => $query->bindings,
                        'time_ms'  => $query->time,
                    ]);
                }
            });
        }
    }
}
