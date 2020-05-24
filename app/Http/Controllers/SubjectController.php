<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SubjectController extends Controller
{
    public function index(){
        $subjects = DB::table('subjects')->orderBy('subject_name', 'asc')->get();

        return view('/subject_management', [
            'subjects' => $subjects,
            'exists' => false
        ]);
    }



    public function store(){
        $name = request('subjectName');
        $room = request('room');
        $capacity = request('capacity');
        $schedule = request('schedule');
        
        $exists = DB::table('subjects')->where('subject_name', $name)->exists();

        if ($exists == false){
            DB::table('subjects')->insert(
                ['subject_name' => $name, 'room' => $room, 'capacity' => $capacity, 'schedule' => $schedule]
            );
        }

        $subjects = DB::table('subjects')->orderBy('subject_name', 'asc')->get();

        return view('/subject_management', [
            'subjects' => $subjects,
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
