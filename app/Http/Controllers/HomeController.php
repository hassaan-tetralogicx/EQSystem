<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use App\Result;
use App\Subject;
use App\Mcq_result;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subjects = Subject::all();
        $result = Result::all();
        $exams = Exam::all();
        $users = User::Role('employee')->get();
        $new_users = User::orderBy('id', 'desc')->role('employee')->take(5)->get();
        $new_results = Result::orderBy('exam_id', 'desc')->take(5)->get();

        // dd($new_results);
        return view('home')->with([
            'subjects' => $subjects,
            'result' => $result,
            'exams' => $exams,
            'users' => $users,
            'new_users' => $new_users,
            'new_results' => $new_results
        ]);
    }
}
