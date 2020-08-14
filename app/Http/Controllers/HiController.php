<?php

namespace App\Http\Controllers;


use App\Profile;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class HiController extends Controller
{
    public function register(Request $request)
    {


        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return response()->json([
                'message' => 'user created',
                'status' => '201'
            ], 201);
        } else return response()->json([

            'message' => 'fuck'

        ], 201);


    }


    public function login(Request $request)
    {


        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'unauthrized',
                'satatus' => '401'
            ], 401);
        }

        $user = $request->user();
        if ($user->role == 2) {
            $tokenData = $user->createToken('Personal Access Token', ['do_anything']);
        } else {
            $tokenData = $user->createToken('Personal Access Token', ['can_create']);
        }
        $token = $tokenData->token;
        if ($token->save()) {
            return response()->json([
                'user' => $user,
                'access_token' => $tokenData->accessToken,
                'token_type' => 'Bearar',
                'scope' => $tokenData->token->scopes

            ]);


        }
        else {
            return \response()->json([
                'msg' => 'errrrror'
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'logout',
            'status' => 200
        ], 200);
    }

    public function test()
    {

    }
    public function image_store($image)
    {
        $destination = base_path() . '/images/';
        $filename = rand(111111111, 999999999) . '.' . $image->getClientOriginalExtension();
        $file = $image;
        $file->move($destination, $filename);
        return $filename;
    }


}
