<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index(){
        return view('/student_management');
    }



    public function fetch(Request $request){
        if ($request->ajax()){
            $studentList = Student::orderBy('last_name', 'asc')->get();
            echo json_encode($studentList);
        }
    }



    public function store(Request $request){
        $fName = $request->firstName;
        $lName = $request->lastName;
        $idNum = $request->idNumber;
        $birthday = $request->birthday;
        $course = $request->course;
        
        $exists = Student::where('id_number', $idNum)->exists();

        if ($exists == false){
            $newStudent = new Student;
            $newStudent->first_name = $fName;
            $newStudent->last_name = $lName;
            $newStudent->id_number = $idNum;
            $newStudent->birthday = $birthday;
            $newStudent->course = $course;

            $newStudent->save();


            $studentList = Student::orderBy('last_name', 'asc')->get();

            return response()->json(['success'=> 'Successfully added student.', 'students'=> $studentList]);
        }
        else {
            return response()->json(['success'=>'A student with that ID number already exists.']);
        }
    }
    


    public function update(Request $request){
        $oldIdNum = $request->oldIdNumber;

        $fName = $request->updatedFirstName;
        $lName = $request->updatedLastName;
        $idNum = $request->updatedIdNumber;
        $birthday = $request->updatedBirthday;
        $course = $request->updatedCourse;

        if ($oldIdNum == $idNum){
            $exists = false;
        }
        else {
            $exists = Student::where('id_number', $idNum)->exists();
        }

        if ($exists == false){
        
            $student = Student::firstWhere('id_number', $oldIdNum);

            $student->first_name = $fName;
            $student->last_name = $lName;
            $student->id_number = $idNum;
            $student->birthday = $birthday;
            $student->course = $course;
            
            $student->save();


            $studentList = Student::orderBy('last_name', 'asc')->get();

            return response()->json(['success'=> 'Successfully edited student.', 'students'=> $studentList]);
        }

        else {
            return response()->json(['success'=>'A student with that ID number already exists.']);
        }
    }


    
    public function destroy(Request $request) {
        Student::where('id', $request->id)->delete();

        return response()->json(['success'=> 'Successfully deleted student.']);
     }
}