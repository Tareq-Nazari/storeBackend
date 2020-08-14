<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {

    }

    public function createStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'caption' => 'required|string|max:255',
            'phone' => 'required|numeric:11',
            'email' => 'required|email',
            'profile_id' => 'required|integer',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store = new Store();
        $store->name = $request->name;
        $store->cat_id = $request->cat_id;
        $store->caption = $request->caption;
        $store->phone = $request->phone;
        $store->email = $request->email;
        $store->address = $request->address;
        $store->profile_id = $request->profile_id;
        if ($store->save()) {
            return \response()->json([
                "message" => "create store success"
            ], 200);
        } else return response()->json([
            "message" => "something wrong"
        ], 400);
    }

    public function editStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'address' => 'string|max:255',
            'cat_id' => 'integer',
            'caption' => 'string|max:255',
            'phone' => 'numeric:11',
            'email' => 'email',
            'profile_id' => 'integer',
            'header_pic' => 'image',
            'profile_pic' => 'image',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = $request->store_id;
        if ($users = DB::table('stores')->where('id', $store_id)->update([
            'name' => $request->name,
            'cat_id' => $request->cat_id,
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

    public function deleteStore($store_id)
    {
        if ($store = DB::table('stores')->where('id', $store_id)->delete()) {
            return \response()->json([
                "message" => "product deleted"
            ], 200);
        } else return \response()->json([
            "message" => "something wrong"
        ], 400);
    }

    public function searchStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'address' => 'string|max:255',
            'cat_id' => 'integer',
            'phone' => 'numeric:11',
            'email' => 'email',
            'profile_id' => 'integer',
            'store_id' => 'integer',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = $request->id;
        $name = $request->name;
        $cat_id = $request->cat_id;
        $phone = $request->phone;
        $address = $request->address;
        $email = $request->email;
        $profile_id = $request->profile_id;
        $store = DB::table('stores')
            ->when($store_id, function ($query, $store_id) {
                return $query->where('id', $store_id);
            })
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('caption', 'like', '%' . $name . '%');
            })->when($cat_id, function ($query, $cat_id) {
                return $query->where('cat_id', $cat_id);
            })->when($phone, function ($query, $phone) {
                return $query->where('phone', $phone);
            })->when($address, function ($query, $address) {
                return $query->where('address', $address);
            })->when($email, function ($query, $email) {
                return $query->where('email', $email);
            })->when($profile_id, function ($query, $profile_id) {
                return $query->where('profile_id', $profile_id);
            })->get();
        return \response()->json($store, 200);
    }

//for FACTOR
    public function searchFactor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'store_name' => 'string|max:255',
            'product_name' => 'string|max:255',
            'payment_receipt' => 'integer',
            'store_id' => 'integer',
            'product_id' => 'integer',
            'profile_id' => 'integer',
            'price' => 'integer',
            'created_at' => 'date'

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $price = $request->price;
        $name = $request->name;
        $store_name = $request->store_name;
        $product_name = $request->product_name;
        $profile_id = $request->profile_id;
        $payment_receipt = $request->payment_receipt;
        $store_id = $request->store_id;
        $created_at = $request->created_at;
        $product_id = $request->product_id;
        $factors = DB::table('factor')->when($name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->when($store_name, function ($query, $store_name) {
            return $query->where('store_name', 'like', '%' . $store_name . '%');
        })->when($product_name, function ($query, $product_name) {
            return $query->where('product_name', 'like', '%' . $product_name . '%');
        })->when($price, function ($query, $price) {
            return $query->where('price', $price);
        })->when($profile_id, function ($query, $profile_id) {
            return $query->where('profile_id', $profile_id);
        })->when($payment_receipt, function ($query, $payment_receipt) {
            return $query->where('payment_receipt', $payment_receipt);
        })->when($store_id, function ($query, $store_id) {
            return $query->where('store_id', $store_id);
        })->when($created_at, function ($query, $created_at) {
            return $query->where('created_at', $created_at);
        })->when($product_id, function ($query, $product_id) {
            return $query->where('product_id', $product_id);
        })->get();
        return \response()->json($factors, 200);

    }

    //for ptoducts
    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'store_id' => 'required|integer',
            'price' => 'required|integer',
            'caption' => 'required|string|max:255',
            'pic' => 'required|image',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->cat_id = $request->cat_id;
        $store_id = $request->store_id;
        $store_id = DB::table('stores')->where('id', $store_id)->get();
        if ($store_id) {
            $product->store_id = $store_id;
            $product->caption = $request->caption;
            $product->pic = image_store($request->pic);
            if ($product->save()) {
                return response()->json([
                    'message' => 'the product created'
                ], 201);
            } else return response()->json([
                "message" => "something is wrong"
            ], 400);
        } else return response()->json([
            "message" => "store_id is invalid"
        ], 400);
    }

    public function editProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'id' => 'required|integer',
            'store_id' => 'required|integer',
            'cat_id' => 'integer',
            'price' => 'integer',
            'caption' => 'string|max:255',
            'pic' => 'image',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = $request->store_id;
        if (DB::table('products')->where('store_id', $store_id)
            ->where('id', $request->id)->update([
                'name' => $request->name,
                'cat_id' => $request->cat_id,
                'pic' => image_store($request->pic),
                'price' => $request->price,
                'caption' => $request->caption,

            ])) {
            return \response()->json([
                "message" => "edit product success"
            ], 200);

        } else return \response()->json([
            "message" => "something wrong"
        ], 400);
    }


    public function deleteProduct($product_id)
    {
        if ($product = DB::table('products')->where('id', $product_id)->delete()) {
            $image = DB::table('products')->where('id', $product_id)->value('pic');
            image_delete($image);
            return \response()->json([
                "message" => "product deleted"
            ], 200);
        } else return \response()->json([
            "message" => "something wrong"
        ], 400);
    }

    public function searchProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'store_id' => 'integer',
            'product_id' => 'integer',
            'cat_id' => 'integer',
            'price' => 'integer',
            'max' => 'integer',
            'min' => 'integer',


        ]);
        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $price = $request->price;
        $name = $request->name;
        $store_id = $request->store_id;
        $cat_id = $request->cat_id;
        $product_id = $request->product_id;
        $max = $request->max;
        $min = $request->min;
        $products = DB::table('products')
            ->when($store_id, function ($query, $store_id) {
                return $query->where('store_id', $store_id);
            })
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('caption', 'like', '%' . $name . '%');
            })->when($price, function ($query, $price) {
                return $query->where('price', $price);
            })->when($product_id, function ($query, $product_id) {
                return $query->where('id', $product_id);
            })->when($max, $min, function ($query, $min, $max) {
                return $query->whereBetween('price', [$min, $max]);
            })->when($cat_id, function ($query, $cat_id) {
                return $query->where('cat_id', $cat_id);
            })->get();
        return \response()->json($products, 200);
    }

}
