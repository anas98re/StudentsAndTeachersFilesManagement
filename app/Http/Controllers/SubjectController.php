<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\subject;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function getAllSubjects()
    {
        // if (Auth::user()->role != Constants::STUDENT_ID) {
        //     return view('home');
        // } else {
            $teacher=teacher::where('user_id',Auth::user()->id)->first();
            $subjects = subject::all();
            return view('subjects', compact('subjects','teacher'));
        // }
    }

    public function getAllMySubjects()
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $teacher=teacher::where('user_id',Auth::user()->id)->first();
            $subjects = subject::where('techer_id',$teacher->id)->get();
            return view('subjects', compact('subjects','teacher'));
        }
    }


    public function CreteSubject(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $teacher = teacher::where('user_id', Auth::user()->id)->first();
            $subject = new subject();
            $subject->name = $request->name;
            $subject->year = $request->year;
            $subject->LinkForTheLastMarks = $request->LinkForTheLastMarks;
            $subject->techer_id = $teacher->id;

            $subject->save();
            if ($subject) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('getAllSubjects');
        }
    }

    public function deleteSubject(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $subject = subject::find($request->subject_delete_id);
            $subject->delete();
            return redirect()->back()->with('messages', 'Done Delete');
        }
    }

    public function SubjectEdit($id)
    {
        $subject = subject::find($id);
        return view('editSubject', compact('subject'));
    }

    public function updateSubject(Request $request, $id)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $subject = subject::find($id);
            $subject->name = $request->name;
            $subject->year = $request->year;
            $subject->LinkForTheLastMarks = $request->LinkForTheLastMarks;
            $subject->techer_id = $request->techer_id;


            $subject->save();
            return redirect()->route('getAllSubjects');
        }
    }

    public function subjectShow($id)
    {
        $subject = subject::find($id);
        $lectures = $subject->lectures;
        return view('lecturesForSubject', compact('lectures', 'subject'));
    }
}
