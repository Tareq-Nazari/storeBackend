<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShopOwnerController extends Controller
{

    public function searchProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'cat_id' => 'integer',
            'product_id' => 'integer',
            'price' => 'integer',
            'max' => 'integer',
            'min' => 'integer',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }

        $price = $request->price;
        $name = $request->name;
        $store_id = findStoreId();
        $cat_id = $request->cat_id;
        $product_id = $request->product_id;
        $max = $request->max;
        $min = $request->min;
        $products = DB::table('products')->where('store_id', $store_id)
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

    public function categoriesProductOfStore() // دسته بندی محصولات یک مغازه خاص را برمی گرداند
    {
        $store_id = findStoreId();
        $categories = DB::table('categories')->where('store_id', $store_id)->get();
        return \response()->json([
            $categories
        ], 200);

    }

    public function addCategory(Request $request)
    { $validator = Validator::make($request->all(), [
        'name' => 'string|max:255',
    ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }


        $category = new Category();
        $store_id = findStoreId();
        if (!DB::table('categories')->where('store_id', $store_id)->where('name', $request->name)) {
            $category->name = $request->name;
            $category->store_id = $store_id;
            if ($category->save()) {
                return response()->json([
                    'message' => 'category added'
                ], 200);
            } else return response()->json([
                "meesage" => 'someting is wrong'
            ], 400);
        } else return response()->json([
            "meesage" => 'there is a category with this nam, please change the name '
        ], 400);

    }

    public function deleteCategory($cat_id)
    {
        $store_id = findStoreId();
        if (DB::table('categories')->where('store_id', $store_id)->where('id', $cat_id)->delete()) {
            return response()->json([
                "message" => "category deleted"
            ], 200);
        } else return response()->json([
            "meesage" => 'someting is wrong'
        ], 400);
    }

//for Factor
    public function searchFactor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'product_name' => 'string|max:255',
            'payment_receipt' => 'integer',
            'product_id' => 'integer',
            'profile_id' => 'integer',
            'price' => 'integer',
            'created_at' => 'date'

        ]);
        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = findStoreId();
        $price = $request->price;
        $name = $request->name;
        $product_name = $request->product_name;
        $profile_id = $request->profile_id;
        $payment_receipt = $request->payment_receipt;
        $created_at = $request->created_at;
        $product_id = $request->product_id;
        $factors = DB::table('factor')->where('store_id', $store_id)
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })->when($product_name, function ($query, $product_name) {
                return $query->where('product_name', 'like', '%' . $product_name . '%');
            })->when($price, function ($query, $price) {
                return $query->where('price', $price);
            })->when($profile_id, function ($query, $profile_id) {
                return $query->where('profile_id', $profile_id);
            })->when($payment_receipt, function ($query, $payment_receipt) {
                return $query->where('payment_receipt', $payment_receipt);
            })->when($created_at, function ($query, $created_at) {
                return $query->where('created_at', $created_at);
            })->when($product_id, function ($query, $product_id) {
                return $query->where('product_id', $product_id);
            })->get();
        return \response()->json($factors, 200);

    }


}
