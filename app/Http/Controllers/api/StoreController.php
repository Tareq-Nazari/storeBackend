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
        $stores = DB::table('stores')
            ->join('store_categories', 'cat_id', '=', 'store_categories.id')
            ->select('stores.*', 'store_categories.name as cat_name')
            ->get();
        if ($stores) {
            return \response()->json(
                $stores
                , 200);

        } else return \response()->json(
            "there is no store"
            , 400);

    }

    public function oneStore ($id)
    {
        $store=DB::table('stores')
            ->join('store_categories', 'cat_id', '=', 'store_categories.id')
            ->select('stores.*', 'store_categories.name as cat_name')
            ->where('stores.id',$id)->get();
      if ($store) {
          return \response()->json($store, 200);
            }else return response()->json("there is no store with this id",200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'email' => 'required|email|unique:App\User|',
            'phone' => 'required|numeric:11',
            'cat_id' => 'required|integer',
            'address' => 'required|string',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $user_id = Auth::user()->id;
        if (DB::table('oauth_access_tokens')->where('user_id', $user_id)->update([
                'scopes' => ["shopOwner"]
            ]) && DB::table('users')->where('id', $user_id)->update([
                'role' => 2
            ]) && DB::table('profiles')->where('user_id', $user_id)->update([
                'role' => 2
            ])) {
            $cat_id = $request->cat_id;
            if (DB::table('store_categories')->where('id', $cat_id)->get()) {
                $store = new Store();
                $profile_id = DB::table('profiles')->where('user_id', $user_id)->value('id');
                $store->name = $request->name;
                $store->cat_id = $cat_id;
                $store->caption = $request->caption;
                $store->phone = $request->phone;
                $store->email = $request->email;
                $store->address = $request->address;
                $store->profile_id = $profile_id;
                if ($store->save()) {
                    return \response()->json(
                        "create store success"
                        , 200);
                } else return response()->json(
                    "something wrong"
                    , 400);
            } else return \response()->json('cant find store_category with this cat_id', 400);
        } else return \response()->json('something is wrong', 400);
    }

    public function Detail()
    {

        if ($store = DB::table('stores')
            ->join('store_categories', 'cat_id', '=', 'store_categories.id')
            ->select('stores.*', 'store_categories.name as cat_name')
            ->where('stores.id', findStoreId())->get()) {
            return response()->json(
                $store
            , 200);
        } else return response()->json([
            'message' => 'store not exist'
        ], 400);

    }

    public function store_detail($id)
    {
        if ($store = DB::table('stores')
            ->join('store_categories', 'cat_id', '=', 'store_categories.id')
            ->select('stores.id', 'stores.email', 'stores.name', 'stores.address', 'stores.phone', 'stores.header_pic', 'stores.profile_pic', 'stores.caption', 'store_categories.name as cat_name')
            ->where('stores.id', $id)->get()) {
            return response()->json([
                $store,
            ], 200);
        } else return response()->json([
            'message' => 'store not exist'
        ], 400);
    }

    public function productOfStore($id)
    {
        if ($products = DB::table('products')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->join('store_categories','categories.cat_id','=','store_categories.id')
            ->select('products.id', 'products.name', 'price', 'pic', 'caption', 'store_categories.name as cat_name')
            ->where('products.store_id', $id)->get()) {
            return response()->json([
                $products,
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

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = findStoreId();
        if ($users = DB::table('stores')->where('id', $store_id)->update([
            'name' => $request->name,
            'cat_id' => $request->cat_id,
            'phone' => $request->phone,
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
