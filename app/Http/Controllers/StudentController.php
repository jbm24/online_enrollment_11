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
        $rules =[
            'firstName' => ['required'],
            'lastName' => ['required'],
            'idNumber' => ['required', 'numeric'],
            'birthday' => ['required', 'date'],
            'course' => ['required'],
        ];

        $messages = [
            'firstName.required' => 'Please enter a valid First Name',
            'lastName.required' => 'Please enter a valid Last Name',
            'idNumber.required' => 'Please enter a valid ID Number',
            'idNumber.numeric' => 'Please enter a valid ID Number',
            'birthday.date' => 'Please enter a valid date in Birthday',
            'birthday.required' => 'Please enter a valid Birthday',
            'course.required' => 'Please enter a valid Course'
        ];

        $this->validate($request, $rules, $messages);



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


            return response()->json(['success'=> 'Successfully added student.']);
        }
        else {
            return response()->json(['exists'=>'A student with that ID number already exists.']);
        }
    }
    


    public function update(Request $request){
        $rules =[
            'updatedFirstName' => ['required'],
            'updatedLastName' => ['required'],
            'updatedIdNumber' => ['required', 'numeric'],
            'updatedBirthday' => ['required', 'date'],
            'updatedCourse' => ['required'],
        ];

        $messages = [
            'updatedFirstName.required' => 'Please enter a valid First Name',
            'updatedLastName.required' => 'Please enter a valid Last Name',
            'updatedIdNumber.required' => 'Please enter a valid ID Number',
            'updatedIdNumber.numeric' => 'Please enter a valid ID Number',
            'updatedBirthday.date' => 'Please enter a valid date in Birthday',
            'updatedBirthday.required' => 'Please enter a valid Birthday',
            'updatedCourse.required' => 'Please enter a valid Course'
        ];

        $this->validate($request, $rules, $messages);


        $oldIdNum = $request->oldIdNumber;
        $id = $request->studentId;

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
        
            $student = Student::firstWhere('id', $id);

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
            return response()->json(['exists'=>'A student with that ID number already exists.']);
        }
    }


    
    public function destroy(Request $request) {
        Student::where('id', $request->id)->delete();

        return response()->json(['success'=> 'Successfully deleted student.']);
     }
}