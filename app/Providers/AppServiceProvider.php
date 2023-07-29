<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        \Blade::directive('livewireScriptPath', function () {
            $appUrl = config('livewire.asset_url', rtrim($options['asset_url'] ?? '', '/'));

            $manifest = json_decode(file_get_contents(base_path('vendor/livewire/livewire/dist/manifest.json')), true);
            $versionedFileName = $manifest['/livewire.js'];

            $fullAssetPath = "{$appUrl}/livewire{$versionedFileName}";

            if (file_exists(public_path('vendor/livewire/manifest.json'))) {
                $publishedManifest = json_decode(file_get_contents(public_path('vendor/livewire/manifest.json')), true);
                $versionedFileName = $publishedManifest['/livewire.js'];

                $fullAssetPath = ((($_ENV['SERVER_SOFTWARE'] ?? null) === 'vapor') ? config('app.asset_url') : $appUrl).'/vendor/livewire'.$versionedFileName;
            }

            return $fullAssetPath;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
