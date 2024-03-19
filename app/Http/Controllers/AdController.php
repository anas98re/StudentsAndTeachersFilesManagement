<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\ad;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function ADSShow($id)
    {
        $subject = subject::find($id);
        $ads = ad::where('subject_id', $subject->id)->get();
        return view('adsForSubject', compact('ads', 'subject'));
    }

    public function CreteAD(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $ad = new ad();

            // $photo = $request->photo;
            // if ($request->hasFile('photo')) {
                // $data['photo'] = $request->photo->move('public');
                // $ad->photo = $data['photo'];
                // $imageName = time().'.'.$request->photo->extension();
                // $request->photo->move(public_path('public'), $imageName);
            // }
            // $newPhoto = time() . $photo->getClientOriginalName();
            // $photo->move('public', $newPhoto);
            $ad->name = $request->name;
            $ad->text = $request->text;
            $ad->descreption = $request->descreption;
            $ad->subject_id = $request->subject_id;

            $ad->save();

            if ($ad) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('adsForSubject');
        }
    }

    public function deleteAD(Request $request)
    {
        $ad = ad::find($request->AD_delete_id);
        $ad->delete();
        return redirect()->back()->with('messages', 'Done Delete');
    }

    public function ADShow($id)
    {
        $ad = ad::find($id);
        return response()->json($ad);
    }

    public function ADEdit($id)
    {
        $ad = ad::find($id);
        return view('editAD', compact('ad'));
    }

    public function updateAD(Request $request, $id)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $ad = ad::find($id);

            $ad->name = $request->name;
            $ad->descreption = $request->descreption;
            $ad->subject_id = $request->subject_id;
            $ad->save();

            $subject = subject::find($request->subject_id);
            $ads = ad::all();
            return view('adsForSubject', compact('ads', 'subject'));
        }
    }
}
