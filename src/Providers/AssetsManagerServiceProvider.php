<?php

namespace Fxcjahid\LaravelAssetsManager\Providers;

use Illuminate\Support\ServiceProvider;
use Fxcjahid\LaravelAssetsManager\Foundation\Asset\Pipeline\AssetPipeline;
use Fxcjahid\LaravelAssetsManager\Foundation\Asset\Types\AssetTypeFactory;
use Fxcjahid\LaravelAssetsManager\Foundation\Asset\Manager\FleetCartAssetManager;
use Fxcjahid\LaravelAssetsManager\Foundation\Asset\Pipeline\FleetCartAssetPipeline;
use Fxcjahid\LaravelAssetsManager\Events\CollectingAssets;

class AssetsManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge default configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/assets.php', 'assets');

        // Register asset manager as singleton
        $this->app->singleton(FleetCartAssetManager::class);


        $this->app->singleton('asset-manager', function ($app) {

            $assetPipeline = $app->make(AssetPipeline::class);

            event(new CollectingAssets($assetPipeline));

            return $assetPipeline;
        });

        $this->app->singleton(AssetPipeline::class, function ($app) {
            return new FleetCartAssetPipeline($app[FleetCartAssetManager::class]);
        });
    }

    public function boot()
    {
        // Publish the config file
        $this->publishes([
            __DIR__ . '/../config/assets.php' => config_path('assets.php'),
        ], 'config');

        self::addAssets(
            config('assets', []),
        );
    }

    /**
     * Add the assets from the config file on the asset manager.
     *
     * @param array $allAssets
     * @return void
     */
    private function addAssets($assets)
    {
        // Add all assets to the AssetManager
        foreach ($assets['all_assets'] as $assetName => $assetPath) {

            $url = $this->app[AssetTypeFactory::class]->make($assetPath)->url();

            $this->app[FleetCartAssetManager::class]->addAsset($assetName, $url);
        }

        // Add required assets directly to the AssetPipeline
        // $this->app[AssetPipeline::class]->requireAssets($assets['all_assets']);
    }
}
