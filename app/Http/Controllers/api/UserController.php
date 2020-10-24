<?php

namespace App\Http\Controllers\api;

use App\Basket;
use App\Http\Controllers\Controller;
use App\ProductComment;
use App\Profile;
use App\StoreComment;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:App\User|',
            'password' => 'required',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric:11',
            'role' => 'numeric:1'

        ]);

        if ($validator->fails()) {
            return \response()->json(['error' => $validator->errors()], 400);
        }

        $user = new User();
        $profile = new Profile();
        $profile->name = $request->name;
        $user->name = $request->name;
        $profile->address = $request->address;

        $profile->phone = $request->phone;
        $user->email = $request->email;
        $user->name = $request->name;
        if ($request->has('role')) {
            $user->role = $request->role;
            $profile->role = $request->role;
        } else {
            $user->role = 1;
            $profile->role = 1;
        }

        $user->password = Hash::make($request->password);
        if ($user->save()) {
            $profile->user_id = $user->id;

            if ($profile->save()) {
                return response()->json([
                    'message' => 'user created',
                    'status' => '201'
                ], 201);
            } else return response()->json([

                'message' => 'something is wrong '

            ], 400);
        }
        return response()->json([
            'message' => 'something is wrong'
        ], 400);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'unauthrized',
                'satatus' => '401'
            ], 401);
        }
        $user = $request->user();
        if ($user->role === 2) {
            $tokenData = $user->createToken('Personal Access Token', ['shopOwner']);
        } else if ($user->role === 3) {
            $tokenData = $user->createToken('Personal Access Token', ['admin']);
        } else if ($user->role === 1) {
            $tokenData = $user->createToken('Personal Access Token', ['user']);
        }
        $token = $tokenData->token;
        if ($token->save()) {
            return response()->json([
                'user' => $user,
                'access_token' => $tokenData->accessToken,
                'token_type' => 'Bearar',
                'scope' => $tokenData->token->scopes
            ]);

        } else {
            return \response()->json([
                'msg' => 'errrrror'
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'logout',
            'status' => 200
        ], 200);
    }

    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric:11',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $user_id = Auth::user()->id;
        if ($user_id) {

            if (DB::table('profiles')->where('user_id', $user_id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,

                ]) &&
                DB::table('users')->where('id', $user_id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ])) {
                return \response()->json([
                    "message" => "edit profile success"
                ], 200);
            } else return \response()->json([
                "message" => "something wrong"
            ], 400);
        } else return \response()->json([
            "message" => "cant find this user"
        ], 400);


    }

    public function editProfilePicture(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pic' => 'required|image',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 400);
        }
        $pic = $request->pic;
        if (DB::table('profiles')->where('user_id', Auth::user()->id)->update([
            'pic' => image_store($pic)
        ])) {
            return \response('edit picture success', 200);
        } else return \response('something is wrong', 400);
    }

    public function showProfile()
    {
        $user = DB::table('profiles')->join('users', 'user_id', '=', 'users.id')
            ->select('profiles.*', 'users.email as email')
            ->where('user_id', Auth::user()->id)->get();
        if ($user) {
            return \response()->json($user, 200);
        } else      return \response()->json('cant find this user', 400);
    }

//for basket
    public function addToBasket($product_id)
    {
        $product = DB::table('products')->find($product_id);
        $prof = DB::table('profiles')->where('user_id', Auth::user()->id)->first();
        if ($product && $prof) {
            $basket = new Basket();
            $basket->profile_id = $prof->id;
            $basket->product_id = $product_id;
            $basket->store_id = $product->store_id;
            $basket->name = $prof->name;
            $basket->product_name = $product->name;
            $basket->price = $product->price;
            $basket->created_at = time();

            if ($basket->save()) {
                return \response()->json([
                    "message" => "product added to the basket"
                ], 200);
            } else return \response()->json([
                "message" => "something wrqong"
            ], 400);

        } else return \response()->json([
            "message" => "something wrong"
        ], 400);

    }

    public function deleteFromBasket($basket_id)
    {
        $profile_id = DB::table('profiles')->where('user_id', Auth::user()->id)->value('id');
        if (DB::table('basket')->where('id', $basket_id)->where('profile_id', $profile_id)->delete()) {
            return \response()->json([
                "message" => "product deleted from your basket"
            ], 200);
        } else return \response()->json([
            "message" => "something wrong"
        ], 400);
    }

    public function basket()
    {
        $profile_id = DB::table('profiles')->where('user_id', Auth::user()->id)->value('id');
        if ($basket = DB::table('products')->join('basket', 'products.id', '=', 'basket.product_id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->select('basket.*', 'products.tumbnail_pic as thumbnail', 'products.caption as caption', 'stores.name as store_name')
            ->where('basket.profile_id', $profile_id)
            ->get()) {
            return \response()->json(
                $basket
                , 200);
        } else return \response()->json([
            "message" => "something wrong"
        ], 400);

    }

// for stores
    public function searchStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'cat_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return \response()->json([$validator->errors()], 400);
        }
        $name = $request->name;
        $category = $request->cat_id;
        $stores = DB::table('stores')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })->when($category, function ($query, $category) {
                return $query->where('cat_id', $category);
            })->get();
        return \response()->json($stores, 200);
    }

