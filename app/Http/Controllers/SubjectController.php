<?php

namespace App\Http\Controllers;

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
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|max:20|unique:subjects',

        ]);

        $subjects = new Subject();
        $subjects->title = $request->title;
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
        $subjects->save();

        return redirect()->back();
    }
    public function destroy($id){

        $subjects = Subject::where('id', $id)->first();
        $subjects->delete();

        return redirect()->back();
    }


}
