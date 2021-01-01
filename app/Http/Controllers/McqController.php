<?php

namespace App\Http\Controllers;

use App\Mcq;
use Illuminate\Http\Request;

class McqController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mcq  $mcq
     * @return \Illuminate\Http\Response
     */
    public function show(Mcq $mcq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mcq  $mcq
     * @return \Illuminate\Http\Response
     */
    public function edit(Mcq $mcq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mcq  $mcq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mcq $mcq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mcq  $mcq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mcq $mcq)
    {
        //
    }
}
