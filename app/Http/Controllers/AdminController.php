<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Profiler\Profile;


class AdminController extends Controller
{
    public function index()
    {
        $category = DB::table('category')->get();
        return view('admin')->with('category', $category);
    }

    public function create_post(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->cat_id = $request->cat_id;
        $user_id = Auth::user()->id;
        $profile_id = DB::table('profile')->where('user_id', $user_id);
        $store_id = DB::table('store')->where('profile_id', $profile_id)->value('id');
        $product->store_id = $store_id;
        $product->caption = $request->caption;
        $product->pic = image_store($request->pic);
        if ($product->save())
            return "hi";

    }

}
