@extends('layouts.dashboard')

@section('content')

<div class="col-xl-12 col-xxl-8 mt-5">
    <div class="card card-bordered card-full">
        <div class="card-inner border-bottom">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title ">Edit your Exam!</h6>
                </div>
                <div class="card-tools">
                    <a href="/exams" class="btn btn-primary ">Go Back</a>
                </div>
            </div>
        </div>
        <div class="nk-tb-list">
            <div class="card card-bordered">
                <div class="card-inner">
                    <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="title">Edit Exam Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="title" placeholder="enter title" value="{{ $exam->title }}" class="form-control @error('title') is-invalid @enderror" id="title">
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
                                                <option value="{{ $subject->id }}"
                                                    @if($exam->subject->id === $subject->id) selected  @endif>
                                                    {{ $subject->title }}</option>
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
                                        <input type="datetime-local" id="start_date" name="start_time" value="{{ $exam->start_time }}" class="form-control form-control-outlined @error('start_time') is-invalid @enderror" required>
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
                                        <input type="datetime-local" name="end_time" value="{{ $exam->end_time }}" class="form-control @error('end_time') is-invalid @enderror" id="end_date">
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
                                    <h4 for="">Questions</h4>
                                    <div>
                                        <button type="button" class="btn btn-primary add_question">Add Question</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 questions">
                                @foreach ($exam->questions as $question)
                                    <div class="col-lg-12 show_question my-4">
                                        <div class="form-group ">
                                            <label class="form-label">Enter Question:</label>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="text" name="question_titles[]" value="{{ $question->title }}" class="form-control add-row" placeholder="enter your question" id="">
                                                    <input type="hidden" value="{{ $question->id }}" name="question_id[]">
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <button type="button" class="btn btn-success btn-sm add_mcq">+</button>
                                                    <button type="button" class="btn btn-danger btn-sm remove_mcq">-</button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                @foreach ($question->mcqs as $mcq)
                                                    <div class="col-md-6">
                                                        <input type="text" name="old_option_{{$question->id}}[{{$mcq->id}}]" value="{{ $mcq->name }}" class="form-control-sm mt-2" placeholder="option 1">
                                                        <input type="radio" name="answer_{{$question->id}}" value="{{$mcq->id}}" @if($question->correct_answer_id == $mcq->id) checked @endif>
                                                        <small>Correct answer</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-12 ml-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Update Exam</button>
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
            <div class="col-lg-12 show_question my-4">
                <div class="form-group ">
                    <label class="form-label" >Enter Question:</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="question_title[]" class="form-control add-row" placeholder="enter your question" id="">
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="button" class="btn btn-success btn-sm add_mcq">+</button>
                            <button type="button" class="btn btn-danger btn-sm remove_mcq">-</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="option_1[]" class="form-control-sm" placeholder="option 1">
                            <input type="radio" name="answer_${i}" value="1" >
                            <small>Correct answer</small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="option_2[]" class="form-control-sm" placeholder="option 2">
                            <input type="radio" name="answer_${i}" value="2">
                            <small>Correct answer</small>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="option_3[]" class="form-control-sm" placeholder="option 3">
                            <input type="radio" name="answer_${i}" value="3">
                            <small>Correct answer</small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="option_4[]" class="form-control-sm" placeholder="option 4">
                            <input type="radio" name="answer_${i}" value="4">
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

        // $("").append('');

    // $(document).on('click', '.remove-tr', function(){

    //      $(this).parents('tr').remove();

    // });



</script>
@endsection

