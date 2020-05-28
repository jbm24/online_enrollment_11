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
        $subjectList = Subject::orderBy('subject_name', 'asc')->get();
            return view('/enrollment_page', [
                'subjectList' => $subjectList,
                'alreadyEnrolled' => false,              
                'full' => false,
                'flag' => true
            ]);
    }


    public function search(){
        $subject = request('searchSubject');

        $subjectList = Subject::where('subject_name', 'LIKE', "%{$subject}%")->get();
            return view('/enrollment_page', [
                'subjectList' => $subjectList,
                'alreadyEnrolled' => false,              
                'full' => false,
                'flag' => true
            ]);
    }



    public function store(){
        $studId = request('confirmId');
        $birthday = request('confirmBday');
        $subjectName = request('subject');
        $flag = false;
        $alreadyEnrolled = false;
        $id = 1;

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
        
        else $full = true;
        

        $subjectList = Subject::orderBy('subject_name', 'asc')->get();

        return view('/enrollment_page', [
            'subjectList' => $subjectList,
            'alreadyEnrolled' => $alreadyEnrolled,
            'full' => $full,
            'flag' => $flag
        ]);
    }



    public function destroy($id) {
        Enrollee::where('student_id', $id)->delete();

        return redirect('subject_management');
     }


     public function clear() {
        Enrollee::truncate();

        return redirect('subject_management');
     }
}