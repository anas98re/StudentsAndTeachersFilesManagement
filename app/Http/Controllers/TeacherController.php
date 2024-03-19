<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function getAllTeachers()
    {
        if (Auth::user()->role != Constants::EMPLOYEE_ID) {
            return view('home');
        } else {
            $teachers = teacher::all();
            return view('teachers', compact('teachers'));
        }
    }
    public function editTeachers(teacher $todo)
    {
        $var[] = $todo;
        $var[] = $todo->user;
        return response()->json($todo);
    }
    public function CreteTeacher(Request $request)
    {
        if (Auth::user()->role != Constants::EMPLOYEE_ID) {
            return view('home');
        } else {
            $User = User::create([
                'name' => $request->name,
                'role' => 3,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $teacher = new teacher();
            $teacher->user_id = $User->id;
            $teacher->name = $request->name;
            $teacher->address = $request->address;
            $teacher->dateOfBrithe = $request->dateOfBrithe;
            $teacher->specialist = $request->specialist;
            $teacher->phoneNumber = $request->phoneNumber;

            $teacher->save();
            if ($teacher) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('getAllTeachers');
        }
    }

    public function deleteTeacher(Request $request)
    {
        $teacher = teacher::find($request->teacher_delete_id);

        $teacher->delete();
        return redirect()->back()->with('messages', 'Done Delete');
    }

    public function TeacherEdit($id)
    {
        $teacher = teacher::with('user')->find($id);
        return view('editTeacher', compact('teacher'));
    }

    public function updateTeacher(Request $request, $id)
    {
        if (Auth::user()->role != Constants::EMPLOYEE_ID) {
            return view('home');
        } else {
            $user = User::find($request->user_id);
            $teacher = teacher::find($id);

            $user->name = $request->name;
            $user->role = 4;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $teacher->name = $request->name;
            $teacher->address = $request->address;
            $teacher->dateOfBrithe = $request->dateOfBrithe;
            $teacher->specialist = $request->specialist;
            $teacher->phoneNumber = $request->phoneNumber;
            $teacher->save();

            return redirect()->route('getAllTeachers');
        }
    }

    public function SaveTeacher(Request $request)
    {
        $user = User::find($request->user_id);
        $teacher = teacher::where('user_id', $request->user_id)->first();

        $request->validate([
            'id' => "required",

            'name' => "required|unique:users,name,{$user->id}|string|min:3|max:20",
            'email' => "required|email|unique:users,email,{$user->id}",
            'phoneNumber' => "required",
            'address' => 'required',
            'password' => 'required|min:8',
            'dateOfBrithe' => 'required',
            'specialist' => 'required',
            // 'department_id' => 'required',
            'role' => 'required|in:1,2,3',
            // 'user_id'=>'required'
        ]);
        // $teacher = teacher::find( $request->id);
        $user->name = $request->name;
        $user->role = 3;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $teacher->id = $request->id;
        $teacher->name = $request->name;
        $teacher->user_id = $request->user_id;
        $teacher->address = $request->address;
        $teacher->dateOfBrithe = $request->dateOfBrithe;
        $teacher->specialist = $request->specialist;
        $teacher->phoneNumber = $request->phoneNumber;

        $teacher->save();
        // $User = User::updated([
        //     'name' => $request->name,
        //     'role' => 3,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password)
        // ]);

        return redirect()->route('getAllTeachers');
    }

    public function teacherShow($id)
    {
        $teacher = teacher::find($id);
        return response()->json($teacher);
    }
}
