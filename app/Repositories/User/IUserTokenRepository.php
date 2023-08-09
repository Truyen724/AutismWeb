<?php

namespace App\Repositories\User;

use App\Repositories\IBaseRepository;

interface IUserTokenRepository extends IBaseRepository
{
    public function createTokenForgotPassword($id, $token);

    public function checkToken($token);
}