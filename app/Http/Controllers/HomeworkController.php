<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\homework;
use App\Models\homeWorkFiles;
use App\Models\lecture;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function CreteHomeWork(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $homework = new homework();
            $homework->name = $request->name;
            $homework->LinkForDownloade = $request->LinkForDownloade;
            $homework->lecture_id = $request->lecture_id;
            $homework->save();

            $lecture = lecture::find($request->lecture_id);
            $homeWorkes = $lecture->homeWorkes;
            if ($homework) {
                return response()->json(['success' => 'Added new records.']);
            }
            return view('homeWorkesForLecture', compact('homeWorkes', 'lecture'));
        }
    }

    public function LectureHomeWorkEdit($id)
    {
        $homework = homework::find($id);
        return view('editHomeWork', compact('homework'));
    }

    public function updateLectureHomeWork(Request $request, $id)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $homework = homework::find($id);
            $lecture = lecture::find($request->lecture_id);
            $homeWorkes = $lecture->homeWorkes;

            $homework->name = $request->name;
            $homework->LinkForDownloade = $request->LinkForDownloade;
            $homework->lecture_id = $request->lecture_id;

            $homework->save();
            return view('homeWorkesForLecture', compact('lecture', 'homeWorkes'));
        }
    }


    public function deleteHomeWork(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $homework = homework::find($request->homeWork_delete_id);

            $homework->delete();
            return redirect()->back()->with('messages', 'Done Delete');
        }
    }

    public function UploadHomeWork(Request $request)
    {
        if (Auth::user()->role != Constants::STUDENT_ID) {
            return view('home');
        } else {
            $student = student::where('user_id', Auth::user()->id)->first();

            $homeWorkFiles = new homeWorkFiles();
            $homeWorkFiles->name = $request->name;
            $homeWorkFiles->homeWork_id = $request->homeWork_id;
            $homeWorkFiles->LinkForDownloade = $request->LinkForDownloade;
            $homeWorkFiles->student_id = $student->id;

            $homeWorkFiles->save();

            if ($homeWorkFiles) {
                return response()->json(['success' => 'Added new records.']);
            }
            return view('homeWorkesForLecture', compact('homeWorkes', 'lecture'));
        }
    }

    public function ShowTheHomeWorks($id)
    {
        // return $id;
        $home_work_file = homeWork::find($id);
        $lecture=$home_work_file->lecture_id;
        $home_work_files=homeWorkFiles::where('homeWork_id',$home_work_file->id)->get();
        return view('homeWorkFiles', compact('home_work_file','home_work_files','lecture'));
    }
}
