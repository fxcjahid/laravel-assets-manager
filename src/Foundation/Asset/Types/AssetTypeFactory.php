<?php

namespace Fxcjahid\LaravelAssetsManager\Foundation\Asset\Types;

use InvalidArgumentException;

class AssetTypeFactory
{
    /**
     * @param $asset
     * @return \Modules\Core\Foundation\Asset\Types\AssetType
     *
     * @throws \InvalidArgumentException
     */
    public function make($asset)
    {
        $typeClass = 'Fxcjahid\LaravelAssetsManager\Foundation\Asset\Types\\' . ucfirst(key($asset)) . 'Asset';

        if (! class_exists($typeClass)) {
            throw new InvalidArgumentException("Asset Type Class [{$typeClass}] not found");
        }

        return new $typeClass(
            $asset[key($asset)],
        );
    }
}
