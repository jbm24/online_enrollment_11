<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index(){
        $studentList = Student::orderBy('last_name', 'asc')->get();

        return view('/student_management', [
            'students' => $studentList,
            'exists' => false
        ]);
    }



    public function store(){
        $fName = request('firstName');
        $lName = request('lastName');
        $idNum = request('idNumber');
        $birthday = request('birthday');
        $course = request('course');
        
        $exists = Student::where('id_number', $idNum)->exists();

        if ($exists == false){
            $newStudent = new Student;
            $newStudent->first_name = $fName;
            $newStudent->last_name = $lName;
            $newStudent->id_number = $idNum;
            $newStudent->birthday = $birthday;
            $newStudent->course = $course;

            $newStudent->save();
        }

        $studentList = Student::orderBy('last_name', 'asc')->get();

        return view('/student_management', [
            'students' => $studentList,
            'exists' => $exists
        ]);
    }
    


    public function update(){
        $oldIdNum = request('oldIdNumber');

        $fName = request('updatedFirstName');
        $lName = request('updatedLastName');
        $idNum = request('updatedIdNumber');
        $birthday = request('updatedBirthday');
        $course = request('updatedCourse');

        $exists = Student::where('id_number', $idNum)->exists();

        if ($exists == false){
        
            $student = Student::firstWhere('id_number', $oldIdNum);

            $student->first_name = $fName;
            $student->last_name = $lName;
            $student->id_number = $idNum;
            $student->birthday = $birthday;
            $student->course = $course;
            
            $student->save();
        }

        $studentList = Student::orderBy('last_name', 'asc')->get();
        
        return view('/student_management', [
            'students' => $studentList,
            'exists' => $exists
        ]);
    }


    
    public function destroy($id) {
        Student::where('id_number', $id)->delete();

        return redirect('student_management');
     }
}