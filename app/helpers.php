<?php

use App\Product;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

if (!function_exists('image_store')) {
    function image_store($image)
    {
        $destination = base_path() . '/images/';
        $filename = rand(111111111, 999999999) . '.' . $image->getClientOriginalExtension();
        $file = $image;
        $file->move($destination, $filename);
        return $filename;
    }

    function image_delete($image_path)
    {
        if (Storage::exists('images/' . $image_path)) {
            return Storage::delete('images/' . $image_path);

        } else return response()->json([
            "message" => "picture not exist"
        ], 400);
    }


    //for stores
    function findStoreId()
    {

        $profile_id = DB::table('profiles')->where('user_id', Auth::user()->id)->value('id');
        $store_id = DB::table('stores')->where('profile_id', $profile_id)->value('id');
        return $store_id;
    }


}
