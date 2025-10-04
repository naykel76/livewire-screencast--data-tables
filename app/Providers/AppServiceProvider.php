<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
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
        // Only auto-login if running in the browser and users table exists
        if (app()->runningInConsole() === false && 
            \Illuminate\Support\Facades\Schema::hasTable('users') && 
            \App\Models\User::count() > 0) {
            auth()->login(\App\Models\User::first());
        }

        Builder::macro('toCsv', function ($name = null) {
            $query = $this;

            return response()->streamDownload(function () use ($query) {
                $results = $query->get();

                if ($results->count() < 1) return;

                $titles = implode(',', array_keys((array) $results->first()->getAttributes()));

                $values = $results->map(function ($result) {
                    return implode(',', collect($result->getAttributes())->map(function ($thing) {
                        return '"'.$thing.'"';
                    })->toArray());
                });

                $values->prepend($titles);

                echo $values->implode("\n");
            }, $name ?? 'export.csv');
        });
    }
}
