<?php

namespace App\Services\User;

use App\Repositories\User\IUserRepository;
use App\Repositories\User\IUserTokenRepository;
use App\Services\BaseService;
class UserService extends BaseService
{
    private $_userTokenRepo;
    public $STATUS_ACTIVE  = 1;
    public function __construct(
        IUserRepository $IUserRepository,
        IUserTokenRepository $IUserTokenRepository
    ) {
        $this->repo = $IUserRepository;
        $this->_userTokenRepo = $IUserTokenRepository;
    }

    public function login($email, $password)
    {
        $user = $this->repo->getByEmail($email);
        if ($user && $user->deleted_at == null) {
            $pass = md5($password . $user->salt);
            if ($user->password === $pass) {
                return $user;
            }
        }
        return null;
    }

    public function getDetail()
    {
        return $this->getById(auth()->user()->id);
    }


    public function getByEmail($email)
    {
        $query = $this->repo->getByEmail($email);
        return $query;
    }

    public function getByUsername($username)
    {
        return $this->repo->getUserProfileByUsername($username);
    }

    public function createTokenForgotPassword($user_id)
    {
        $token = md5(generateRandomString());
        $this->_userTokenRepo->createTokenForgotPassword($user_id, $token);
        return $token;
    }

    public function checkToken($token)
    {
        return $this->_userTokenRepo->checkToken($token);
    }

    public function resetPassword($user_id)
    {
        $new_pass = generateRandomString(10);
        $new_salt = generateRandomString(8);
        if ($this->repo->update($user_id, [
            'password' => md5($new_pass . $new_salt),
            'salt' => $new_salt,
        ])) {
            return $new_pass;
        }
        return null;
    }

    public function changePassword($user_id, $new_pass)
    {
        $new_salt = generateRandomString(8);
        if ($this->repo->update($user_id, [
            'password' => md5($new_pass . $new_salt),
            'salt' => $new_salt,
        ])) {
            return true;
        }

        return false;
    }

    public function create($data)
    {
        $query = $this->repo->registUser($data);
        return $query;
    }

    public function updateProfile($id, $data)
    {
        $query = $this->repo->update($id, $data);
        if ($query && isset($data['roles'])) {
            $query->roles()->sync($data['roles']);
        }

        return $query;
    }
}
