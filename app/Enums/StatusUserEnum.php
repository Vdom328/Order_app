<?php
namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class StatusUserEnum extends Enum
{
    const Active = 1;
    const Inactive = 2;

}
