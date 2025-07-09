<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], // Hanya angka
    'default' => [
        'length' => 4,
        'width' => 150,
        'height' => 36,
        'quality' => 90,
        'math' => false,
        'expire' => 60,
        'lines' => 1,
        'encrypt' => false,
    ],
    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'math' => true,
    ],

    'flat' => [
        'length' => 1,
        'width' => 140,
        'height' => 55,
        'quality' => 90,
        'lines' => 1,
        'bgImage' => true,
        'bgColor' => '#00000000',
        'fontColors' => ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'contrast' => -5,
    ],
    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],
    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => true,
        'contrast' => -5,
    ]
];
