<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Student;

class CheckStudentExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('id'); // Get the id from the route parameters
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['status'=>'error','code'=>404,'message'=>'No Such ID found','data'=>$student],404);
        }

        // Add the student to the request so we can access it in the controller
        $request->merge(['student' => $student]);

        return $next($request);
    }
}