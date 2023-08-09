<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class BaseApiController extends Controller
{
    use ApiResponser;

    protected $_service;
    protected $_exportClassName;
    protected $_exportFileName;

    public function get()
    {
        $data = $this->_service->get();
        return $this->successResponse($data);
    }

    public function all()
    {
        try {
            $result = $this->_service->all();
            if ($result)
                return $this->successResponse($result);
            return  $this->errorResponse(__('common.empty'));
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->errorResponse(__('common.empty'));
        }
    }

    public function baseCreate($request)
    {
        try {
            $result = $this->_service->create($request->all());
            if ($result)
                return $this->successResponse($result);
            return  $this->errorResponse(__('common.add-success'));
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->errorResponse(__('common.add-fail'));
        }
    }

    public function baseUpdate($request)
    {
        try {
            $result = $this->_service->update($request->all());
            if ($result)
                return $this->successResponse($result);
            return  $this->errorResponse(__('common.edit-success'));
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->errorResponse(__('common.edit-fail'));
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->_service->delete($id);

            if (isset($result['error']) && $result['error'] == true)
                return $this->errorResponse($result['message']);
            elseif ($result == true) {
                return $this->successResponse(__('common.deleted-successful'));
            }

            return $this->errorResponse(__('common.deleted-fail'));
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->errorResponse(__('common.deleted-fail'));
        }
    }

    public function export()
    {
        try {
            return Excel::download(new $this->_exportClassName, $this->_exportFileName);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->errorResponse(__('common.empty'));
        }
    }
}
