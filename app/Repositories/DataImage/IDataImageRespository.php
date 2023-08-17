<?php
namespace App\Repositories\DataImage;
use Illuminate\Http\Request;
use App\Repositories\User\DataImageRespository;

interface IDataImageRespository
{
    public function getByEmail($email);

}
