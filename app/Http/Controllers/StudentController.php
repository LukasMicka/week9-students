<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Detention;

class StudentController extends Controller
{
    //
    public function show($student_slug)
    {
        $student = Student::where('slug', $student_slug)->first();

        if (!$student) {
            abort(404, 'Student not found');
        }

        $view = view('student/show');
        $view->student = $student;
        return redirect(action('StudentController@show', $student->name));
    }

    public function index()
    {
        $students = Student::orderBy('name', 'asc')->get();
        dd($students);
        return view('student/index', 'students');
    }

    public function store(Request $request)
    {
        $detention = new Detention();
        $detention->text = $request->text;
        $detention->description = $request->description;

        $detention->save();

        return redirect(action('StudentController@index'));
    }
}
