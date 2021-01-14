@extends('layouts.dashboard')

@section('content')

<div class="nk-block">
    <div class="row">
        <div class="col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body">Employee / <strong class="text-primary small">{{ $user->name }}</strong> / Subject / <strong class="text-primary small">{{ $exam->title }}</strong> / Result</h5>
                        </div>
                        <div class="card-tools">
                            <a href="{{ url()->previous() }}" class="btn btn-dim btn-primary d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-inner border-top">
                    <div class="nk-tb-list nk-tb-orders mt-3">
                        <div class="nk-tb-item nk-tb-head">
                            {{-- <div class="nk-tb-col"><span>Name</span></div> --}}
                            <div class="nk-tb-col"><span>Total Questions</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Grade</span></div>
                            {{-- {{-- <div class="nk-tb-col tb-col-md"><span>Start Date</span></div> --}}
                            <div class="nk-tb-col tb-col-md text-center"><span>Correct Answers</span></div>
                            <div class="nk-tb-col text-right"><span>Wrong Answers</span></div>
                            {{-- <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div> --}}
                            {{-- <div class="nk-tb-col text-right"><span>Action</span></div> --}}
                        </div>
                        {{-- <?php $i=1 ?> --}}

                        @foreach ($result as $show)
                        <div class="nk-tb-item text-body">
                            {{-- <div class="nk-tb-col">
                                <strong><span ></span></strong>
                            </div> --}}
                            <div class="nk-tb-col">
                                <strong><span>{{ $show->correct_answer + $show->wrong_answer }}</span></strong>
                            </div>
                            <div class="nk-tb-col tb-col-md ">
                                <span>{{ $show->grade }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md text-center">
                                <span>{{ $show->correct_answer }}</span>
                            </div>
                            <div class="nk-tb-col tb-col text-right">
                                <span>{{ $show->wrong_answer }}</span>
                            </div>

                            {{-- <div class="nk-tb-col text-right">
                                <div class="dropdown">
                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li><a href="{{ route('exams.show', $exam->id) }}">View</a></li>
                                            <li><a href="{{ route('exams.edit', $exam->id) }}">Edit</a></li>
                                            <li><a href="{{ route('exams.destroy', $exam->id) }}" data-toggle="modal" data-target="#deletemodal_{{ $exam->id }}">Delete</a></li>
                                        </ul>
                                    </div>
                                    <div class="modal fade" tabindex="-1" id="deletemodal_{{ $exam->id }}">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are you sure?</h5>
                                                </div>
                                                <form action="{{ route('exams.destroy', $exam->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf

                                                    <div class="modal-body">
                                                        <p class="text-left"> You're about to delete your record</p>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-dim btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-dim btn-danger btn-sm">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        @endforeach
                    </div>


                </div>
            </div><!-- .card -->
        </div>
    </div>
</div>


@endsection
