@extends('layouts.dashboard')

@section('content')

<div class="nk-block">
    <div class="row">
        <div class="col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body">Subject / <strong class="text-primary small">{{ $subject->title }}</strong></h5>
                        </div>
                        <div class="card-tools">
                            <a href="/subjects" class="btn btn-dim btn-primary d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                        </div>
                    </div>
                </div>
                @if (count($exams) > 0)
                <div class="card-inner p-0 border-top">
                    <div class="nk-tb-list nk-tb-orders">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Exam Title</span></div>
                            {{-- <div class="nk-tb-col tb-col-lg"><span>Customer</span></div> --}}
                            <div class="nk-tb-col tb-col-md"><span>Subject Description</span></div>
                            {{-- <div class="nk-tb-col tb-col-lg"><span>Ref</span></div> --}}
                            {{-- <div class="nk-tb-col"><span>Amount</span></div> --}}
                            {{-- <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div> --}}
                            <div class="nk-tb-col text-right"><span>Action</span></div>
                        </div>
                        @foreach ($exams as $exam)

                        <div class="nk-tb-item text-body">
                            <div class="nk-tb-col">
                                <strong><span >{{ $exam->title }} </span></strong>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span >{{ $subject->description }}</span>
                            </div>
                            {{-- <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">02/11/2020</span>
                            </div> --}}
                            <div class="nk-tb-col text-right">
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
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                    <div class="nk-tb-item bg-lighter p-2">
                        <div class="nk-tb-col">
                            <span class="text-body">No Exams are created against this particular subject.</span>
                        </div>
                    </div>
                @endif
            </div><!-- .card -->
        </div>
    </div>
</div>

@endsection
