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
 
    function showById($id)
    {
        try {
            $data = Product::find($id);
            return $this->successResponse($data, 'Berhasil mendapatkan data produk');
        } catch (\Throwable $th) {
            return $this->errorResponse(null, 'gagal mendapatkan data produk');
        }
    }

    public function store(Request $request)
    {
        try {
            Product::create($request->all());
            return $this->successResponse(null, 'Berhasil menambah data produk');
        } catch (\Throwable $th) {
            return $this->errorResponse(null, 'gagal menambah data produk');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return $this->successResponse($product, 'Berhasil memperbarui data produk');
        } catch (\Throwable $th) {
            return $this->errorResponse(null, 'gagal memperbarui data produk');
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
