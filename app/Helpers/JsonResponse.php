<?php

namespace App\Helpers;

class JsonResponse
{
    public static function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message,
        ], $code);
    }
}
