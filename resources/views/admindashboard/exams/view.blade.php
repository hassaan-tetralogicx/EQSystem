@extends('layouts.dashboard')

@section('content')

<div class="nk-block">
    <div class="row">
        <div class="col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body">Exam / <strong class="text-primary small">{{ $exam->title }}</strong></h5>
                        </div>
                        <div class="card-tools">
                            <a href="/exams" class="btn btn-dim btn-primary d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                        </div>
                    </div>
                </div>

                <div class="card-inner border-top">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs ">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#exam_details">Exam Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#exam_questions">Exam Questions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#invite_employees">Invite Employees</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#exam_taken">Exam Taken</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- <div class="d-flex justify-content-center mt-5">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div> --}}
                    <div>
                        <div class="tab-content">
                            <div class="tab-pane active mt-5" id="exam_details">
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane mt-5" id="exam_questions">
                                <div class=" border border-light p-2">
                                    <h6 class="d-inline-block mt-2">Total Questions -
                                        ({{ $exam->questions()->count() }})
                                    </h6>
                                    <button type="button" class="btn btn-success d-inline-block float-right mb-1" data-target="#add_question_{{ $exam->id }}" data-toggle="modal">Add New Question</button>
                                </div>
                                <div class="modal fade" tabindex="-1" role="dialog" id="add_question_{{ $exam->id }}">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                            <form action="{{ route('question.save', $exam->id) }}" method="POST">
                                                @csrf
                                            <div class="modal-body modal-body-md">
                                                <h4 class="title">Add Question</h4>
                                                <ul class="nk-nav nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#question">Add Question Title</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#mcqs">Add MCQs</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#timer">Add Timer</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#question_marks">Add Marks</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="question">
                                                        <h6>Add Title</h6>
                                                        <input type="text" name="question_title" class="form-control border border-gray add-row" placeholder="enter your question" id="" required>
                                                    </div>
                                                    <div class="tab-pane " id="timer">
                                                        <h6>Add Timer (seconds)</h6>
                                                        <input type="number" min=0 name="question_timer" class="form-control border border-light " placeholder="Add seconds only" required>
                                                    </div>
                                                    <div class="tab-pane" id="mcqs">
                                                        <h6 class="title mb-2">Add Options</h6>
                                                        {{-- <br> --}}
                                                        <div class="row mt-4">
                                                            <div class="col-md-6">
                                                                <input type="text" name="option_1" class=" form-control-sm border border-light" placeholder="option 1" required>
                                                                <input type="checkbox" class="check" name="answer[]" value="" >
                                                                <small>Correct answer</small>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="option_2" class=" form-control-sm border border-light" placeholder="option 2" required>
                                                                <input type="checkbox" name="answer[]" class="check" value="" >
                                                                <small>Correct answer</small>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="option_3" class=" form-control-sm border border-light" placeholder="option 3"required>
                                                                <input type="checkbox" name="answer[]" class="check" value="" >
                                                                <small>Correct answer</small>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="option_4" class=" form-control-sm border border-light" placeholder="option 4" required>
                                                                <input type="checkbox" name="answer[]" class="check" value="" >
                                                                <small>Correct answer</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="question_marks">
                                                        <h6>Add Marks</h6>
                                                        <input type="number" min=0 name="question_marks" class="form-control border border-light " placeholder="Marks for question" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-dim btn-primary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-dim btn-success">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-list nk-tb-orders mt-3">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>#</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span>Question Title</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span>Options</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Question Marks</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Question Time</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Correct</span></div>
                                        <div class="nk-tb-col text-right"><span>Action</span></div>
                                    </div>
                                    <?php $k=1 ?>
                                    <?php $i=1 ?>
                                    @foreach ($exam->questions as $question)
                                    <div class="nk-tb-item text-body">
                                        <div class="nk-tb-col">
                                            <span>{{ $i++ }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <strong><span>{{ $question->title }}</span></strong>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            @foreach ($question->mcqs as $mcq)
                                                <span class="mr-2" style="display: inline">{{ $mcq->name }}</span>
                                            @endforeach
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $question->question_marks }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $question->timer }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            {{-- @foreach ($question->mcqs as $mcq)
                                            @endforeach --}}
                                            <?php $show_correct_answer = explode(',', $question->correct_answer_id); ?>

                                            @foreach ($show_correct_answer as $correct_answer)
                                                @if($correct_answer != '')
                                                    <span class="badge badge-pill p-1 badge-success" style="display: inline">{{ $correct_answer }}</span>
                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="nk-tb-col text-right">
                                            <div class="dropdown">
                                                <a class="text-primary dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li><a href="" data-target="#view_question_{{ $question->id }}" data-toggle="modal">View</a></li>
                                                        <li><a href="" data-target="#edit_question_{{ $question->id }}" data-toggle="modal">Edit</a></li>
                                                        <li><a href="" data-target="#delete_question_{{ $question->id }}" data-toggle="modal">Delete</a></li>
                                                        {{-- <li><a href="">Edit</a></li>
                                                        <li><a href="{{ route('exams.destroy', $exam->id) }}" data-toggle="modal" data-target="#deletemodal_{{ $exam->id }}">Delete</a></li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" tabindex="-1" role="dialog" id="view_question_{{ $question->id }}">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                                    <div class="modal-body modal-body-md">
                                                        <h4 class="title">View Question</h4>
                                                        <ul class="nk-nav nav nav-tabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#view_question_title_{{ $question->id }}">Question Title</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#view_mcqs_{{ $mcq->id }}">MCQs</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#view_question_timer_{{ $question->timer }}">Timer</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#view_question_marks_{{ $question->question_marks }}">Marks</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="view_question_title_{{ $question->id }}">
                                                                <p class="">{{ $k++ }}) </p> <h5 class="mt-2"> {{ $question->title }}</h5>
                                                            </div>
                                                            <div class="tab-pane" id="view_mcqs_{{ $mcq->id }}">
                                                                <div class="row">
                                                                    <?php $j=1 ?>
                                                                    @foreach ($question->mcqs as $mcq)
                                                                        <div class="col-md-6">
                                                                            <p class="d-inline-block">{{ $j++ }})</p> <h5 class="d-inline-block mt-2"> {{ $mcq->name }}</h5>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="view_question_timer_{{ $question->timer }}">
                                                                <span>Question Time</span>
                                                                <h5 class=" mt-2"> {{ $question->timer }}</h5>
                                                            </div>
                                                            <div class="tab-pane" id="view_question_marks_{{ $question->question_marks }}">
                                                                <span>Question Marks</span>
                                                                <h5 class="mt-2"> {{ $question->question_marks }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-dim btn-primary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" tabindex="-1" role="dialog" id="edit_question_{{ $question->id }}">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                    <div class="modal-body modal-body-md">
                                                        <h4 class="title">Edit Question</h4>
                                                        <ul class="nk-nav nav nav-tabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#edit_question_title_{{ $question->title }}">Question Title</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#edit_mcqs_{{ $mcq->name }}">MCQs</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#edit_timer_{{ $question->timer }}">Question Time</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#edit_marks_{{ $question->question_marks }}">Question Marks</a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="edit_question_title_{{ $question->title }}">
                                                                <h6>Edit Title</h6>
                                                                <input type="text" name="question_title" class="form-control" id="title" value="{{ $question->title }}" required>
                                                                <input type="hidden" value="{{ $question->id }}" name="question_id[]">
                                                            </div>
                                                            <div class="tab-pane" id="edit_mcqs_{{ $mcq->name }}">
                                                                <h6 class="title">Edit Options</h6>
                                                                <div class="row">
                                                                    <?php $update_array_question = explode(',',$question->correct_answer_id); ?>

                                                                    @foreach ($question->mcqs as $mcq)
                                                                        <div class="col-md-6">
                                                                            <input type="text" name="old_option_{{$question->id}}[{{$mcq->id}}]" value="{{ $mcq->name }}" class="get_input form-control-sm border border-light mt-2" placeholder="option 1" required>
                                                                            <input type="checkbox" class="check" name="answer_{{$question->id}}[]" value="{{ $mcq->name }}" @if(in_array($mcq->name, $update_array_question)) checked @endif >
                                                                            <small>Correct answer</small>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane " id="edit_timer_{{ $question->timer }}">
                                                                <h6>Edit Question Time(seconds)</h6>
                                                                <div>
                                                                    <input type="number" min=0 value="{{ $question->timer }}" name="question_timer" class="form-control border border-light mt-2" placeholder="Add question time">
                                                                </div>

                                                                {{-- <input type="text" name="question_titles[]" class="form-control" id="title" value="{{ $question->title }}" required>
                                                                <input type="hidden" value="{{ $question->id }}" name="question_id[]"> --}}
                                                            </div>
                                                            <div class="tab-pane " id="edit_marks_{{ $question->question_marks }}">
                                                                <h6>Edit Question Marks</h6>
                                                                <div>
                                                                    <input type="number" min=0 value="{{ $question->question_marks }}" name="question_marks" class="form-control border border-light mt-2" placeholder="Marks for question" required>
                                                                </div>

                                                                {{-- <input type="text" name="question_titles[]" class="form-control" id="title" value="{{ $question->title }}" required>
                                                                <input type="hidden" value="{{ $question->id }}" name="question_id[]"> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-dim btn-primary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-dim btn-success">Update</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" tabindex="-1" id="delete_question_{{ $question->id }}">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Are you sure?</h5>
                                                    </div>
                                                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <p class="text-left"> You're about to delete your question.</p>
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
                                    @endforeach
                                </div>

                                {{-- <div class="nk-block">
                                    <?php $i = 1 ?>
                                    @foreach ($exam->questions as $question)
                                        <div class="nk-block-head nk-block-head-sm nk-block-between mt-2">
                                            <h5 class="title">{{ $i++ }} ) {{ $question->title }}</h5>
                                        </div><!-- .nk-block-head -->
                                    <div class="bq-note">
                                        <div class="bq-note-item">
                                            <?php $j=1 ?>
                                            <div class="bq-note-text">
                                                @foreach ($question->mcqs as $mcq)
                                                    @if($question->correct_answer_id === $mcq->id)
                                                    {{ $j++ }}) <span class="badge badge-pill badge-success mr-5" style="display: inline">{{ $mcq->name }}</span>
                                                    @else
                                                        <span class="mr-5" style="display: inline">{{ $j++ }}) {{ $mcq->name }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div><!-- .bq-note-item -->
                                    </div>
                                    @endforeach<!-- .bq-note -->
                                </div> --}}
                            </div>
                            <div class="tab-pane mt-5 text-body" id="invite_employees">
                                <h5>Invite Employees</h5>
                                <small>Invite the employees you want for the exam.</small>
                                @if (\Session::has('error'))
                                    <div class="alert alert-pro alert-info">
                                        <div class="alert-text">
                                            {{-- <h6>Oops!</h6> --}}
                                            <p>{!! \Session::get('error') !!}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('exams.invite', $exam->id) }}" method="GET">
                                            @csrf
                                            <select class="form-control user_list @error('select_users') is-invalid @enderror" name="select_users[]" multiple="multiple" data-placeholder="Select employees" required>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('select_users')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <button type="submit" class="mt-2 float-right btn btn-success spin" >Invite</button>
                                        </form>
                                    </div>
                                </div>
                                @if (count($exam->users) > 0)
                                    <h5>Invited Employees</h5>
                                    <div class="nk-tb-list nk-tb-orders mt-3">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>#</span></div>
                                            <div class="nk-tb-col"><span>Name</span></div>
                                            <div class="nk-tb-col tb-col-md text-right"><span>Email</span></div>
                                            {{-- <div class="nk-tb-col tb-col-md"><span>Start Date</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>End Date</span></div> --}}
                                            {{-- <div class="nk-tb-col text-right"><span>Action</span></div> --}}
                                        </div>
                                        <?php $i=1 ?>
                                        @foreach ($exam->users->unique() as $user)
                                            <div class="nk-tb-item text-body">
                                                <div class="nk-tb-col">
                                                    <strong><span >{{ $i++ }}</span></strong>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <strong><span >{{ $user->name }}</span></strong>
                                                </div>
                                                <div class="nk-tb-col tb-col-md text-right">
                                                    <span >{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                <div class="mt-1 bg-lighter p-1">
                                    <div class="nk-tb-col">
                                        <span class="text-body">This exam is not assigned to any employee currently.</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="tab-pane mt-5" id="exam_taken">
                                <h5 class="text-body">Exam Attempted By:</h5>
                                <small>This exam<strong>({{ $exam->title }})</strong> is attempted by these users.</small>
                                <span ></span>
                                @if(count($exam_users) > 0)
                                <div class="nk-tb-list nk-tb-orders mt-3">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>#</span></div>
                                        <div class="nk-tb-col"><span>Name</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span>Email</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Grade</span></div>
                                        <div class="nk-tb-col text-right"><span>Action</span></div>
                                    </div>
                                    <?php $i=1 ?>
                                    @foreach ($exam_users as $exam_user)
                                    <div class="nk-tb-item text-body">
                                        <div class="nk-tb-col">
                                            <strong><span>{{ $i++ }}</span></strong>
                                        </div>
                                        <div class="nk-tb-col">
                                            <strong><span>{{ $exam_user->name }}</span></strong>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span >{{ $exam_user->email }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            @foreach ($exam_user->results as $result)
                                                <span >{{ $result->grade }}</span>
                                            @endforeach
                                        </div>
                                        <div class="nk-tb-col text-right">
                                            <div class="dropdown">
                                                <a class="text-primary dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li><a href="{{ route('result.view', ['user_id' => $exam_user->id, 'exam_id' => $exam->id]) }}">View</a></li>
                                                        {{-- <li><a href="">Edit</a></li>
                                                        <li><a href="{{ route('exams.destroy', $exam->id) }}" data-toggle="modal" data-target="#deletemodal_{{ $exam->id }}">Delete</a></li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                    <div class="mt-1 bg-lighter p-1">
                                        <div class="nk-tb-col">
                                            <span class="text-body">This exam is not attempted by any employee currently.</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        $(".user_list").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

        $(document).on("click",".check",function(){
        var val = $(this).siblings('input').val();
        $(this).val(val);
        // console.log($(this).val(val));
        });

        $('.get_input').on("keyup",function(){
            var val = $(this).val();
            var ch  = $(this).siblings('input.check').val(val);
        // $(this).val(val);
            console.log(ch);
        });
    </script>

@endsection


