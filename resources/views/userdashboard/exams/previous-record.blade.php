@extends('layouts.dashboard')

@section('content')
<div class="nk-block">
    <div class="row">
        <div class="col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body">Attempted Exams Record:</h5>
                        </div>
                        <div class="card-tools">
                            <a href="/employees" class="btn btn-dim btn-primary ml-2">Unattempted Exams</a>
                        </div>
                    </div>
                </div>
                <?php $user = auth()->user(); $i = 1; ?>
                {{-- // dd($c) --}}
                    <div class="card-inner p-0 border-top">
                    @if (count($user->exams()->where('user_id', $user->id)->where('exam_status', 'completed')->get()) > 0)
                        <div class="nk-tb-list nk-tb-orders">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>#</span></div>
                                <div class="nk-tb-col tb-col-lg"><span>Exam Title</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Subject</span></div>
                                {{-- <div class="nk-tb-col tb-col-lg"><span>End Date</span></div> --}}
                                {{-- <div class="nk-tb-col"><span>Amount</span></div> --}}
                                {{-- <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div> --}}
                                <div class="nk-tb-col text-right"><span>Action</span></div>
                            </div>
                            @foreach ($status as $completed_exam)
                            {{-- <?php dd($completed_exam->id); ?> --}}
                                <div class="nk-tb-item text-body">
                                    <div class="nk-tb-col">
                                        <span>{{ $i++ }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                        <strong><span>{{ $completed_exam->title }}</span></strong>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span>{{ $completed_exam->subject->title }}</span>
                                    </div>

                                    <div class="nk-tb-col text-right">
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li><a href="{{ route('employees.previous-exam-record', $completed_exam->id) }}">View</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- @endforeach --}}
                        </div>
                    @else
                        <p>no record exists</p>
                    @endif
                    </div>


                {{-- @else
                <div class="nk-tb-item bg-lighter p-2">
                    <div class="nk-tb-col">
                        <span class="text-body ">No exam is created currently.</span>
                    </div>
                </div>
                @endif --}}
            </div><!-- .card -->
        </div>
    </div>
</div>

@endsection
