<?php

namespace Fxcjahid\LaravelAssetsManager\Foundation\Asset\Types;

use Nwidart\Modules\Facades\Module;

class PublicAsset extends Asset implements AssetType
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function url()
    {
        return $this->asset(
            asset($this->path),
        );
    }
}
