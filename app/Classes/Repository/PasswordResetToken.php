<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IPasswordResetToken;

class PasswordResetToken extends BaseRepository implements IPasswordResetToken
{

    public function model()
    {
        return PasswordResetToken::class;
    }


}
