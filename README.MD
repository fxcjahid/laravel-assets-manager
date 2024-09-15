## Laravel Assets Manager

Easy css and js resource management in Laravel

## Install

1. Install package

```bash
composer require fxcjahid/laravel-assets-manager
```

2. Add provider in `config/app.php`

```PHP
  Fxcjahid\LaravelAssetsManager\Providers\AssetsManagerServiceProvider::class,
  Fxcjahid\LaravelAssetsManager\Providers\AssetsBladeServiceProvider::class,
```

## Usage

config for assets example:

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    | These assets are registered on the asset manager.
    |--------------------------------------------------------------------------
    */
    'all_assets'      => [
        'admin.media.css'   => ['Cdn' => 'media:admin/css/media.css'],
        'admin.product.css' => ['Cdn' => 'media:admin/css/media.css'],
        'admin.media.js'    => ['Cdn' => 'media:admin/js/media.js'],
        'admin.product.js'  => ['Cdn' => 'media:admin/js/media.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in all pages
    | through the asset pipeline.
    |--------------------------------------------------------------------------
    */
    'required_assets' => [],
];

```

In your main blade file

```php
 @assetsCss()

 @assetsJS()
```
