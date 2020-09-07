<?php

namespace App\Http\Controllers\api;

use App\Factor;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use function GuzzleHttp\Psr7\str;

class FactorController extends Controller
{
    //ساخت فاکتور
    public function PurchaseInvoice(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'store_name' => 'required|string|max:255',
//            'product_name' => 'required|string|max:255',
//            'payment_receipt' => 'required|integer',
//            'store_id' => 'required|integer',
//            'product_id' => 'required|integer',
//            'profile_id' => 'required|integer',
//            'price' => 'required|integer',
//            'created_at' => 'required|date'
//
//        ]);
//
//        if ($validator->fails()) {
//            return \response()->json($validator->errors(), 400);
//        }
//
//        for ($i = 0; $i < 10; $i++) {
//            $factor = new Factor();
//            $factor->payment_receipt = rand(111111, 999999);
//            $factor->profile_id = $request->profile_id;
//            $factor->name = $request->name;
//            $factor->price = $request->price;
//            $factor->product_id = $request->product_id;
//            $factor->product_name = $request->product_name;
//            $factor->store_id = $request->store_id;
//            $factor->store_name = $request->store_name;
//            $factor->created_at = time();
//            $factor->save();
//        }
//      {
        $factors = $request->all();
        DB::beginTransaction();
        try {
            foreach ($factors as $fact) {

                $factor = new Factor();
                $factor->payment_receipt = rand(111111, 999999);
                $factor->profile_id = $fact['profile_id'];
                $factor->name = $fact['name'];
                $factor->price = $fact['price'];
                $factor->product_id = $fact['product_id'];
                $factor->product_name = $fact['product_name'];
                $factor->store_id = $fact['store_id'];
                $factor->store_name = $fact['store_name'];
                $factor->created_at = time();
                $factor->save();

            }
            DB::table('basket')->where('profile_id', $fact['profile_id'])->delete();
            DB::commit();
            return response()->json('payment is successful'

                , 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('something is wrong'

                , 400);
        }

//        } else return \response()->json([
//            "message" => "something is wrong"
//        ], 400);
//

    }

    public function test(Request $request)
    {
        $image = image_thumbnail($request->pic);
        return \response()->json($image, 200);


    }

    public function all()
    {
        $factors = DB::table('factor')->get();
        if ($factors) {
            return response()->json(
                $factors
                , 200);
        } else return \response()->json([
            "message" => "there is no factor"
        ], 400);


    }


}