//for Factor
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
        $store_name = $request->store_name;
        $price = $request->price;
        $name = $request->name;
        $product_name = $request->product_name;

        $profile_id = DB::table('profiles')->where('user_id', Auth::user()->id)->value('id');
        $payment_receipt = $request->payment_receipt;
        $store_id = $request->store_id;
        $created_at = $request->created_at;
        $product_id = $request->product_id;
        $factors = DB::table('factor')->join('products', 'product_id', '=', 'products.id')
            ->select('factor.*', 'products.tumbnail_pic as thumbnail_pic')
            ->where('profile_id', $profile_id)
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })->when($store_name, function ($query, $store_name) {
                return $query->where('store_name', 'like', '%' . $store_name . '%');
            })->when($product_name, function ($query, $product_name) {
                return $query->where('product_name', 'like', '%' . $product_name . '%');
            })->when($price, function ($query, $price) {
                return $query->where('price', $price);
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

    }//for product


    public function searchProduct(Request $request)
    {


        $price = $request->price;
        $name = $request->name;
        $color = $request->color;
        $size = $request->size;
        $store_id = $request->store_id;
        $cat_id = $request->cat_id;
        $product_id = $request->id;
        $max = $request->max;
        $min = $request->min;
        $products = DB::table('products')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->join('store_categories', 'categories.cat_id', '=', 'store_categories.id')
            ->select('products.*', 'store_categories.name as cat_name')
            ->when($store_id, function ($query, $store_id) {
                return $query->where('products.store_id', $store_id);
            })->when($name, function ($query, $name) {
                return $query->where('products.name', 'like', '%' . $name . '%');
            })->when($price, function ($query, $price) {
                return $query->where('price', $price);
            })->when($product_id, function ($query, $product_id) {
                return $query->where('products.id', $product_id);
            })->when($color, function ($query, $color) {
                return $query->where('color', $color);
            })->when($size, function ($query, $size) {
                return $query->where('size', $size);
            })->when($min, function ($query, $min) {
                return $query->where('price', '>=', $min);
            })->when($max, function ($query, $max) {
                return $query->where('price', '<=', $max);
            })->when($cat_id, function ($query, $cat_id) {
                return $query->where('products.cat_id', $cat_id);
            })->get();
        return \response()->json($products, 200);
    }

//for users
    public function allUsers()
    {

        $user = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('profiles.*', 'users.email')
            ->get();
        if ($user) {
            return \response()->json($user, 200);
        } else return \response()->json([
            "message" => "there is no user"
        ], 400);
    }


    public function deleteUser($id)
    {
        if (DB::table('users')->where('id', $id)->delete() && DB::table('profiles')->where('user_id', $id)->delete()) {
            return \response()->json([
                "message" => "user deleted"
            ], 200);
        } else return \response()->json([
            "message" => "something is wrong"
        ], 400);
    }


    public function searchUser(Request $request)
    {

        $role = $request->role;
        $email = $request->email;
        $name = $request->name;
        $id = $request->id;
        $profile_id = $request->profile_id;
        $address = $request->address;
        $phone = $request->phone;
        $users = DB::table('users')->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.email', 'profiles.*')
            ->when($email, function ($query, $email) {
                return $query->where('email', $email);
            })
            ->when($name, function ($query, $name) {
                return $query->where('profiles.name', 'like', '%' . $name . '%');
            })->when($id, function ($query, $id) {
                return $query->where('profiles.user_id', $id);
            })->when($profile_id, function ($query, $profile_id) {
                return $query->where('profiles.id', $profile_id);
            })->when($address, function ($query, $address) {
                return $query->where('address', $address);
            })->when($phone, function ($query, $phone) {
                return $query->where('phone', $phone);
            })
            ->when($role, function ($query, $role) {
                return $query->where('profiles.role', $role);
            })
            ->get();
        return \response()->json($users, 200);


    }

//for comment
    public function addProductComment(Request $request)
    {
        $text = $request->text;


        $profile_id = DB::table('profiles')->where('user_id', Auth::user()->id)->value('id');

        $product_id = $request->product_id;
        $comment = new ProductComment();
        $comment->comment = $text;
        $comment->product_id = $product_id;
        $comment->profile_id = $profile_id;
        $comment->created_at = time();
        if ($comment->save()) {
            return \response()->json('successful', 200);
        } else return \response()->json('something is wrong', 400);
    }

    public function addStoreComment(Request $request)
    {
        $text = $request->text;
        $profile_id = DB::table('profile')->where('user_id', Auth::user()->id)->value('id');
        $store_id = $request->store_id;
        $comment = new StoreComment();
        $comment->comment = $text;
        $comment->store_id = $store_id;
        $comment->profile_id = $profile_id;
        $comment->created_at = time();
        if ($comment->save()) {
            return \response()->json('successful', 200);
        } else return \response()->json('something is wrong', 400);
    }

    public function productComments($id)
    {
        $comments = DB::table('product_comment')->join('profiles', 'profile_id', '=', 'profiles.id')
            ->select('comment', 'name', 'product_comment.id as comment_id')->where('product_id', $id)->get();
        if ($comments) {
            return \response()->json($comments, 200);

        } else  return \response()->json('there is no comment', 400);
    }

    public function StoreComments($id)
    {
        $comments = DB::table('store_comment')->join('profiles', 'profile_id', '=', 'profiles.id')
            ->select('comment', 'name', 'store_comment.id as comment_id')->where('store_id', $id)->get();
        if ($comments) {
            return \response()->json($comments, 200);

        } else  return \response()->json('there is no comment', 400);
    }


}
