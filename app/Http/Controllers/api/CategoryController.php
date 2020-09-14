<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Product_categories;
use App\Store;
use App\store_categories;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function allStore()//دسته بندی مغازه ها
    {
        $categories = DB::table('store_categories')->get();
        if ($categories) {
            return response()->json(
                $categories
                , 200);
        } else return response()->json([
            'message' => 'there is no category'
        ], 400);

    }

    public function allProduct()//دسته بندی محصولا
    {
        $categories = DB::table('categories')

            ->get();
        if ($categories) {
            return response()->json(
                $categories
                , 200);
        } else return response()->json([
            'message' => 'there is no category'
        ], 400);

    }

//    public function productOfStore()//دسته بندی محصولات یک مغازه
//    {
//        $categories = DB::table('categories')->where('store_id', findStoreId())->get();
//        if ($categories) {
//            return response()->json(
//                $categories
//                , 200);
//        } else return response()->json([
//            'message' => 'there is no category'
//        ], 400);
//
//    }

    //for admin کتگوری مغازه
    public function addStoreCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $category = new store_categories();
        $category->name = $request->name;
        if ($category->save()) {
            return response()->json(
                $category,
                200);
        } else return response()->json(['message' => 'something wrong'], 400);
    }

    public function deleteStoreCategory($cat_id)
    {
        if ($cat_id) {
            if (DB::table('store_categories')->where('id', $cat_id)->delete()) {
                return response()->json([
                    "message" => "delete successful"
                ], 200);
            } else return response()->json(['message' => 'something wrong'], 400);
        } else return response()->json(['message' => 'something wrong'], 400);

    }

    //for admin کتگوری محصول
    public function addProductCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'store_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        if (DB::table('stores')->find($request->store_id)) {
            $category = new Product_categories();
            $category->name = $request->name;
            $category->store_id = $request->store_id;
            if ($category->save()) {
                return response()->json(
                    $category
                    , 200);
            } else return response()->json(['message' => 'something wrong'], 400);
        } else return \response()->json('there is no store with this id', 400);

    }

    public function deleteProductCategory($id)
    {
        if ($id) {
            if (DB::table('categories')->where('id', $id)->delete()) {
                return response()->json([
                    "message" => "delete successful"
                ], 200);
            } else return response()->json(['message' => 'something wrong'], 400);
        } else return response()->json(['message' => 'something wrong'], 400);


    }

    //for shopOwner
    public function addProductCategoryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $category = new Product_categories();
        $category->name = $request->name;
        $category->store_id = findStoreId();
        if ($category->save()) {
            return response()->json(
                $category,

                200);
        } else return response()->json(['message' => 'something wrong'], 400);


    }

    public function deleteProductCategoryStore($cat_id)
    {
        if (DB::table('categories')->where('store_id', findStoreId())->where('id', $cat_id)->delete()) {
            return response()->json([
                "message" => "delete successful"
            ], 200);
        } else return response()->json(['message' => 'something wrong'], 400);


    }

    //for admin
    public function searchCategoryStore(Request $request)
    {

        $id = $request->store_id;
        $name = $request->name;
        $categories = DB::table('categories')
            ->join('store_categories','categories.cat_id','=','store_categories.id')
            ->select('categories.*','store_categories.name as cat_name')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })->when($id, function ($query, $id) {
                return $query->where('categories.store_id', $id);
            })->get();
        if ($categories) {
            return \response()->json($categories, 200);
        } else return response()->json([
            "message" => "there is no category"
        ], 400);

    }

    public function searchProductStore(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $store_id = $request->store_id;
        $categories = DB::table('categories')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })->when($id, function ($query, $id) {
                return $query->where('id', $id);
            })->when($store_id, function ($query, $store_id) {
                return $query->where('store_id', $store_id);
            })->get();
        if ($categories) {
            return \response()->json($categories, 200);
        } else return response()->json([
            "message" => "there is no category"
        ], 400);

    }

    //for shopOwner

    public function searchProductOneStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'id' => 'integer',


        ]);
        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $id = $request->id;
        $name = $request->name;
        $store_id = findStoreId();

        $categories = DB::table('store_categories')->where($store_id, function ($query, $store_id) {
            return $query->where('store_id', $store_id);
        })->when($name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->when($id, function ($query, $id) {
            return $query->where('id', $id);
        })->get();
        if ($categories) {
            return \response()->json($categories, 200);
        } else return response()->json([
            "message" => "there is no category"
        ], 400);

    }

    public function addCategoryProductToStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
        ]);
        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        if (DB::table('store_categories')->where('id',$request->id)->get()) {
            $cat = new Product_categories();
            $cat->cat_id = $request->id;
            $cat->store_id = findStoreId();
            if ($cat->save()) {
                return response()->json(
                    $cat,
                    200);
            } else return response()->json(['message' => 'something wrong'], 400);
        }else return response()->json('cant find this cat_id', 400);

    }

    public function deleteCategoryProductFromStore($cat_id)
    {
        if ($cat_id) {
            if (DB::table('categories')->where('id', $cat_id)->where('store_id', findStoreId())->delete()) {
                return response()->json([
                    "message" => "delete successful"
                ], 200);
            } else return response()->json(['message' => 'something wrong'], 400);
        } else return response()->json(['message' => 'there is no id'], 400);

    }
//کتگوری یک مغازه را بر می گرداند
    public function select_store_cat()
    {
        $categories = DB::table('store_categories')->join('categories', 'store_categories.id', '=', 'categories.cat_id')
            ->join('stores', 'categories.store_id', '=', 'stores.id')
            ->select('store_categories.*')->get();
        if ($categories) {
            return \response()->json($categories, 200);
        } else return response()->json('there is no category', 400);

    }

    public function test(Request $request)
    {
        return \response()->json([image_thumbnail($request->pic)
            , image_store($request->pic)], 200);
    }


}
