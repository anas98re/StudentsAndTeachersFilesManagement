<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\lecture;
use App\Models\lectureFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LectureFileController extends Controller
{
    public function Cretefile(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $lectureFile = new lectureFile();
            $lectureFile->name = $request->name;
            $lectureFile->LinkForDownloade = $request->LinkForDownloade;
            $lectureFile->lecture_id = $request->lecture_id;
            $lectureFile->save();

            $lecture = lecture::find($request->lecture_id);
            $files = $lecture->files;
            if ($lectureFile) {
                return response()->json(['success' => 'Added new records.']);
            }
            return view('filesForLecture', compact('files', 'lecture'));
        }
    }
    public function LectureFileEdit($id)
    {
        $lectureFile = lectureFile::find($id);
        return view('editFile', compact('lectureFile'));
    }
    public function updateLectureFile(Request $request, $id)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $lectureFile = lectureFile::find($id);
            $lecture = lecture::find($request->lecture_id);
            $files = $lecture->files;

            $lectureFile->name = $request->name;
            $lectureFile->LinkForDownloade = $request->LinkForDownloade;
            $lectureFile->lecture_id = $request->lecture_id;

            $lectureFile->save();
            return view('filesForLecture', compact('lecture', 'files'));
        }
    }

    public function deleteFile(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $lectureFile = lectureFile::find($request->File_delete_id);

            $lectureFile->delete();
            return redirect()->back()->with('messages', 'Done Delete');
        }
    }
}
