<?php
return [
    'default' => 'main',
    'connections' => [
        'main' => [
            'salt' => config('app.key'),
            'length' => 12,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        ],
    ],
];
