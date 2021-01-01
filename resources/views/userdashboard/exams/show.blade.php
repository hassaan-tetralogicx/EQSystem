@extends('layouts.dashboard')

@section('content')
<div class="col-xl-12 col-xxl-8 mt-5">
    <div class="card card-bordered card-full">
        <div class="card-inner border-bottom">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title text-center">Your Assigned Exam!</h6>
                </div>
            </div>
        </div>
        {{-- <div class="jumbotron text-center">
            <h2>Welcome to your Exam!</h2>
        </div> --}}
        <div class="nk-tb-item nk-tb-head p-4">
            <div class="row">
                <div class="col-md-3">
                    <h6 class="">Exam Title:</h6>
                    <h6 class="">Subject:</h6>
                    <h6 class="">Start Date & Time:</h6>
                    <h6 class="">End Date & Time:</h6>
                </div>
                <div class="col-md-9">
                    <h6 class="">{{ $exam->title }}</h6>
                    <h6 class="">{{ $exam->subject->title }}</h6>
                    <h6 class="">{{ $exam->start_time }}</h6>
                    <h6 class="">{{ $exam->end_time }}</h6>
                </div>
            </div>
            <hr>
            <?php $date = Carbon\Carbon::parse($exam->start_time) ?>
            {{-- {{ Carbon\Carbon::now()->setTimezone('Asia/Karachi') }} | {{ $exam->start_time }} --}}
            @role('employee')
                @if ($date->isPast())
                    <a href="{{ route('employees.exam', $exam->id) }}" class="btn btn-primary">Start Exam</a>
                @else
                    <p><strong>Note: </strong> You'll be able to start exam at your given time.</p>
                @endif
            @endrole

        </div>

    </div><!-- .card -->
</div>


@endsection
