<?php

namespace App\Http\Controllers;

use App\Result;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $subjects = Subject::all();
        return view('admindashboard.subject')->with('subjects', $subjects);
    }
    public function show($id) {
        $subject = Subject::find($id);
        $exams = $subject->exams()->get();
        // dd($exams);
        return view('admindashboard.view-subject')->with([
            'subject' => $subject,
            'exams' => $exams
            ]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|max:20|unique:subjects',
            'description' => 'required',
        ]);

        $subjects = new Subject();
        $subjects->title = $request->title;
        $subjects->description = $request->description;
        $subjects->save();

        return redirect()->back();

    }
    public function update($id, Request $request){
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|string|max:20',
        ]);

        $subjects = Subject::where('id', $id)->first();
        $subjects->title = $request->title;
        $subjects->description = $request->description;
        $subjects->save();

        return redirect()->back();
    }
    public function destroy($id){

        $subject = Subject::find($id);
        $subject->delete();

        return redirect()->back();
    }


}
