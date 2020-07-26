<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

   public function search(Request $request){
        
        if($request->complement != null)
            $student = Student::where('ci',$request->ci)->where('complement',strtoupper($request->complement))->where('birth_date',$request->date)->first();
        else
            $student = Student::where('ci',$request->ci)->where('birth_date',$request->date)->first();
        return $student;
   }
}
