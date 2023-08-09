<?php

namespace App\Repositories\User;

use App\Repositories\IBaseRepository;

interface IUserRepository extends IBaseRepository
{
    public function getByEmail($email);

    public function getById($id);

    public function checkExistenceByEmail($email);

    public function checkExistenceByPhone($email);

    public function getUserProfileByUsername($username);
    public function registUser($data);

}
