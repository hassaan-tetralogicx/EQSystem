<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Mcq_result;
use App\User;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        $exams = $user->exams;
        // dd($exams);
        // dd($user);
        return view('userdashboard.exams.index')->with('exams', $exams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);
        return view('userdashboard.exams.show')->with('exam', $exam);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function check(Request $request, $exam_id, $question_id){

        $exam = Exam::find($exam_id);
        $record = Mcq_result::where('exam_id', $exam_id)->where('question_id', $question_id)->whereNull('answer')->whereNull('check')->first();

        if($record != null){
            $record->answer = $request->answer;
            $record->check = true;
            $record->save();
            // return redirect()->route('employees.exam', $exam->id);
        }
        return redirect()->route('employees.exam', $exam->id);
    }

    public function exam(Request $request, $id){
        // dd($request->all());
        $exam = Exam::find($id);
        // dd($exam);
        $record = Mcq_result::where('exam_id', $exam->id)
        ->pluck('question_id')->toArray();

        $question = $exam->questions()->whereNotIn('id', $record)->first();
        if($question == null ){
            $admin_answer = $exam->questions;
            $user_answer = Mcq_result::where('exam_id', $exam->id)->get();
            dd($admin_answer, $user_answer);

            return view('userdashboard.exams.completed')->with([
                'admin_answer' => $admin_answer, 'user_answer' => $user_answer
                ]);
        }
        else {
        $mcq_result = new Mcq_result();
        $mcq_result->exam_id = $exam->id;
        $mcq_result->user_id = Auth::user()->id;
        $mcq_result->question_id = $question->id;
        $mcq_result->save();

        return view('userdashboard.exams.exam')->with([
            'exam' => $exam,
            'question' => $question
            ]);
        }
    }

    public function view($id){
        $exam = Exam::find($id);
        $question = $exam->questions()->first();
        return view('userdashboard.exams.exam')->with([
            'exam' => $exam,
            'question' => $question
            ]);
    }
}
