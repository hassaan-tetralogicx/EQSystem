@extends('layouts.dashboard')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@role('admin')
    {{-- {{ __('Welcome, You are logged in as Admin!') }} --}}
<div class="nk-block">
    <div class="row g-gs">
        <div class="col-md-3">
            <div class="card card-bordered">
                <a href="{{ route('admin.subject') }}">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-0">
                        <div class="card-title">
                            <h6 class="title">Total Subjects</h6>
                        </div>
                    </div>
                    <h4 class="text-primary mt-2"> {{ $subjects->count() }}</h4>
                </div>
            </a>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-3">
            <div class="card card-bordered">
                <a href="{{ route('admin.show') }}">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-0">
                        <div class="card-title">
                            <h6 class="title">Total Employees</h6>
                        </div>
                    </div>
                    <h4 class="text-primary mt-2"> {{ $users->count() }}</h4>
                </div>
            </a>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-3">
            <div class="card card-bordered">
                <a href="{{ route('exams.exams-taken') }}">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-0">
                        <div class="card-title">
                            <h6 class="title">Exams Taken</h6>
                        </div>
                    </div>
                    <h4 class="text-primary mt-2"> {{ $result->count() }}</h4>
                </div>
            </a>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-3">
            <div class="card card-bordered">
                <a href="{{ route('exams.index') }}">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-0">
                        <div class="card-title">
                            <h6 class="title">Total Exams</h6>
                        </div>
                    </div>
                    <h4 class="text-primary mt-2"> {{ $exams->count() }}</h4>
                </div>
            </a>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-1">
                        <div class="card-title">
                            <h6 class="title"><em class="icon ni ni-user"></em> <span>New Registered Employees</span></h6>
                            <p>Recently registered employees.</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{-- @if (count($new_users) > 0) --}}
                        <div class="card-inner p-0 border-top">
                            <div class="nk-tb-list nk-tb-orders">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>#</span></div>
                                    <div class="nk-tb-col"><span>Name</span></div>
                                    <div class="nk-tb-col"><span>Registered Time</span></div>
                                    <div class="nk-tb-col text-right"><span>Email</span></div>
                                </div>
                                <?php $i = 1 ?>
                                @foreach($new_users as $new_user)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="text-body">{{ $i++ }}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                    <strong><span class="text-body">{{ $new_user->name }}</span></strong>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="text-body">{{ date('m/d/Y | h:i', strtotime($new_user->created_at)) }}</span>
                                    </div>
                                    <div class="nk-tb-col text-right">
                                        <span class="text-body">{{ $new_user->email }}</span>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        {{-- @else
                        <div class="nk-tb-item bg-lighter p-2">
                            <div class="nk-tb-col">
                                <span class="text-body ">No employee is registered recently.</span>
                            </div>
                        </div>
                        @endif --}}

                    </div>
                </div>
            </div>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner d-flex flex-column h-100">
                    <div class="card-title-group mb-3">
                        <div class="card-title">
                            <h6 class="title"><em class="icon ni ni-pen"></em> <span>New Exams Taken</span></h6>
                            <p>Recently taken exams.</p>
                        </div>
                    </div>
                    <div>
                        <div class="card-inner p-0 border-top">
                            <div class="nk-tb-list nk-tb-orders">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>#</span></div>
                                    <div class="nk-tb-col"><span>Exam Title</span></div>
                                    <div class="nk-tb-col"><span>Employee name</span></div>
                                    <div class="nk-tb-col"><span>Attempted at</span></div>
                                    <div class="nk-tb-col text-right"><span>Action</span></div>
                                </div>
                                <?php $j = 1 ?>
                                @foreach ($new_results as $new_result)
                                <div class="nk-tb-item">
                                    @if ($new_result->exam != null)
                                    <div class="nk-tb-col">
                                        <span class="text-body">{{ $j++ }}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <strong><span class="text-body">{{ $new_result->exam->title }}</span></strong>
                                    </div>
                                    {{-- <div class="nk-tb-col">
                                        <span class="text-body">{{ $new_result->exam->title }}</span>
                                    </div> --}}
                                    <div class="nk-tb-col">
                                        <span class="text-body">{{ $new_result->user->name }}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="text-body">{{ date('m/d/Y | h:i', strtotime($new_result->created_at)) }}</span>
                                    </div>
                                    <div class="nk-tb-col text-right">
                                        <div class="dropdown">
                                            <a class="text-primary dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    {{-- @if ()

                                                    @endif --}}
                                                    <li><a href="{{ route('result.view', ['exam_id' => $new_result->exam->id, 'user_id' => $new_result->user->id]) }}">View</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .col -->
    </div>
</div>

@endrole
@endsection
