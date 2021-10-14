<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login() {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password'),
          
            ])) 
        {
            $user = Auth::user();
            $user['token'] = $user->createToken('token')->accessToken;
          
                return (new AuthResource($user));
            }
        
        else {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'Incorrect Email or password');
        }
    }
}
