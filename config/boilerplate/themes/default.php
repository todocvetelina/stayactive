<?php

/**
 * BG : blue, indigo, purple, pink, red, orange, yellow, green, teal, cyan, gray, gray-dark, black
 * Type : dark, light
 * Shadow : 0-4.
 */
return [
    'navbar'  => [
        'type'   => 'dark',
        'border' => true,
        'user'   => [
            'visible' => true,
            'shadow'  => 0,
        ],
    ],
    'sidebar' => [
        'shadow'  => 4,
        'border'  => false,
        'compact' => false,
        'brand'   => [
            'logo' => [
                'shadow' => 2,
            ],
        ],
        'user'    => [
            'visible' => false,
            'shadow'  => 2,
        ],
    ],
    'footer'  => [
        'visible'    => true,
        'vendorname' => 'Stay active',
        'vendorlink' => '',
    ],
    'card'    => [
        'outline'       => true,
        'default_color' => 'info',
    ],
];
