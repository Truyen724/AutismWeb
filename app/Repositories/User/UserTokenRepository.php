<?php

namespace App\Repositories\User;

use App\Models\UserToken;
use App\Repositories\BaseRepository;

class UserTokenRepository extends BaseRepository implements IUserTokenRepository
{

    public function __construct()
    {
        $this->model = new UserToken();
    }

    public function createTokenForgotPassword($id, $token)
    {
        $this->model->create([
            'user_id' => $id,
            'token' => $token,
        ]);
    }

    public function checkToken($token)
    {
        $user_token = $this->model->where('token', $token)->first();
        if ($user_token) {
            $created = strtotime($user_token->created_at);

            $minutes = (time() - $created) / 60;
            if ($minutes < 5) {
                return $user_token->user_id;
            }
        }
        return null;
    }
}