<?php

namespace Fxcjahid\LaravelAssetsManager\Foundation\Asset\Directive;

use Illuminate\Support\Facades\Blade;
use Fxcjahid\LaravelAssetsManager\Events\CollectingAssets;
use Fxcjahid\LaravelAssetsManager\Foundation\Asset\Pipeline\AssetPipeline as AssetPipeline;

class RegisterAssetsCss
{
    /**
     * The instance of AssetPipeline.
     *
     * @var AssetPipeline
     */
    private $assetPipeline;

    /**
     * Create a new composer instance.
     *
     * @param AssetPipeline $assetPipeline
     */
    public function __construct(AssetPipeline $assetPipeline)
    {
        $this->assetPipeline = $assetPipeline;
    }

    public function directive()
    {
        event(new CollectingAssets($this->assetPipeline));

        Blade::directive("assetsCss", function ($expression) {
            return "<?php echo 'xxx'; ?>";
        });
    }
}
