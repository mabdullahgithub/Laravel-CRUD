<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    //function to get data from database
    public function list(Request $request, $id = null)
    {
        if ($id) {
            $student = $request->student;
            return response()->json($student);
        } else {
            $students = Student::all();
            return response()->json($students);
        }
    }

    //function to post data in database
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'course' => 'required',
        ]);

        if(Student::where('email', $request->email)->exists()){
            return response()->json(['error' => 'Duplicate entry'], 202);
        }

        $student = Student::create($validatedData);
        
        return response()->json(['status'=>'success','code'=>202,'message'=>'Student data Added successfully','data'=>$student],202);
     
    }

    //function to update data in database
    // public function update($id, Request $request)
    // {
    //     $student = Student::find($id);

    //     if(!$student){
    //         return response()->json(['error' => 'No such ID'], 404);
    //     }else{
    //         $student->update($request->all());
    //     }

    //     return response()->json($student, 202);
    // }
    public function update(Request $request, $id)
    {
        $student = $request->student;

        $student->update($request->all());

        return response()->json(['status'=>'success','code'=>202,'message'=>'Student data Updated successfully','data'=>$student],202);
    }

    //function to delete data from database
    public function delete(Request $request)
    {
        $student = $request->student;

        $student->delete();

        return response()->json(['status'=>'success','code'=>202,'message'=>'Student deleted successfully','data'=>$student],202);
    }

    //function to search data from database
    public function search($name)
    {
        $student = Student::where('name', 'like', '%' . $name . '%')->get();
        return response()->json(['status'=>'success','code'=>202,'message'=>'Student data found successfully','data'=>$student],202);
    }
    
}

