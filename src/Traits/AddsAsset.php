<?php

namespace Fxcjahid\LaravelAssetsManager\Traits;

use Fxcjahid\LaravelAssetsManager\Events\CollectingAssets;

trait AddsAsset
{
    /**
     * Add given assets to the given routes response.
     *
     * @param array|string $routes
     * @param array $assets
     * @return void
     */
    public function addAssets($routes, array $assets)
    {
        $this->app['events']->listen(CollectingAssets::class, function (CollectingAssets $event) use ($routes, $assets) {
            if ($event->onRoutes($this->array_wrap($routes))) {
                $event->requireAssets($assets);
            }
        });
    }

    /**
     * Wrap the given value in an array if it is not already an array.
     *
     * @param  mixed  $value
     * @return array
     */
    function array_wrap($value)
    {
        if (is_array($value)) {
            return $value;
        }

        return $value === null ? [] : [$value];
    }
}
