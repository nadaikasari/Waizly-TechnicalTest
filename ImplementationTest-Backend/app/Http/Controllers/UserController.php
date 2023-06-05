<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\JsonResponseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct() {
        $this->jsonResponseHelper     = new JsonResponseHelper;
    }

    function register(Request $request) {
        try {
            User::Create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => Str::random(80),
            ]);
            return $this->jsonResponseHelper->successResponse(null, 'Berhasil mendaftar');
        } catch (\Throwable $th) {
            return $this->jsonResponseHelper->errorResponse(null, 'gagal mendaftar');
        }
    }

    public function Login(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');

        try {
            Auth::attempt($credentials);
            return "success";
        } catch (\Throwable $th) {
            return "gagal";
        }
        // //if auth failed
        // if(!$token = auth()->guard('api')->attempt($credentials)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Email atau Password Anda salah'
        //     ], 401);
        // }

        //if auth success
        // return response()->json([
        //     'success' => true,
        //     'user'    => auth()->guard('api')->user(),
        // ], 200);
    }

}
