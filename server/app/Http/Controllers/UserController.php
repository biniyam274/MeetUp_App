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
        $messages = [
            'email.required'    => 'The :email filed is needed.',
            'password.required'    => 'The password filed is needed.',
            'name.required'    => 'The Name filed is needed.',
            'name.unique'    => 'The Name filed should be unique.',
            'email.required'    => 'The Email filed should be unique.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ],$messages);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
       
        $user->save();
        unset($user->password);
        return response()->json([
            "user"=>$user,
            "meetups"=>$user->meetups()
        ]);
        
    }


    
    public function signin(Request $request)
    {
        $messages = [
            'email.required'    => 'The :email filed is needed.',
            'password.required'    => 'The password filed is needed.',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
            
        ],$messages);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        
        }
        if (!Auth::attempt($request->only(['email','password']))) {
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

