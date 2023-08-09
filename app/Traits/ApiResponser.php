<?php

namespace App\Traits;

trait ApiResponser
{
    protected function successResponse($data, $message = '', $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = null, $code = 400)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ], $code);
    }
}