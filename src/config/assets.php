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
