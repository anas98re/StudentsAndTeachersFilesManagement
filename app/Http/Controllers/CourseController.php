<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\course;
use App\Models\evaluation;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function courseShow($id)
    {
        $subject = subject::find($id);
        $courses = course::where('subject_id', $subject->id)->get();
        return view('coursesForSubject', compact('courses', 'subject'));
    }

    public function CreteCourse(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $course = new course();

            $course->name = $request->name;
            $course->Link = $request->Link;
            $course->subject_id = $request->subject_id;
            $course->save();

            if ($course) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('coursesForSubject');
        }
    }
    public function courseEdit($id)
    {
        $course = course::find($id);
        return view('editCourse', compact('course'));
    }
    public function updateCourse(Request $request, $id)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $course = course::find($id);

            $course->name = $request->name;
            $course->Link = $request->Link;
            $course->subject_id = $request->subject_id;
            $course->save();


            $subject = subject::find($request->subject_id);
            $cource = course::all();
            return view('coursesForSubject', compact('cource', 'subject'));
        }
    }

    public function deleteCourse(Request $request)
    {
        $course = course::find($request->Course_delete_id);
        $course->delete();
        return redirect()->back()->with('messages', 'Done Delete');
    }

    public function evaluation1($id)
    {
        $evaluation = new evaluation();

        $evaluation->theEvaluation = 100;
        $evaluation->cource_id = $id;
        $evaluation->save();

        $counterWithPercent = evaluation::where('cource_id', $id)->avg('theEvaluation');
        $theLastEvaluation = number_format($counterWithPercent, 1, '.', '');
        course::where('id', $id)->update(['evaluation' => $theLastEvaluation]);


        $courses = course::find($id);
        $subject = subject::find($courses->subject_id);
        $courses = course::where('subject_id', $subject->id)->get();

        return view('coursesForSubject', compact('courses', 'subject'));
    }
    public function evaluation2($id)
    {
        $evaluation = new evaluation();

        $evaluation->theEvaluation = 75;
        $evaluation->cource_id = $id;
        $evaluation->save();

        $counterWithPercent = evaluation::where('cource_id', $id)->avg('theEvaluation');
        $theLastEvaluation = number_format($counterWithPercent, 1, '.', '');

        course::where('id', $id)->update(['evaluation' => $theLastEvaluation]);


        $courses = course::find($id);
        $subject = subject::find($courses->subject_id);
        $courses = course::where('subject_id', $subject->id)->get();

        return view('coursesForSubject', compact('courses', 'subject'));
    }
    public function evaluation3($id)
    {
        $evaluation = new evaluation();

        $evaluation->theEvaluation = 50;
        $evaluation->cource_id = $id;
        $evaluation->save();

        $counterWithPercent = evaluation::where('cource_id', $id)->avg('theEvaluation');
        $theLastEvaluation = number_format($counterWithPercent, 1, '.', '');

        course::where('id', $id)->update(['evaluation' => $theLastEvaluation]);


        $courses = course::find($id);
        $subject = subject::find($courses->subject_id);
        $courses = course::where('subject_id', $subject->id)->get();

        return view('coursesForSubject', compact('courses', 'subject'));
    }
    public function evaluation4($id)
    {
        $evaluation = new evaluation();

        $evaluation->theEvaluation = 25;
        $evaluation->cource_id = $id;
        $evaluation->save();

        $counterWithPercent = evaluation::where('cource_id', $id)->avg('theEvaluation');
        $theLastEvaluation = number_format($counterWithPercent, 1, '.', '');

        course::where('id', $id)->update(['evaluation' => $theLastEvaluation]);


        $courses = course::find($id);
        $subject = subject::find($courses->subject_id);
        $courses = course::where('subject_id', $subject->id)->get();

        return view('coursesForSubject', compact('courses', 'subject'));
    }
}
