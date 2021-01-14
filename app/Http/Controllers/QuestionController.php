<?php

namespace App\Http\Controllers;

use App\Mcq;
use App\Exam;
use App\Mcq_result;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        //
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
        // dd($request->all());
    }
    public function save(Request $request, $exam)
    {
        // dd($request->all(), $exam);
        //     dd($request->all());
        $exam_detail = Exam::find($exam);
        // dd($exam_detail);
            if($request->question_title !== null) {
                $question = new Question();
                $question->title = $request->question_title;
                $question->exam_id = $exam;
                $question->question_marks = $request->question_marks;
                $exam_detail->total_exam_marks = $exam_detail->total_exam_marks + $request->question_marks;
                $exam_detail->save();
                $question->timer = $request->question_timer;
                $question->save();
                // dd($question->save());
                $mcq1 = new Mcq();
                $mcq1->name = $request->option_1;
                $mcq1->question_id = $question->id;
                $mcq1->save();

                $mcq2 = new Mcq();
                $mcq2->name = $request->option_2;
                $mcq2->question_id = $question->id;
                $mcq2->save();

                $mcq3 = new Mcq();
                $mcq3->name = $request->option_3;
                $mcq3->question_id = $question->id;
                $mcq3->save();

                $mcq4 = new Mcq();
                $mcq4->name = $request->option_4;
                $mcq4->question_id = $question->id;
                $mcq4->save();



                $answers = '';
                    // dd($request->input('answer'));
                // if($request->input('answer')) {
                $question_array = $request->input('answer');
                // dd($question_array);
                foreach($question_array as $quest){
                    $answers = $answers .$quest.',';
                }
                // dd($question);
                $question->correct_answer_id = $answers;
                $question->save();
            // }

                // else if($request->input('answer')) {
                //     $question_array = $request->input('answer');
                //     foreach($question_array as $question){
                //         $answers = $answers .$question.',';
                //     }
                //     $question->correct_answer_id = $answers;
                //     $question->save();
                // }
                // else if($request->input('answer')) {
                //     $question_array = $request->input('answer');
                //     foreach($question_array as $question){
                //         $answers = $answers .$question.',';
                //     }
                //     $question->correct_answer_id = $answers;
                //     $question->save();
                // }
                // else if($request->input('answer')) {
                //     $question_array = $request->input('answer');
                //     foreach($question_array as $question){
                //         $answers = $answers .$question.',';
                //     }
                //     $question->correct_answer_id = $answers;
                //     $question->save();
                // }
            }
            return redirect()->back();
        // dd($request->all(), $exam);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $exam = Exam::find($question->exam_id);
        // dd($exam);
        if($request->question_id) {

            $question = Question::where('id', $question->id)->first();
            $question->title = $request->question_title;
            $question->timer = $request->question_timer;
            $question->question_marks = $request->question_marks;
            $exam->total_exam_marks = $exam->total_exam_marks + $request->question_marks;
            $exam->save();
            // $exam_detail->total_exam_marks = $exam_detail->total_exam_marks + $request->question_marks;
            // $exam_detail->save();
            $question->exam_id = $question->exam_id;
            $question->save();
            // dd($question->save());
            $array_keys = array_keys($request->input('old_option_'.$question->id));

            foreach($array_keys as $mcq) {
                $mcq1 = Mcq::where('id', $mcq)->first();
                $mcq1->question_id = $question->id;
                $var = $request->input('old_option_'.$question->id);
                // dd($var[$mcq]);
                $mcq1->name = $var[$mcq];
                $mcq1->save();
            }
                $answers = '';

            // if($request->input('answer')) {
                // dd($request->input('answer'));
                $question_update_array = $request->input('answer_'.$question->id);
                // $question_array = $request->input('answer');
                foreach($question_update_array as $question_update){
                    $answers = $answers .$question_update.',';
                }

                $question->correct_answer_id = $answers;
                $question->save();
            // }

            // $question->correct_answer_id = json_encode($question_update_array);
            // dd($question->correct_answer_id);
            // $question->save();

        return redirect()->back();
        }
    }

    public function update_time(Request $request, $exam_id, $question_id){
        // dd($request->all(), $exam_id, $question_id);
        $update_timer = Mcq_result::where('exam_id', $exam_id)->where('question_id', $question_id)->where('user_id', auth()->user()->id)->first();
        $update_timer->question_timer = $request->update_timer;
        $update_timer->save();
        return $update_timer->question_timer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $exam = Exam::find($question->exam_id);
        // dd($exam);

        // $question->mcqs->delete();
        foreach($question->mcqs as $mcq){
            $mcq->delete();
        }
        $exam->total_exam_marks = $exam->total_exam_marks - $question->question_marks;
        $exam->save();
        $question->delete();

        return redirect()->back();
    }
}
