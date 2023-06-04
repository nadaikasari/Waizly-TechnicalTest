<?php 

namespace App\Helpers;

class JsonResponseHelper{

    protected static $response = [
        'meta' => [
            'status' => 'success',
            'message' => null,
            'time' => null
        ],
        'data' => null

    ];

    public function successResponse($data = null, $message = null)
    {
        self::$response['meta']['time'] = date('Y-m-d H:i:s');
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response);
    }

    public function errorResponse($data = null, $message = null)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['message'] = $message;
        self::$response['meta']['time'] = date('Y-m-d H:i:s');
        self::$response['data'] = $data;

        return response()->json(self::$response);
    }
}