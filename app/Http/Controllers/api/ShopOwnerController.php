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

    //for comment
    public function storeComments()
    {
        $comments = DB::table('store_comment')->where('store_id', findStoreId())->get();
        if ($comments) {
            return response()->json($comments, 200);
        } else return response()->json('there is no comment', 400);
    }

    public function productComments($product_id)
    {
        $comments = DB::table('product_comment')
            ->join('products', 'product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->select('product_comment.*')
            ->where('products.id', $product_id)->where('stores.id', findStoreId())->get();
        if ($comments) {
            return response()->json($comments, 200);
        } else return response()->json('there is no comment', 400);

    }

    public function deleteStoreComment($comment_id)
    {
        if (DB::table('store_comment')->where('store_id', findStoreId())->where('id', $comment_id)->delete()) {
            return response()->json('deleted successful', 200);
        } else return response()->json('cant find this comment', 400);


    }

    public function deleteProductComment($comment_id)
    {
        $comment = DB::table('product_comment')
            ->join('products', 'product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->where('stores.id', findStoreId())
            ->where('product_comment.id', $comment_id)->select('product_comment.id')->get();
        if ($comment) {
            if (DB::table('product_comment')->where('id', $comment_id)->delete()) {
                return response()->json('deleted successful', 200);
            } else return response()->json('cant find this comment', 400);
        } else return response()->json('cant find this comment', 400);


    }

}
