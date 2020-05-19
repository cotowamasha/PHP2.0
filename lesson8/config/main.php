<?php
return [
    'title' => 'Мой магазин',
    'defaultControllerName' => 'main',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'dbname' => 'gbphp',
                'charset' => 'UTF8',
                'username' => 'root',
                'password' => '',
            ]
        ],
        'twigRenderer' => [
            'class' => \App\services\renderers\TwigRenderer::class
        ],
        'request' => [
            'class' => \App\services\Request::class
        ],
        'GoodRepository' => [
            'class' => \App\repositories\GoodRepository::class
        ],
        'basketServices' => [
            'class' => \App\services\BasketServices::class
        ],
        'OrderRepository' => [
            'class' => \App\repositories\OrderRepository::class
        ],
        'AuthRepository' => [
            'class' => \App\repositories\AuthRepositiry::class
        ],
    ]
];
