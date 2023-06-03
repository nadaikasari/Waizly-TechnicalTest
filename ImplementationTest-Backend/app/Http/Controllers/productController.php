<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class productController extends Controller
{
    protected static $response = [
        'meta' => [
            'status' => 'success',
            'message' => null,
            'time' => null
        ],
        'data' => null

    ];

    function index()
    {
        try {
            $datas = Product::all();
            return $this->successResponse($datas, 'Berhasil mendapatkan data produk');
        } catch (\Throwable $th) {
            return $this->errorResponse(null, 'gagal mendapatkan data produk');
        }
    }
    
    function successResponse($data = null, $message = null)
    {
        self::$response['meta']['time'] = date('Y-m-d H:i:s');
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response);
    }

    function errorResponse($data = null, $message = null)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['message'] = $message;
        self::$response['meta']['time'] = date('Y-m-d H:i:s');
        self::$response['data'] = $data;

        return response()->json(self::$response);
    }
}
