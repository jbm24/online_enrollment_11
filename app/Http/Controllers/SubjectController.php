<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
    public function index(){
        return view('/subject_management');
    }



    public function fetch(Request $request){
        if ($request->ajax()){
            $studentList = Subject::orderBy('subject_name', 'asc')->with('enrollee')->get();
            echo json_encode($studentList);
        }
    }



    public function store(Request $request){
        $name = $request->subjectName;
        $room = $request->room;
        $capacity = $request->capacity;
        $schedule = $request->schedule;
        
        $exists = Subject::where('subject_name', $name)->exists();

        if ($exists == false){
            $newSubject = new Subject;
            $newSubject->subject_name = $name;
            $newSubject->room = $room;
            $newSubject->capacity = $capacity;
            $newSubject->schedule = $schedule;

            $newSubject->save();


            return response()->json(['success'=> 'Successfully added subject.']);
        }
        else {
            return response()->json(['success'=>'That subject name already exists.']);
        }
    }


    public function update(Request $request){
        $oldSubName = $request->oldSubName;

        $subName = $request->editedSubjectName;
        $room = $request->editedRoom;
        $capacity = $request->editedCapacity;
        $sched = $request->editedSchedule;

        if ($oldSubName == $subName){
            $exists = false;
        }
        else {
            $exists = Subject::where('subject_name', $subName)->exists();
        }

        
        if ($exists == false){
            $subject = Subject::firstWhere('subject_name', $oldSubName);

            $subject->subject_name = $subName;
            $subject->room = $room;
            $subject->capacity = $capacity;
            $subject->schedule = $sched;

            $subject->save();


            return response()->json(['success'=> 'Successfully edited subject.']);
        }
        else {
            return response()->json(['success'=>'Another subject already has that name.']);
        }
    }


    
    public function destroy(Request $request) {
        $name = $request->delSubName;
        $subject = Subject::firstWhere('subject_name', $name);

        // for deleting enrollees in this subject
        $subject->enrollee()->delete();
        // for deleting the subject itself
        $subject->delete();

        return response()->json(['success'=>'Successfully deleted subject']);
     }
}