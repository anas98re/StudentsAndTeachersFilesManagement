<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\project;
use App\Models\student;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function getAllProjects()
    {
        if (Auth::user()->role == Constants::TEACHER_ID || Auth::user()->role == Constants::EMPLOYEE_ID) {
            return view('home');
        }
        else if(Auth::user()->role == Constants::ADMIN_ID) {
            $student = student::where('user_id', Auth::user()->id)->first();
            $projects = project::all();
            $teacher = teacher::where('user_id', Auth::user()->id)->first();

            // $projects = project::all();
            return view('projects', compact('projects', 'teacher','student'));
        }
        else  {
            $student = student::where('user_id', Auth::user()->id)->first();
            $projects = project::where('student_id', $student->id)->get();
            $teacher = teacher::where('user_id', Auth::user()->id)->first();

            // $projects = project::all();
            return view('projects', compact('projects', 'teacher','student'));
        }
    }

    public function getAllMyProjects()
    {
        if (Auth::user()->role != Constants::TEACHER_ID ) {
            return view('home');
        } else {
            $student = student::where('user_id', Auth::user()->id)->first();
            $teacher = teacher::where('user_id', Auth::user()->id)->first();
            $projects = project::where('teacher_id', $teacher->id)->get();
            return view('projects', compact('projects', 'teacher','student'));
        }
    }
    public function CreteProject(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID || Auth::user()->role != Constants::ADMIN_ID) {
            return view('home');
        } else {
            $teacher = teacher::where('user_id', Auth::user()->id)->first();
            $project = new project();
            $project->student_id = $request->studentName;
            $project->teacher_id = $teacher->id;
            $project->title = $request->title;
            $project->keyword = $request->keyword;
            $project->descrition = $request->descrition;
            $project->tool = $request->tool;
            $project->supervisored = $request->supervisored;
            $project->type = $request->type;
            $project->speailiazation = $request->speailiazation;
            $project->studentName = $request->studentName;

            $project->save();
            if ($project) {
                return response()->json(['success' => 'Added new records.']);
            }
            return redirect()->route('getAllProjects');
        }
    }

    public function deleteProject(Request $request)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $project = project::find($request->project_delete_id);

            $project->delete();
            return redirect()->back()->with('messages', 'Done Delete');
        }
    }
    public function editBybob(project $todo)
    {
        return response()->json($todo);
    }

    public function ProjectEdit($id)
    {
        $project = project::find($id);
        return view('editProject', compact('project'));
    }

    public function updateProject(Request $request, $id)
    {
        if (Auth::user()->role != Constants::TEACHER_ID) {
            return view('home');
        } else {
            $project = project::find($id);
            $project->title = $request->title;
            $project->keyword = $request->keyword;
            $project->descrition = $request->descrition;
            $project->tool = $request->tool;
            $project->supervisored = $request->supervisored;
            $project->type = $request->type;
            $project->speailiazation = $request->speailiazation;
            $project->studentName = $request->studentName;

            $project->save();
            return redirect()->route('getAllProjects');
        }
    }

    public function ProjectShow($id)
    {
        $project = project::find($id);
        return response()->json($project);
    }
}
