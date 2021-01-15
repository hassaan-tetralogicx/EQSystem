@extends('layouts.dashboard')

@section('content')

<div class="col-xl-12 col-xxl-8 px-0">
    <div class="card card-bordered card-full">
        <div class="card-inner border-bottom">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Create your Exam!</h6>
                </div>
                <div class="card-tools">
                    <a href="/exams" class="btn btn-dim btn-primary d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                </div>
            </div>
        </div>
        <div class="nk-tb-list">
            <div class="card card-bordered">
                <div class="card-inner">
                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="title">Exam Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="title" placeholder="enter title" class="form-control @error('title') is-invalid @enderror" id="title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="select_subject">Select Subject</label>
                                    <div class="form-control-wrap ">
                                        <select class="form-control form-select @error('select_subject') is-invalid @enderror" id="select_subject" name="select_subject" data-placeholder="Select an option">
                                            @foreach ($subjects as $subject)
                                                <option label="empty" value=""></option>
                                                <option label="" value="{{ $subject->id }}">{{ $subject->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('select_subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="start_date">Start Date</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local" id="start_date" name="start_time" class="form-control form-control-outlined @error('start_time') is-invalid @enderror">
                                        @error('start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="end_date">End Date</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local" name="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_date">
                                        @error('end_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12">
                                <div class="form-group">

                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="form-group d-flex justify-content-between">
                                    <h4 class="mt-1">Questions</h4>
                                    <div>
                                        <button type="button" class="btn btn-primary add_question">Add Question</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 questions"></div>
                            <div class="col-12 ml-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-success">Save Exam</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .card -->
</div>
@endsection

@section('js')
<script type="text/javascript">
    var i = 0;

    $(document).on("click",".add_question, .add_mcq",function() {
        i++;
        $('.questions').append(`
            <div class="col-lg-12 show_question">
                <div class="form-group mt-4">
                    <label class="form-label ">Enter Question:</label>
                    <div class="row mt-2">
                        <div class="col-md-11">
                            <input type="text" name="question_title[]" class="form-control border border-gray add-row" placeholder="enter your question" id="" required>
                        </div>
                        <div class="col-md-1 text-right btn-group btn-sm">
                            <button type="button" class="btn btn-success btn-sm add_mcq">+</button>
                            <button type="button" class="btn btn-danger btn-sm remove_mcq">-</button>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-6 ">
                            <span class="d-inline-block">Question Time:</span>
                            <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" min=0 name="question_timer[]" class="form-control border border-light mt-2 d-inline-block" placeholder="Add question time" required>
                        </div>
                        <div class="col-md-6">
                            <span class="d-inline-block">Enter Question Marks:</span>
                            <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" min=0 name="question_marks[]" class="form-control border border-light mt-2 d-inline-block" placeholder="Marks for question" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="option_1[]" class="form-control-sm border border-light mt-2" placeholder="option 1" required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="">
                            <small>Correct answer</small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="option_2[]" class="form-control-sm border border-light mt-2" placeholder="option 2" required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="">
                            <small>Correct answer</small>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <input type="text" name="option_3[]" class="form-control-sm border border-light mt-2" placeholder="option 3" required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="">
                            <small>Correct answer</small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="option_4[]" class="form-control-sm border border-light mt-2" placeholder="option 4" required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="">
                            <small>Correct answer</small>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });
    $(document).on("click",".remove_mcq",function(){
        $(this).closest('.show_question').empty();
        i--;
    });
    $(document).on("click",".check",function(){
        var val = $(this).siblings('input').val();
        $(this).val(val);
        // console.log($(this).val(val));
    });


</script>
@endsection

