<?php
namespace App\Repositories\DataImage;
use Illuminate\Http\Request;
use App\Repositories\User\IDataImageRespository;

class DataImageRespository implements IDataImageRespository
{
    public function __construct()
    {

    }
    public function detect_img(Request $request){
        dd($request);
        $x = 0;
        return $x;
    }
}
