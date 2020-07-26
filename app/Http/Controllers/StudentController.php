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

   public function search(Request $request, Recaptcha $recaptcha){
        
    $this->validate($request, [
        'ci' => 'required',
        'birth_date' => 'required',
        'recaptcha' => ['required', $recaptcha],
    ]);
        if($request->complement == null){
            $student = Student::where('ci',$request->ci)
                                ->where('birth_date',$request->date)
                                ->Where(function($query){
                                    $query->whereNull('complement')
                                          ->orwhere('complement','');
                                })
                                ->first();
        }
        else{
            $student = Student::where('ci',$request->ci)->where('complement',strtoupper($request->complement))->where('birth_date',$request->date)->first();
        }
        return $student;
   }
}
