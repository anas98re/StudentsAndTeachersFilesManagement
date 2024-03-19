<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\homework;
use App\Models\lecture;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller
{
    public function CreteLecture(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $lecture = new lecture();
            $lecture->name = $request->name;
            $lecture->LinkForDownloade = $request->LinkForDownloade;
            $lecture->subject_id = $request->subject_id;

            $lecture->save();
            if ($lecture) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('getAllSubjects');
        }
    }

    public function deleteLecture(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $lecture = lecture::find($request->Lecture_delete_id);

            $lecture->delete();
            return redirect()->back()->with('messages', 'Done Delete');
        }
    }

    public function LectureEdit($id)
    {
        $lecture = lecture::find($id);
        return view('editLecture', compact('lecture'));
    }
    public function updateLecture(Request $request, $id)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $lecture = lecture::find($id);
            $subject = subject::find($lecture->subject_id);
            $lectures = $subject->lectures;

            $lecture->name = $request->name;
            $lecture->LinkForDownloade = $request->LinkForDownloade;
            $lecture->subject_id = $request->subject_id;

            $lecture->save();
            return view('lecturesForSubject', compact('subject', 'lectures'));
        }
    }

    public function LectureFiles($id)
    {
        $lecture = lecture::find($id);
        $files = $lecture->files;
        return view('filesForLecture', compact('files', 'lecture'));
    }

    public function LectureHomeWorks($id)
    {
        $lecture = lecture::find($id);
        $homeWorkes = $lecture->homeWorkes;
        $homeWorkes2 = homework::all();
        return view('homeWorkesForLecture', compact('homeWorkes', 'lecture','homeWorkes2'));
    }
}
