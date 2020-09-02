<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Product;
use http\Env\Response;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function allProduct()
    {
        $products = DB::table('products')->get();
        if ($products) {
            return response()->json(
                $products
                , 200);
        } else return response()->json([
            "message" => "something is wrong"
        ], 400);

    }

    public function allProductOfStore() //تمام محصولات یک مغازه بخصوص
    {
        $store_id = findStoreId();
        $all_product = DB::table('products')->where('store_id', $store_id)->get();
        if ($all_product) {
            return response()->json(
                $all_product
                , 200);
        } else return response()->json([
            "message" => "something is wrong"
        ], 400);

    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'price' => 'required|integer',
            'pic' => 'required|image',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = findStoreId();
        $cat_id=DB::table('categories')->where('id',$request->cat_id)
            ->where('store_id',$store_id)->value('id');
        if ($cat_id) {
            $product = new Product();
            $product->name = $request->name;
            $product->caption = $request->caption;
            $product->price = $request->price;
            $product->pic =image_store($request->pic);
            $product->tumbnail_pic=image_thumbnail($request->pic);
            $product->cat_id = $cat_id;
            $product->store_id = $store_id;
            if ($product->save()) {

                return \response()->json([
                    "message" => "product created"
                ], 200);
            } else return response()->json([
                "message" => "something is wrong"
            ], 400);
        }else return \response()->json(' cant find category with this cat_id ',400);

    }

    public function Detail($product_id)
    {
        if ($product = DB::table('products')->find($product_id)) {
            return response()->json(
                $product , 200);
        } else return response()->json([
            "message" => "the product not find"
        ], 400);
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'product_id' => 'required|integer',
            'price' => 'required|integer',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = findStoreId();
        if (DB::table('products')->where('store_id', $store_id)
            ->where('id', $request->id)->update([
                'name' => $request->name,
                'cat_id' => $request->cat_id,
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

 public function editPic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pic' => 'required|image',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $store_id = findStoreId();
        if (DB::table('products')->where('store_id', $store_id)
            ->where('id', $request->id)->update([
                'pic' =>image_store($request->pic),
                'tumbnail_pic' =>image_thumbnail($request->pic),

            ])) {
            return \response()->json([
                "message" => "edit product_pic success"
            ], 200);

        } else return \response()->json([
            "message" => "something wrong"
        ], 400);
    }


    public function delete($product_id)
    {
        $store_id = findStoreId();
        if ($product = DB::table('products')->where('sore_id', $store_id)
            ->where('id', $product_id)->delete()) {
            $image = DB::table('products')->where('id', $product_id)->value('pic');
            image_delete($image);
            return \response()->json([
                "message" => "product deleted"
            ], 200);
        } else return \response()->json([
            "message" => "something wrong"
        ], 400);
    }


}
