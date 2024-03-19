<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\LectureFileController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']);

Route::middleware(['auth'])->group(function () {
Route::get('/home', [EmployeeController::class, 'getHOME'])->name('getHOME');

Route::get('getAllMarks', [MarkController::class, 'getAllMarks'])->name('getAllMarks');
Route::get('getAllMyMarks', [MarkController::class, 'getAllMyMarks'])->name('getAllMyMarks');
Route::get('marksShow/{id}', [MarkController::class, 'marksShow'])->name('marksShow');
Route::post('marksShow/CreteMark', [MarkController::class, 'CreteMark'])->name('CreteMark');
Route::post('deleteMark', [MarkController::class, 'deleteMark'])->name('deleteMark');


Route::get('courseShow/{id}', [CourseController::class, 'courseShow'])->name('courseShow');
Route::post('courseShow/CreteCourse', [CourseController::class, 'CreteCourse'])->name('CreteCourse');
Route::get('/courseEdit/{id}', [CourseController::class, 'courseEdit'])->name('courseEdit');
Route::post('updateCourse/{id}', [CourseController::class, 'updateCourse'])->name('updateCourse');
Route::post('deleteCourse', [CourseController::class, 'deleteCourse'])->name('deleteCourse');
Route::get('/evaluation4/{id}', [CourseController::class, 'evaluation4'])->name('evaluation4');
Route::get('/evaluation2/{id}', [CourseController::class, 'evaluation2'])->name('evaluation2');
Route::get('/evaluation3/{id}', [CourseController::class, 'evaluation3'])->name('evaluation3');
Route::get('/evaluation1/{id}', [CourseController::class, 'evaluation1'])->name('evaluation1');


Route::get('ADSShow/{id}', [AdController::class, 'ADSShow'])->name('ADSShow');
Route::post('ADSShow/CreteAD', [AdController::class, 'CreteAD'])->name('CreteAD');
Route::post('deleteAD', [AdController::class, 'deleteAD'])->name('deleteAD');
Route::get('ADShow/{id}', [AdController::class, 'ADShow'])->name('ADShow');
Route::get('/ADEdit/{id}', [AdController::class, 'ADEdit'])->name('ADEdit');
Route::post('updateAD/{id}', [AdController::class, 'updateAD'])->name('updateAD');

Route::get('getAllEmployee', [EmployeeController::class, 'getAllEmployee'])
->name('getAllEmployee')
->middleware(['auth','can:viewAllEmoloyees,App\models\emplloyee']);
Route::post('storeEmployee', [EmployeeController::class, 'storeEmployee'])->name('storeEmployee');
Route::post('deleteEmployee', [EmployeeController::class, 'deleteEmployee'])->name('deleteEmployee');

Route::get('getAllMySubjects', [SubjectController::class, 'getAllMySubjects'])->name('getAllMySubjects');
Route::get('getAllSubjects', [SubjectController::class, 'getAllSubjects'])->name('getAllSubjects');
Route::post('CreteSubject', [SubjectController::class, 'CreteSubject'])->name('CreteSubject');
Route::post('deleteSubject', [SubjectController::class, 'deleteSubject'])->name('deleteSubject');
Route::get('/subjectEdit/{id}', [SubjectController::class, 'subjectEdit'])->name('subjectEdit');
Route::post('updateSubject/{id}', [SubjectController::class, 'updateSubject'])->name('updateSubject');
Route::get('/subjectShow/{id}', [SubjectController::class, 'subjectShow'])->name('subjectShow');


Route::post('subjectShow/CreteLecture', [LectureController::class, 'CreteLecture'])->name('CreteLecture');
Route::post('subjectShow/deleteLecture', [LectureController::class, 'deleteLecture'])->name('deleteLecture');
Route::post('updateLecture/{id}', [LectureController::class, 'updateLecture'])->name('updateLecture');
Route::get('/LectureEdit/{id}', [LectureController::class, 'LectureEdit'])->name('LectureEdit');
Route::get('/LectureFiles/{id}', [LectureController::class, 'LectureFiles'])->name('LectureFiles');
Route::get('/LectureHomeWorks/{id}', [LectureController::class, 'LectureHomeWorks'])->name('LectureHomeWorks');


Route::post('LectureFiles/Cretefile', [LectureFileController::class, 'Cretefile'])->name('Cretefile');
Route::get('LectureFileEdit/{id}', [LectureFileController::class, 'LectureFileEdit'])->name('LectureFileEdit');
Route::post('updateLectureFile/{id}', [LectureFileController::class, 'updateLectureFile'])->name('updateLectureFile');
Route::post('LectureFiles/deleteFile', [LectureFileController::class, 'deleteFile'])->name('deleteFile');

Route::post('LectureHomeWorks/CreteHomeWork', [HomeworkController::class, 'CreteHomeWork'])->name('CreteHomeWork');
Route::get('LectureHomeWorkEdit/{id}', [HomeworkController::class, 'LectureHomeWorkEdit'])->name('LectureHomeWorkEdit');
Route::post('updateLectureHomeWork/{id}', [HomeworkController::class, 'updateLectureHomeWork'])->name('updateLectureHomeWork');
Route::post('LectureHomeWorks/deleteHomeWork', [HomeworkController::class, 'deleteHomeWork'])->name('deleteHomeWork');
Route::post('LectureHomeWorks/UploadHomeWork', [HomeworkController::class, 'UploadHomeWork'])->name('UploadHomeWork');
Route::get('ShowTheHomeWorks/{id}', [HomeworkController::class, 'ShowTheHomeWorks'])->name('ShowTheHomeWorks');


Route::get('getAllStudents', [StudentController::class, 'getAllStudents'])->name('getAllStudents');
Route::post('updateStudent/{id}', [StudentController::class, 'updateStudent'])->name('updateStudent');
Route::post('CreteStudent', [StudentController::class, 'CreteStudent'])->name('CreteStudent');
Route::post('deleteStudent', [StudentController::class, 'deleteStudent'])->name('deleteStudent');
Route::get('/Student/{todo}/editByBob', [StudentController::class, 'editByBob'])->name('editByBob');

Route::get('/StudentEdit/{id}', [StudentController::class, 'StudentEdit'])->name('StudentEdit');
Route::get('/studentShow/{id}', [StudentController::class, 'studentShow'])->name('studentShow');



Route::get('getAllTeachers', [TeacherController::class, 'getAllTeachers'])->name('getAllTeachers');
Route::get('employees/{todo}/edit', [TeacherController::class, 'editTeachers'])->name('editTeachers');
Route::post('CreteTeacher', [TeacherController::class, 'CreteTeacher'])->name('CreteTeacher');
Route::post('deleteTeacher', [TeacherController::class, 'deleteTeacher'])->name('deleteTeacher');
Route::post('updateTeacher/{id}', [TeacherController::class, 'updateTeacher'])->name('updateTeacher');
Route::post('SaveTeacher', [TeacherController::class, 'SaveTeacher'])->name('SaveTeacher');


Route::get('/TeacherEdit/{id}', [TeacherController::class, 'TeacherEdit'])->name('TeacherEdit');
Route::get('/teacherShow/{id}', [TeacherController::class, 'teacherShow'])->name('teacherShow');

Route::get('getAllMyProjects', [ProjectController::class, 'getAllMyProjects'])->name('getAllMyProjects');
Route::get('getAllProjects', [ProjectController::class, 'getAllProjects'])->name('getAllProjects');
Route::post('CreteProject', [ProjectController::class, 'CreteProject'])->name('CreteProject');
Route::post('deleteProject', [ProjectController::class, 'deleteProject'])->name('deleteProject');
Route::post('deleteProject', [ProjectController::class, 'deleteProject'])->name('deleteProject');
Route::get('/projects/{todo}/editBybob', [ProjectController::class, 'editBybob'])->name('editBybob');
Route::post('updateProject/{id}', [ProjectController::class, 'updateProject'])->name('updateProject');
Route::get('/ProjectEdit/{id}', [ProjectController::class, 'ProjectEdit'])->name('ProjectEdit');
Route::get('/ProjectShow/{id}', [ProjectController::class, 'ProjectShow'])->name('ProjectShow');

// Route::get('/projects/{todo}/editBybob', 'LeadController@editLeads');

});

