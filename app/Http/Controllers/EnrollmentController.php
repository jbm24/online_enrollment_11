<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\Enrollee;

class EnrollmentController extends Controller
{
    public function index(){
        return view('/enrollment_page');
    }


    public function fetch(Request $request){
        if ($request->ajax()){
            $subjectList = Subject::orderBy('subject_name', 'asc')->with('enrollee')->get();
            echo json_encode($subjectList);
        }
    }


    public function fetchEnrollees(Request $request){
        if ($request->ajax()){
            $enrolleeList = Enrollee::where('subject_id', $request->id)->with('student')->get();
            echo json_encode($enrolleeList);
        }
    }


    public function search(Request $request){
        if ($request->ajax()){   
            $subject = $request->searchSubject;
            
            $subjectList = Subject::where('subject_name', 'LIKE', "%{$subject}%")->orderBy('subject_name', 'asc')->with('enrollee')->get();
            echo json_encode($subjectList);
        }
    }



    public function store(Request $request){
        $studId = $request->confirmId;
        $birthday = $request->confirmBday;
        $subjectName = $request->subject;
        $flag = false;
        $alreadyEnrolled = false;

        $subject = Subject::firstWhere('subject_name', $subjectName);
        if ($subject->enrollee()->count() < $subject->capacity) {
            $full = false;
            $students = Student::all();
            foreach ($students as $student) {

                if ($studId == $student->id_number && $birthday == $student->birthday){
                    $flag = true; //Correct student details
                    $id = $student->id;
                    break;
                }
            }

            if ($flag == true){
                $alreadyEnrolled = Enrollee::where('student_id', $id)->where('subject_id', $subject->id)->exists();
                
                if ($alreadyEnrolled == false){
                    $newEnrollee = new Enrollee;
                    $newEnrollee->student()->associate($student);
                    $newEnrollee->subject()->associate($subject);

                    $newEnrollee->save();
                }
            }
        }
        else {
            $full = true;
        }


        if ($full == true){
            return response()->json(['success'=> 'This subject is already full.']);
        }
        else if ($flag == false){
            return response()->json(['wrong'=> 'Wrong ID Number or Birthday.']);
        }
        else if ($alreadyEnrolled == true){
            return response()->json(['success'=> 'You are already enrolled in this subject.']);
        }
        else {
            return response()->json(['success'=> 'You have successfully enrolled']);
        }
    }



    public function destroy(Request $request) {
        Enrollee::where('id', $request->id)->delete();

        return response()->json(['success'=> 'Successfully unenrolled student']);
     }

     

     public function clear() {
        Enrollee::truncate();

        return redirect('subject_management');
     }
}