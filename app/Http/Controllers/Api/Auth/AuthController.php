<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Models\User;
use App\Traits\HttpResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    use HttpResponseJson;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(registerRequest $request){



        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $user['token'] = $user->createToken('MyApp')->accessToken;


       return $this->responseJson(true,$user,'user created successfully');


    }

    public function login(loginRequest $request){


       if(auth()->attempt(['email'=>$request->email,'password'=>$request->password])){


           $user = Auth::user();
           $user['token'] = $user->createToken('MyApp')->accessToken;

          return $this->responseJson(true,$user,'login is success');

       }

        return $this->responseJson(false,null,'credentials not correct');



    }


    public function logout(){

        Auth::guard('api')->user()->tokens()->delete();

        return $this->responseJson(true,null,'Successfully logged out');
    }
}
