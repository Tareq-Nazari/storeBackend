<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Profile;
use App\Store;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function allStore()
    {
        $stores=DB::table('stores')->get();
        if($stores){
            return response()->json([
                $stores
            ],200);
        }
        else return response()->json([
            "message"=>"something is wrong"
        ],400);

    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'email' => 'required|email|unique:App\User|',
            'phone' => 'required|numeric:11',
            'cat_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store = new Store();
        $user_id = Auth::user()->id;
        $profile_id = DB::table('profiles')->where('user_id', $user_id)->first();
        $store->name = $request->name;
        $store->cat_id = $request->cat_id;
        $store->caption = $request->caption;
        $store->phone = $request->phone;
        $store->email = $request->email;
        $store->profile_id = $profile_id;
        if ($store->save()) {
            return \response()->json([
                "message" => "create store success"
            ], 200);
        } else return response()->json([
            "message" => "something wrong"
        ], 400);
    }

    public function Detail()
    {

        if ($store = DB::table('stores')->find(findStoreId())) {
            return response()->json([
                $store,
            ], 200);
        } else return response()->json([
            'message' => 'store not exist'
        ], 400);
    }


    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'email' => 'required|email|unique:App\User|',
            'phone' => 'required|numeric:11',
            'cat_id' => 'required|integer',
            'header_pic' => 'required|image',
            'profile_pic' => 'required|image',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        //$store_id = findStoreId();
        if ($users = DB::table('stores')->where('id', 1)->update([
            'name' => $request->name,
            'cat_id' => $request->cat_od,
            'header_pic' => image_store($request->header_pic),
            'phone' => $request->phone,
            'profile_pic' => image_store($request->profile_pic),
            'email' => $request->email,
            'address' => $request->address,
            'caption' => $request->caption,
        ])) {
            return \response()->json([
                "message" => "edit store success"
            ], 200);

        } else return \response()->json([
            "message" => "something wrong"
        ], 400);
    }


}
