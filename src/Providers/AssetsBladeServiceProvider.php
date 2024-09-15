<?php

namespace Fxcjahid\LaravelAssetsManager\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Fxcjahid\LaravelAssetsManager\Events\CollectingAssets;
use Fxcjahid\LaravelAssetsManager\Foundation\Asset\Pipeline\AssetPipeline;

class AssetsBladeServiceProvider extends ServiceProvider
{
    public function boot(AssetPipeline $assetPipeline)
    {
        Blade::directive('assetsCss', function () use ($assetPipeline) {
            return $this->registerAssetsCss($assetPipeline);
        });

        Blade::directive('assetsJS', function () use ($assetPipeline) {
            return $this->registerAssetsJS($assetPipeline);
        });
    }

    protected function registerAssetsCss($assetPipeline)
    {
        event(new CollectingAssets($assetPipeline));

        $assets = $assetPipeline->allCss();

        foreach ($assets as $cssFile) {
            return '<link rel="stylesheet" href="' . $cssFile . '" />' . PHP_EOL;
        }
    }

    protected function registerAssetsJS($assetPipeline)
    {
        event(new CollectingAssets($assetPipeline));

        $assets = $assetPipeline->allJs();

        foreach ($assets as $jsFile) {
            return '<script type="text/javascript" src="' . $jsFile . '" />' . PHP_EOL;
        }
    }
}
