<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\employee;
use App\Models\mark;
use App\Models\student;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

class EmployeeController extends Controller
{
    public function getHOME()
    {
        $students = student::all()->count();
        $teachers = teacher::all()->count();
        $ordered = student::max('rate');
        $studentN = student::where('rate', $ordered)->first();
        $studentName = $studentN->name;
        $ww = mark::avg('theMark');
        $counterWithPercent = number_format($ww, 1, '.', '');

        return view('home', compact('students', 'teachers', 'ordered', 'studentName', 'counterWithPercent'));
    }
    public function getAllEmployee()
    {
        // if (Auth::user()->can('viewAllEmoloyees', employee::class)) {
            $employees = employee::all();
            return view('employees', compact('employees'));
        // }
        // return view('home403');
    }

    public function storeEmployee(Request $request)
    {
        if (Auth::user()->role != Constants::ADMIN_ID) {
            return view('home');
        } else {
            $User = User::create([
                'name' => $request->name,
                'role' => 2,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $Employee = Employee::create([
                'name' => $User->name,
                'user_id' => $User->id
            ]);
            $Employee->save();
            return redirect()->route('getAllEmployee')->with('success', 'Done');
        }
    }
    public function deleteEmployee(Request $request)
    {
        if (Auth::user()->role != Constants::ADMIN_ID) {
            return view('home');
        } else {
            $Employee = Employee::find($request->employee_delete_id);
            $Employee->delete();
            $user = User::where('id', $Employee->user_id)->first();
            $user->delete();
            return redirect()->back()->with('messages', 'Done Delete');
        }
    }
}
