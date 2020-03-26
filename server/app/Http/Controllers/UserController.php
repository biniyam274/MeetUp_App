<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' =>'required',
            'password'=> 'required'
        ]);
       
        if ($validator->fails()) {
            return response()->json(["error"=>$validator->errors(),"request"=>$request->all()]);
        }else{
        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('username');
        $user->save();
        return response()->json([
            "user"=>$user,
            "meetups"=>$user->meetups()
        ]);
        }
        return json_encode($request->all());
    }



    public function signin(Request $request)
    {
        $validator = $request->validate([
            'email' =>'required',
            'password'=> 'required'
        ]);
        if (!Auth::attempt($validator)) {
            return response()->json([
                'error' => 'Unauthorized',
        ], 401);
        }
        $accsessToken = Auth::user()->createToken('authToken')->accessToken;
        $user = Auth::user();
        unset($user["password"]);
        return response()->json([
            'user'=>$user,
            'access_token' => $accsessToken,
            "meetups"=>$user->meetups()->get('id')
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
}

