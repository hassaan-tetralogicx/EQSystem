@extends('layouts.dashboard')

@section('content')

<div class="nk-block ">
    <div class="row">
        <div class="col-xxl-8 ">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body "><strong class="text-primary ">{{ auth()->user()->name }}</strong> / Exam / <strong class="text-primary ">{{ $exam->title }}</strong> / Result</h5>
                        </div>
                        <div class="card-tools">
                            <a href="{{ url()->previous() }}" class="btn btn-dim btn-primary d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-inner border-top">
                    <div class=" row">
                        <div class="col-md-12">
                            <div class="row ">
                                <div class="col-md-5  ">
                                    <div class="profile-ud wider " >
                                        <span class="profile-ud-label" style="width: 300px">Total Questions</span>
                                        <span class="profile-ud-value">{{ $exam_result->correct_answer + $exam_result->wrong_answer }}</span>
                                    </div>
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Total Exam Marks</span>
                                        <span class="profile-ud-value">{{ $exam_title-> }}</span>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5 ">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label " style="width: 300px">Grade</span>
                                        <span class="profile-ud-value">{{ $exam_result->grade }}</span>
                                    </div>
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label" style="width: 300px">Obtained Exam Marks</span>
                                        <span class="profile-ud-value">{{ $exam_result->obtained_exam_marks }}</span>
                                    </div>
                                </div>
                            </div>
                            {{-- <hr>
                            @role('employee')
                                <a href="{{ route('employees.exam', $exam->id) }}" class="btn btn-outline-primary mt-2">Start Exam</a>
                            @endrole --}}
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div>
    </div>
</div>


@endsection
