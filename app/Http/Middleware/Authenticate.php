<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorizations');

        if (!$header) {
            return response()->json(['status'=>'error','code'=>202,'message' => 'Token Not found'], 202);
        }

        $user = User::where('token', $header)->first();
        if (!$user) {
            return response()->json(['status'=>'error','code'=>202,'message' => 'Token invalid'], 202);
        }
        

        return $next($request);
    }
}