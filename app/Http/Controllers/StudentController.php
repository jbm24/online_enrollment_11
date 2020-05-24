<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    public function index(){
        $students = DB::table('students')->orderBy('last_name', 'asc')->get();

        return view('/student_management', [
            'students' => $students,
            'exists' => false
        ]);
    }



    public function store(){
        $fName = request('firstName');
        $lName = request('lastName');
        $idNum = request('idNumber');
        $birthday = request('birthday');
        $course = request('course');
        
        $exists = DB::table('students')->where('id_number', $idNum)->exists();

        if ($exists == false){
            DB::table('students')->insert(
                ['first_name' => $fName, 'last_name' => $lName, 'id_number' => $idNum, 'birthday' => $birthday, 'course' => $course]
            );
        }

        $students = DB::table('students')->orderBy('last_name', 'asc')->get();

        return view('/student_management', [
            'students' => $students,
            'exists' => $exists
        ]);
    }




    public function edit($id){
        $student = DB::table('students')->where('id_number', $id)->first();

        $fName = $student->first_name;
        $lName = $student->last_name;
        $idNum = $student->id_number;
        $bday = $student->birthday;
        $course = $student->course;

        return view('/update_student', [
            'fName' => $fName,
            'lName' => $lName,
            'idNum' => $idNum,
            'bday' => $bday,
            'course' => $course,
            'id' => $id
        ]);
    }

    


    public function update($id){
        $fName = request('firstName');
        $lName = request('lastName');
        $idNum = request('idNumber');
        $birthday = request('birthday');
        $course = request('course');
        
            DB::table('students')->where('id_number', $id)->update(
                ['first_name' => $fName, 'last_name' => $lName, 'id_number' => $idNum, 'birthday' => $birthday, 'course' => $course]
            );


        return redirect('student_management');
    }


    
    public function destroy($id) {
        DB::table('students')->where('id_number', $id)->delete();

        $students = DB::table('students')->get();

        return redirect('student_management');
     }
}