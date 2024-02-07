<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Student;

class CheckStudentExistsByName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $name = $request->route('name'); // Get the name from the route parameters
        if(Student::where('name',  'like', '%' . $name . '%')->doesntExist()){
            // return response()->json(['error' => 'No such word exist in database'], 404);
            return response()->json(['status'=>'error','code'=>404,'message'=>'No Such word exists in database'],404);
        }
        return $next($request);
    }
}
