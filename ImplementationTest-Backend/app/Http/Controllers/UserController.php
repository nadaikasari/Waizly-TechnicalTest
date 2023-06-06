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
            $user = User::Create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $data['name'] = $user->name;
            $data['token'] = $user->createToken('auth_token')->plainTextToken;

            return $this->jsonResponseHelper->successResponse($data, 'Berhasil mendaftar');
        } catch (\Throwable $th) {
            return $this->jsonResponseHelper->errorResponse(null, 'gagal mendaftar');
        }
    }

    public function Login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['name'] = $user->name;
            $data['token'] = $user->createToken('auth_token')->plainTextToken;

            return $this->jsonResponseHelper->successResponse($data, 'Login Berhasil');
        } else {
            return $this->jsonResponseHelper->errorResponse(null, 'email atau password salah');
        }
    }

}
