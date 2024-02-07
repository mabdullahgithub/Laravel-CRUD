<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request as OtherRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class auth extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $token = Str::random(10);
        $user->token =  $token;
        $user->save();
        
        return response()->json(['status' => 'success', 'user' => $user,'token' => $user->api_token, 'token' => $token], 201);
    }


    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
    }

    $token = Str::random(10);
    $user->forceFill([
        'token' => $token,
    ])->save();

    return response()->json(['status' => 'success', 'user' => $user, 'token' => $token]);
    }


    public function Logout(Request $request)
    {
    $token = $request->header('Authorizations');
    $user = User::where('token', $token)->first();

    if ($user) {
        $user->token = null;
        $user->save();

        return response()->json(['status'=>'success','code'=>200,'message'=>'User logged out successfully'],200);
    } else {
        return response()->json(['status'=>'error','code'=>401,'message'=>'User not found'],200);
    }
    }


    public function searchs(Request $request)
    {
    $id = $request->route('id');
    $token = $request->header('Authorizations');
    // dd($token);
    $user = User::where('id', $id)->first();
    // dd($user);
    if ( $user && $user->token == $token) {
        return response()->json(['status'=>'success','code'=>200,'message'=>'User found successfully','data'=>$user],200);
    } else {
        return response()->json(['status'=>'error','code'=>404,'message'=>'User not found or token does not match'],404);
    }
    }

    
    public function test(Request $request)
    {
        $token = $request->header('Authorizations');
        $user = User::where('token', $token)->first();
        return response()->json(['status'=>'success','code'=>200,'message'=>'Tested successfully','data'=>$user],200);
    }
}