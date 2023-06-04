<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponseHelper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class productController extends Controller
{
    public function __construct() {
        $this->jsonResponseHelper     = new JsonResponseHelper;
    }

    function index()
    {
        try {
            $datas = Product::all();
            return $this->jsonResponseHelper->successResponse($datas, 'Berhasil mendapatkan data produk');
        } catch (\Throwable $th) {
            return $this->jsonResponseHelper->errorResponse(null, 'gagal mendapatkan data produk');
        }
    }
 
    function showById($id)
    {
        try {
            $data = Product::find($id);
            return $this->jsonResponseHelper->successResponse($data, 'Berhasil mendapatkan data produk');
        } catch (\Throwable $th) {
            return $this->jsonResponseHelper->errorResponse(null, 'gagal mendapatkan data produk');
        }
    }

    public function store(Request $request)
    {
        try {
            Product::create($request->all());
            return $this->jsonResponseHelper->successResponse(null, 'Berhasil menambah data produk');
        } catch (\Throwable $th) {
            return $this->jsonResponseHelper->errorResponse(null, 'gagal menambah data produk');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return $this->jsonResponseHelper->successResponse($product, 'Berhasil memperbarui data produk');
        } catch (\Throwable $th) {
            return $this->jsonResponseHelper->errorResponse(null, 'gagal memperbarui data produk');
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return $this->jsonResponseHelper->successResponse(null, 'Berhasil menghapus data produk');
        } catch (\Throwable $th) {
            return $this->jsonResponseHelper->errorResponse(null, 'gagal menghapus data produk');
        }
    }

}
