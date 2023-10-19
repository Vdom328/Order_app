<?php

use App\Classes\Enum\StatusUserEnum;

return [
    'user' => [
        'gender' => [
            'Male' => 1,
            'Female' => 2,
        ],
        'account_status' => [
            'Active' => StatusUserEnum::Active->value,
            'Inactive' => StatusUserEnum::Inactive->value,
        ]
    ],
    'food' => [
        'status' => [
            'Active' => 0,
            'Inactive' => 1,
        ],
    ],
];
