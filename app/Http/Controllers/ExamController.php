<?php

namespace App\Http\Controllers;
use App\Mcq;
use App\Exam;
use App\User;
use App\Subject;
use App\Question;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Notifications\ExamNotification;
use Illuminate\Notifications\Notification;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::orderBy('created_at','desc')->paginate(10);
        return view('admindashboard.exams.index')->with('exams', $exams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('admindashboard.exams.create')->with('subjects', $subjects);
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
        $this->validate($request, [
            'title' => 'required',
            'select_subject' => 'required',
            'start_time' => 'required|date|after:yesterday',
            'end_time' => 'required|date|after:start_time',
            'question_title' => 'required'
        ]);
        $exam = new Exam();
        $exam->title = $request->title;
        $exam->subject_id = $request->select_subject;
        $exam->start_time = $request->start_time;
        $exam->end_time = $request->end_time;
        $exam->save();


        foreach($request->question_title as $index => $question_title) {
            // dd($request->all());
            if($question_title !== null) {
                $question = new Question();
                $question->title = $question_title;
                $question->exam_id = $exam->id;
                $question->save();

                $mcq1 = new Mcq();
                $mcq1->name = $request->option_1[$index];
                $mcq1->question_id = $question->id;
                $mcq1->save();

                $mcq2 = new Mcq();
                $mcq2->name = $request->option_2[$index];
                $mcq2->question_id = $question->id;
                $mcq2->save();

                $mcq3 = new Mcq();
                $mcq3->name = $request->option_3[$index];
                $mcq3->question_id = $question->id;
                $mcq3->save();

                $mcq4 = new Mcq();
                $mcq4->name = $request->option_4[$index];
                $mcq4->question_id = $question->id;
                $mcq4->save();
                // dd($request->input('answer_2'));
                if($request->input('answer_'.($index+1)) == "1") {
                    $question->correct_answer_id = $mcq1->id;
                    $question->save();
                }
                else if($request->input('answer_'.($index+1)) == "2") {
                    $question->correct_answer_id = $mcq2->id;
                    $question->save();
                }
                else if($request->input('answer_'.($index+1)) == "3") {
                    $question->correct_answer_id = $mcq3->id;
                    $question->save();
                }
                else if($request->input('answer_'.($index+1)) == "4") {
                    $question->correct_answer_id = $mcq4->id;
                    $question->save();
                }
            }
        }
        return redirect('/exams');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $users = User::role('employee')->get();

        return view('admindashboard.exams.view')->with([
            'exam' => $exam,
            'users' => $users,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        // dd($exam);
        $subjects = Subject::all();
        return view('admindashboard.exams.edit')->with(
            [
                'subjects' => $subjects,
                'exam' => $exam,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        // dd($exam);
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'select_subject' => 'required',
            'start_time' => 'required|date|after:yesterday',
            'end_time' => 'required|date|after:start_time',
            'question_title' => 'required'
        ]);
        $exam->title = $request->title;
        $exam->subject_id = $request->select_subject;
        $exam->start_time = $request->start_time;
        $exam->end_time = $request->end_time;
        $exam->save();

        foreach($request->question_id as $index => $question_id) {
            // dd($question_id);
            $question = Question::where('id', $question_id)->first();
            $question->title = $request->question_titles[$index];
            // dd($question->title);
            $question->exam_id = $exam->id;
            $question->save();
            // dd($question->save());
            $array_keys = array_keys($request->input('old_option_'.$question_id));
            // dd($array_keys);
            foreach($array_keys as $mcq) {
                $mcq1 = Mcq::where('id', $mcq)->first();
                $mcq1->question_id = $question_id;
                $var = $request->input('old_option_'.$question_id);
                // dd($var[$mcq]);
                $mcq1->name = $var[$mcq];
                $mcq1->save();

                $question->correct_answer_id = $request->input('answer_'.$question_id);
                // dd($question->correct_answer_id);
                $question->save();
            }
        }

        if($request->question_title) {
            foreach($request->question_title as $index => $question_title) {
                // dd($request->all());
                if($question_title !== null) {
                    $question = new Question();
                    $question->title = $question_title;
                    $question->exam_id = $exam->id;
                    $question->save();

                    $mcq1 = new Mcq();
                    $mcq1->name = $request->option_1[$index];
                    $mcq1->question_id = $question->id;
                    $mcq1->save();

                    $mcq2 = new Mcq();
                    $mcq2->name = $request->option_2[$index];
                    $mcq2->question_id = $question->id;
                    $mcq2->save();

                    $mcq3 = new Mcq();
                    $mcq3->name = $request->option_3[$index];
                    $mcq3->question_id = $question->id;
                    $mcq3->save();

                    $mcq4 = new Mcq();
                    $mcq4->name = $request->option_4[$index];
                    $mcq4->question_id = $question->id;
                    $mcq4->save();
                    // dd($request->input('answer_2'));
                    if($request->input('answer_'.($index+1)) == "1") {
                        $question->correct_answer_id = $mcq1->id;
                        $question->save();
                    }
                    else if($request->input('answer_'.($index+1)) == "2") {
                        $question->correct_answer_id = $mcq2->id;
                        $question->save();
                    }
                    else if($request->input('answer_'.($index+1)) == "3") {
                        $question->correct_answer_id = $mcq3->id;
                        $question->save();
                    }
                    else if($request->input('answer_'.($index+1)) == "4") {
                        $question->correct_answer_id = $mcq4->id;
                        $question->save();
                    }
                }
            }
        }

        return redirect('/exams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        foreach($exam->questions as $question)
        {
            $question->mcqs()->delete();
        }
        $exam->questions()->delete();
        $exam->delete();
        return redirect()->back();
    }
    public function invite(Request $request, $exam){

        $this->validate($request, [
            'select_users' => 'required',
        ]);
        $exam = Exam::find($exam);
        foreach($request->select_users as $select_user){
            $user = User::find($select_user);
            $user->notify(new ExamNotification($exam));
            $user->exams()->attach($exam);
        }
        return redirect()->back()->with('success', 'Invite sent!');
    }
}
