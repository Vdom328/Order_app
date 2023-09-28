<?php

use App\Classes\Enums\StatusUserEnum;

return [
    'user' => [
        'gender' => [
            'Male' => 1,
            'Female' => 2,
        ],
        'account_status' => [
            'Active' => StatusUserEnum::Active,
            'Inactive' => StatusUserEnum::Inactive,
        ]
    ],
    'food' => [
        'status' => [
            'Active' => 0,
            'Inactive' => 1,
        ],
    ],
];
