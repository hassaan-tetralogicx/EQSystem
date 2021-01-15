@extends('layouts.dashboard')

@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block">
        <div class="row">
            <div class="col-xxl-8">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h5 class="text-body">Exams Taken</h5>
                            </div>
                            <div class="card-tools">
                                <a href="{{ route('exams.index') }}" class="btn btn-dim btn-primary">Show Exams</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            @if(count($exams_taken) > 0)
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>#</span></div>
                                    <div class="nk-tb-col"><span>Exam Title</span></div>
                                    <div class="nk-tb-col"><span>Employee name</span></div>
                                    <div class="nk-tb-col"><span>Attempted at</span></div>
                                    <div class="nk-tb-col text-right"><span>Action</span></div>
                                </div>
                                <?php $j = 1 ?>
                                @foreach ($exams_taken as $taken)
                                    <div class="nk-tb-item">
                                        @if ($taken->exam != null)
                                        <div class="nk-tb-col">
                                            <span class="text-body">{{ $j++ }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <strong><span class="text-body">{{ $taken->exam->title }}</span></strong>
                                        </div>

                                        <div class="nk-tb-col">
                                            <span class="text-body">{{ $taken->user->name }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="text-body">{{ date('m/d/Y | h:i', strtotime($taken->created_at)) }}</span>
                                        </div>
                                        <div class="nk-tb-col text-right">
                                            <div class="dropdown">
                                                <a class="text-primary dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        {{-- @if ()

                                                        @endif --}}
                                                        <li><a href="{{ route('result.view', ['exam_id' => $taken->exam->id, 'user_id' => $taken->user->id]) }}">View</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                            <div class="nk-tb-item bg-lighter p-2">
                                <div class="nk-tb-col">
                                    <span class="text-body">No exam is taken yet.</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .col -->
    </div>
</div>
@endsection

