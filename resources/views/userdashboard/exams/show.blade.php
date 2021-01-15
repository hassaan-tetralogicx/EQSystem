@extends('layouts.dashboard')

@section('content')

<div class="nk-block">
    <div class="card card-bordered">
        <div class="card-aside-wrap card-full">
            <div class="card-content">
                <div class="card-inner">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <h5 class="title">Your Assigned Exam!</h5>
                            <p>You're assigned this exam by admin, click start button to start exam.</p>
                        </div><!-- .nk-block-head -->
                        <div class=" row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Exam Title</span>
                                            <span class="profile-ud-value">{{ $exam->title }}</span>
                                        </div>
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Start Time</span>
                                            <span class="profile-ud-value">{{ date('m/d/Y | h:i a', strtotime($exam->start_time)) }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Subject</span>
                                            <span class="profile-ud-value">{{ $exam->subject->title }}</span>
                                        </div>
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">End Time</span>
                                            <span class="profile-ud-value">{{ date('m/d/Y | h:i a', strtotime($exam->end_time)) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @role('employee')
                                    <a href="{{ route('employees.exam', $exam->id) }}" class="btn btn-outline-primary mt-2">Start Exam</a>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

