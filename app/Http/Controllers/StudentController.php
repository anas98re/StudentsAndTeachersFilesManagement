<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Http\Requests\StudentRequestUpdate;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function getAllStudents()
    {
        if (Auth::user()->role != Constants::EMPLOYEE_ID) {
            return view('home');
        } else {
            $students = student::all();
            return view('students', compact('students'));
        }
    }

    public function CreteStudent(Request $request)
    {
        if (Auth::user()->role != Constants::EMPLOYEE_ID) {
            return view('home');
        } else {
            $User = User::create([
                'name' => $request->name,
                'role' => 4,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $student = new student();
            $student->name = $request->name;
            $student->user_id = $User->id;
            $student->gpa = $request->gpa;
            $student->speailiazation = $request->speailiazation;
            $student->phoneNumber = $request->phoneNumber;

            $student->save();
            if ($student) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('getAllStudents');
        }
    }

    public function deleteStudent(Request $request)
    {
        $student = student::find($request->student_delete_id);
        $student->delete();
        return redirect()->back()->with('messages', 'Done Delete');
    }

    public function editByBob(student $todo)
    {
        return response()->json($todo);
    }

    public function StudentEdit($id)
    {
        $student = student::with('user')->find($id);
        return view('editStudent', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        if (Auth::user()->role != Constants::EMPLOYEE_ID) {
            return view('home');
        } else {
            $user = User::find($request->user_id);
            $student = student::find($id);

            $user->name = $request->name;
            $user->role = 4;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $student->name = $request->name;
            $student->gpa = $request->gpa;
            $student->speailiazation = $request->speailiazation;
            $student->phoneNumber = $request->phoneNumber;
            $student->save();

            return redirect()->route('getAllStudents');
        }
    }

    public function studentShow($id)
    {
        $student = student::find($id);
        return response()->json($student);
    }
}
