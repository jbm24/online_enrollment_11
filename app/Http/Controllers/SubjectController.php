<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
    public function index(){
        $subjectList = Subject::orderBy('subject_name', 'asc')->get();

        return view('/subject_management', [
            'subjects' => $subjectList,
            'exists' => false
        ]);
    }



    public function store(){
        $name = request('subjectName');
        $room = request('room');
        $capacity = request('capacity');
        $schedule = request('schedule');
        
        $exists = Subject::where('subject_name', $name)->exists();

        if ($exists == false){
            $newSubject = new Subject;
            $newSubject->subject_name = $name;
            $newSubject->room = $room;
            $newSubject->capacity = $capacity;
            $newSubject->schedule = $schedule;

            $newSubject->save();
        }

        $subjectList = Subject::orderBy('subject_name', 'asc')->get();

        return view('/subject_management', [
            'subjects' => $subjectList,
            'exists' => $exists
        ]);
    }


    public function update(){
        $oldSubName = request('oldSubName');

        $subName = request('editedSubjectName');
        $room = request('editedRoom');
        $capacity = request('editedCapacity');
        $sched = request('editedSchedule');

        if ($oldSubName == $subName){
            $exists = false;
        }
        else {
            $exists = Subject::where('subject_name', $subName)->exists();
        }
        
        if ($exists == false){
            $subject = Subject::where('subject_name', $oldSubName)->first();

            $subject->subject_name = $subName;
            $subject->room = $room;
            $subject->capacity = $capacity;
            $subject->schedule = $sched;

            $subject->save();
        }

        $subjectList = Subject::orderBy('subject_name', 'asc')->get();
        
        return view('/subject_management', [
            'subjects' => $subjectList,
            'exists' => $exists
        ]);
    }


    
    public function destroy() {
        $name = request('delSubName');

        Subject::where('subject_name', $name)->delete();

        return redirect('subject_management');
     }
}