<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IPasswordResetToken;
use App\Models\ResetToken;

class PasswordResetToken extends BaseRepository implements IPasswordResetToken
{

    public function model()
    {
        return ResetToken::class;
    }


}
