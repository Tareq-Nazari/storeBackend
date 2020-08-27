<?php

namespace App\Http\Controllers\api;

use App\Factor;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FactorController extends Controller
{
    //ساخت فاکتور
    public function PurchaseInvoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'store_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'payment_receipt' => 'required|integer',
            'store_id' => 'required|integer',
            'product_id' => 'required|integer',
            'profile_id' => 'required|integer',
            'price' => 'required|integer',
            'created_at' => 'required|date'

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $factor = new Factor();
        $factor->payment_receipt = rand(111111, 999999);
        $factor->profile_id = $request->profile_id;
        $factor->name = $request->name;
        $factor->price = $request->price;
        $factor->product_id = $request->product_id;
        $factor->product_name = $request->product_name;
        $factor->store_id = $request->store_id;
        $factor->count = $request->count;
        $factor->store_name = $request->store_name;
        $factor->created_at = time();
        if ($factor->save()) {

            return response()->json([
                "message" => "factor created"
            ], 200);
        } else return \response()->json([
            "message" => "something is wrong"
        ], 400);


    }

    public function all()
    {
       $factors=DB::table('factor')->get();
       if($factors){
           return response()->json(
               $factors
           , 200);
       } else return \response()->json([
           "message" => "there is no factor"
       ], 400);


    }


}
