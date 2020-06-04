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
            $subjectList = Subject::orderBy('subject_name', 'asc')->with('enrollee')->get();
            echo json_encode($subjectList);
        }
    }



    public function store(Request $request){
        $rules = [
            'subjectName' => ['required'],
            'room' => ['required'],
            'capacity' => ['required', 'numeric'],
            'schedule' => ['required']
        ];
        
        $messages = [
            'subjectName.required' => 'Please enter a valid Subject Name',
            'room.required' => 'Please enter a valid Room',
            'capacity.required' => 'Please enter a valid Capacity',
            'capacity.numeric' => 'Please enter a valid number in Capacity',
            'schedule.required' => 'Please enter a valid Schedule'
        ];

        $this->validate($request, $rules, $messages);


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
            return response()->json(['exists'=>'That subject name already exists.']);
        }
    }


    public function update(Request $request){
        $rules = [
            'editedSubjectName' => ['required'],
            'editedRoom' => ['required'],
            'editedCapacity' => ['required', 'numeric'],
            'editedSchedule' => ['required'],
        ];

        $messages = [
            'editedSubjectName.required' => 'Please enter a valid Subject Name',
            'editedRoom.required' => 'Please enter a valid Room',
            'editedCapacity.required' => 'Please enter a valid Capacity',
            'editedCapacity.numeric' => 'Please enter a valid Capacity',
            'editedSchedule.required' => 'Please enter a valid Schedule'
        ];

        $this->validate($request, $rules, $messages);


        $oldSubName = $request->oldSubName;
        $id = $request->subjId;

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
            $subject = Subject::firstWhere('id', $id);

            $subject->subject_name = $subName;
            $subject->room = $room;
            $subject->capacity = $capacity;
            $subject->schedule = $sched;

            $subject->save();


            return response()->json(['success'=> 'Successfully edited subject.']);
        }
        else {
            return response()->json(['exists'=>'Another subject already has that name.']);
        }
    }


    
    public function destroy(Request $request) {
        $id = $request->delSubId;
        $subject = Subject::firstWhere('id', $id);

        // for deleting enrollees in this subject
        $subject->enrollee()->delete();
        // for deleting the subject itself
        $subject->delete();

        return response()->json(['success'=>'Successfully deleted subject']);
     }
}