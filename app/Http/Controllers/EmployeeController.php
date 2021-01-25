<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Mcq_result;
use App\User;
use App\Result;
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
        // dd($user);
        $exam_status = $user->exams()->get();
        dd($exam_status);
        // dd($exam_status);
        return view('userdashboard.exams.index')->with('exams', $exam_status);
    }
    public function previous_record()
    {
        $user = Auth::user();
        $exam_status = $user->exams()->where('exam_status', 'completed')->get();
        // dd($exam_status);
        return view('userdashboard.exams.previous-record')->with('status', $exam_status);
    }
    public function previous_exam_result($exam)
    {
        // dd($exam);
        $user = Auth::user();
        $exam_result = Result::where('user_id', $user->id)->where('exam_id', $exam)->first();
        $exam_detail = Exam::find($exam_result->exam_id);

        return view('userdashboard.exams.previous-exam-result')->with(['exam_result' => $exam_result, 'exam' => $exam_detail] );
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
        if($exam != null){
            $question = Question::where('exam_id', $exam->id)->first();
            return view('userdashboard.exams.show')->with(['exam' => $exam, 'question' => $question]);
        }

        // else {
        //     return view('userdashboard.exams.previous-record');
        // }
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
        // dump($request->answer);
        // dd($request->all(), $exam_id, $question_id);
        $exam = Exam::find($exam_id);
        $question = Question::find($question_id);

        if($request->answer != null){
            $size = sizeof($request->answer);
            if($size > 2){
                return redirect()->back()->with('error', 'Cannot select more than two options!');
            }
            $record = Mcq_result::where('exam_id', $exam_id)->where('question_id', $question_id)->whereNull('check')->first();
            if($record != null){
                $answers = null;
                $record->question_timer = 0;
                $user_answers = $request->answer;
                    if($user_answers != null ){
                        foreach($user_answers as $ans){
                            $answers = $answers .$ans.',';
                        }
                        $correct_admin_answers = Question::where('id', $question_id)->where('exam_id', $exam_id)->pluck('correct_answer_id')->toArray();
                        $correct_employee_answers = explode(',', $answers); // employee answers string explode
                        $correct_admin_answer_array = implode(',', $correct_admin_answers); // admin answers array implode to string
                        $correct_admin_answers = explode(',', $correct_admin_answer_array); // admin answers string explode

                        $check = array_intersect($correct_employee_answers, $correct_admin_answers);

                        $total_correct_admin_answers = count($correct_admin_answers) - 1 ;
                        $total_question_marks = $question->question_marks;
                        $total_employee_correct = count($check) - 1; //space minus
                            if($total_employee_correct != 0){
                                $obtained_question_marks = $total_question_marks / $total_correct_admin_answers * $total_employee_correct;
                                $record->obtained_question_marks = $obtained_question_marks;
                            }
                    else {
                        $record->obtained_question_marks = 0;
                    }
                    }

                $record->answer = $answers;
                $record->check = true;
                $record->save();
            // return redirect()->route('employees.exam', $exam->id);
            }
        return redirect()->route('employees.exam', $exam->id);
        // dd();
        }
        else {
            $record = Mcq_result::where('exam_id', $exam_id)->where('question_id', $question_id)->whereNull('check')->first();
            if($record != null){
                $answers = null;
                $record->question_timer = 0;
                $user_answers = $request->answer;
                    if($user_answers != null ){
                        foreach($user_answers as $ans){
                            $answers = $answers .$ans.',';
                        }
                    }
                    // dd($answers);
                $record->answer = $answers;
                $record->check = true;
                $record->save();
            // return redirect()->route('employees.exam', $exam->id);
            }
        return redirect()->route('employees.exam', $exam->id);
        }

    }

    public function exam(Request $request, $id){

        // dd($id);
        $exam = Exam::find($id);
        $record = Mcq_result::where('exam_id', $exam->id)->where('user_id', auth()->user()->id)->where('question_timer', 0)->where('check',true)
        ->pluck('question_id')->toArray();
        $question = $exam->questions()->whereNotIn('id', $record)->first();
        // dd($question);
        if($question == null ){
            $admin_answer = $exam->questions->pluck('correct_answer_id')->toArray();
            $user_answer = Mcq_result::where('exam_id', $exam->id)->where('user_id', auth()->user()->id)->pluck('answer')->toArray();

            $correct = 0;
            $incorrect = 0;
            $total = count($exam->questions);

            foreach($admin_answer as $index => $a_anwer) {
                $admin_ans_array = explode(',', $a_anwer); // first admin question
                $user_ans_array = explode(',', $user_answer[$index]); // first user answer


                foreach($user_ans_array as $i => $item) {
                    if($item != '') {
                        if(in_array($item, $admin_ans_array)) {
                            $correct++;
                            break;
                        }
                        // else {
                        //     $incorrect++;
                        //     break;
                        // }
                    }
                    else {
                        $incorrect++;
                        // break;
                    }
                }
            }

            $obtained_exam_marks = Mcq_result::where('exam_id', $exam->id)->where('user_id', auth()->user()->id)->pluck('obtained_question_marks')->toArray();
            $obtained_exam_marks = array_sum($obtained_exam_marks);
            $total_exam_marks = Exam::where('id', $exam->id)->pluck('total_exam_marks')->first();

            $percentage = ($obtained_exam_marks  / $total_exam_marks) * 100;
            // dd($percentage);
            if ($percentage < 40.0) {
                $grade = 'F';
            } elseif ($percentage >= 40.0 && $percentage < 60.0) {
                $grade = 'D';
            } elseif ($percentage >= 60.0 && $percentage < 70.0) {
                $grade = 'C';
            } elseif ($percentage >= 70.0 && $percentage < 80.0) {
                $grade = 'B';
            } elseif ($percentage >= 90.0 && $percentage <= 100.0) {
                $grade = 'A';
            }
            // dd($total_exam_marks);
            if(!Result::where('user_id', auth()->user()->id)->where('exam_id', $exam->id)->exists()){
                $result = new Result;
                $result->user_id = auth()->user()->id;
                $result->exam_id = $exam->id;
                $result->obtained_exam_marks = $obtained_exam_marks;
                $result->correct_answer = $correct;
                $result->wrong_answer = $incorrect;
                $result->grade = $grade;
                $result->save();
                $user = Auth::user();
                // dump($user);
                $check = $user->exams()->updateExistingPivot($exam->id, ['exam_status' => 'completed']);
                // $check-save();
                // dd($check);
            }
            $existing_result = Result::where('user_id', auth()->user()->id)->where('exam_id', $exam->id);
            if($existing_result->exists()){
                $result = $existing_result->first();
                $result->user_id = auth()->user()->id;
                $result->exam_id = $exam->id;
                $result->obtained_exam_marks = $obtained_exam_marks;
                $result->correct_answer = $correct;
                $result->wrong_answer = $incorrect;
                $result->grade = $grade;
                $result->save();


            }


            // $user->exams()->attach($exam);

            $result = Result::where('exam_id', $exam->id)->where('user_id', auth()->user()->id)->first();
            return view('userdashboard.exams.completed')->with('result', $result);
            // $i = 0;
            // $correct = 0;
            // $incorrect = 0;
            // $total = count($admin_answer);
            // // dd(count($admin_answer));

            // for($i=0; $i<count($admin_answer); $i++){
            //     if($admin_answer[$i] == $user_answer[$i]){
            //         $correct++;
            //     }
            //     else{
            //         $incorrect++;
            //     }
        }
        else {
            $mcqs_prev = Mcq_result::where([
                'exam_id'=>$exam->id,
                'user_id' => Auth::user()->id,
                'question_id' => $question->id
            ])->first();
            // dd($mcqs_prev);
            if($mcqs_prev==null)
            {
                $mcqs_prev = new Mcq_result();
                $mcqs_prev->exam_id = $exam->id;
                $mcqs_prev->user_id = Auth::user()->id;
                $mcqs_prev->question_id = $question->id;
                $mcqs_prev->question_timer = $question->timer;
                $mcqs_prev->save();
            }

        return view('userdashboard.exams.exam')->with([
            'exam' => $exam,
            'question' => $question,
            'mcq'=>$mcqs_prev
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
