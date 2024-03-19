<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\mark;
use App\Models\student;
use App\Models\subject;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{

    public function getAllMarks()
    {
        if (Auth::user()->role != Constants::ADMIN_ID) {
            return view('home');
        } else {
            $student = User::where('id', Auth::user()->id)->first();
            $marks = mark::all();
            $ww = mark::avg('theMark');
            $counterWithPercent = number_format($ww, 1, '.', '');

            return view('myMarks', compact('marks', 'student', 'counterWithPercent'));
        }
    }

    public function getAllMyMarks()
    {
        if (Auth::user()->role != Constants::STUDENT_ID) {
            return view('home');
        } else {
            $student = student::where('user_id', Auth::user()->id)->first();
            $marks = mark::where('student_id', $student->id)->get();

            $ww = $student->rate;
            $counterWithPercent = number_format($ww, 1, '.', '');
            return view('myMarks', compact('marks', 'student', 'counterWithPercent'));
        }
    }

    public function marksShow($id)
    {
        if (Auth::user()->role == Constants::EMPLOYEE_ID || Auth::user()->role == Constants::STUDENT_ID) {
            return view('home');
        } else {
            $subject = subject::find($id);
            $marks = mark::where('subject_id', $subject->id)->get();
            $sucssesCount = mark::where('subject_id', $subject->id)->where('theMark', '<', '60')->count();
            $failCount = mark::where('subject_id', $subject->id)->where('theMark', '>=', '60')->count();
            if (mark::where('subject_id', $subject->id)->count() == 0) {
                $sucssesMarks = 0;
                $failMarks = 0;
            } else {
                $sucssesMarks = $sucssesCount / mark::where('subject_id', $subject->id)->count();
                $failMarks = $failCount / mark::where('subject_id', $subject->id)->count();
            }
            return view('marksForSubject', compact('marks', 'subject', 'sucssesMarks', 'failMarks'));
        }
    }

    public function CreteMark(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $teacher = teacher::where('user_id', Auth::user()->id)->first();
            $mark = new mark();

            $mark->theMark = $request->theMark;
            $mark->student_id = $request->student_id;
            $mark->teacher_id = $teacher->id;
            $mark->semesterSession = $request->semesterSession;
            $mark->subject_id = $request->subject_id;
            $mark->save();

            $marks = mark::where('student_id', $request->student_id)->get();
            $student = student::find($request->student_id);

            $counter = 0;
            for ($i = 0; $i < $marks->count(); $i++) {
                $counter = $counter + $marks[$i]->theMark;
            }
            $theLastRate = number_format($counter / $marks->count(), 1, '.', '');
            student::where('id', $request->student_id)->update(['rate' => $theLastRate]);

            if ($mark) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('adsForSubject');
        }
    }

    public function deleteMark(Request $request)
    {
        $mark = mark::find($request->Mark_delete_id);
        $mark->delete();

        $student = student::find($mark->student_id);
        $marks = mark::where('student_id', $mark->student_id)->get();
        $counter = 0;
        for ($i = 0; $i < $marks->count(); $i++) {
            $counter = $counter + $marks[$i]->theMark;
        }
        $theLastRate = number_format($counter / $marks->count(), 1, '.', '');
        student::where('id', $mark->student_id)->update(['rate' => $theLastRate]);

        return redirect()->back()->with('messages', 'Done Delete');
    }
}
