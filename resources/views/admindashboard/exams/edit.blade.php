@extends('layouts.dashboard')

@section('content')

<div class="col-xl-12 col-xxl-8 px-0">
    <div class="card card-bordered card-full">
        <div class="card-inner border-bottom">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title ">Edit your Exam!</h6>
                </div>
                <div class="card-tools">
                    <a href="/exams" class="btn btn-primary">Go Back</a>
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
                                        <input type="text" name="title" placeholder="enter title" value="{{ $exam->title }}" class="form-control @error('title') is-invalid @enderror" id="title" required>
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
                                        <select class="form-control  form-select  @error('select_subject') is-invalid @enderror" id="select_subject" name="select_subject" data-placeholder="Select an option" required>
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
                                        {{-- <span>{{ $exam->start_time }}</span> --}}
                                        <input type="datetime-local" id="start_date" name="start_time" value="{{ $exam->start_time }}" class="form-control  @error('start_time') is-invalid @enderror" required>
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
                                        {{-- <p>{{ $exam->end_time }}</p> --}}
                                        <input type="datetime-local" name="end_time" value="{{ $exam->end_time }}" class="form-control @error('end_time') is-invalid @enderror" id="end_date" required>
                                        @error('end_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group d-flex justify-content-between">
                                    <h4 class="mt-1">Questions</h4>
                                    <div>
                                        <button type="button" class="btn btn-primary add_question">Add Question</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 questions">
                                @foreach ($exam->questions as $question)
                                    <div class="col-lg-12 show_question px-0">
                                        <div class="form-group ">
                                            <label class="form-label mt-2">Enter Question:</label>

                                            <div class="row">
                                                <div class="col-md-11">
                                                    <input type="text" name="old_question_titles[]" value="{{ $question->title }}" class="form-control border border-gray add-row" placeholder="enter your question" id="" required>
                                                    <input type="hidden" value="{{ $question->id }}" name="question_id[]">
                                                </div>
                                                <div class="col-md-1 text-right btn-group btn-sm">
                                                    <button type="button" class="btn btn-success btn-sm add_mcq">+</button>
                                                    <button type="button" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#deletemodal_{{ $question->id }}">-</button>
                                                    <div class="modal fade" tabindex="-1" id="deletemodal_{{ $question->id }}">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Are you sure?</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="text-left"> You're about to delete your question.</p>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" class="btn btn-dim btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-dim btn-danger remove_stored_mcq btn-sm" data-id="{{ $question->id }}">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row ">
                                                <div class="col-md-6 ">
                                                    <span class="d-inline-block">Question Time:</span>
                                                    <input type="number" min=0 name="question_timer[]" value="{{ $question->timer }}" class="form-control border border-light mt-2 d-inline-block" placeholder="Add question time">
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="d-inline-block">Enter Question Marks:</span>
                                                    <input type="number" min=0 name="question_marks[]" value="{{ $question->question_marks }}" class="form-control border border-light mt-2 d-inline-block" placeholder="Marks for question" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <?php $correct = explode(',', $question->correct_answer_id); ?>

                                                @foreach ($question->mcqs as $mcq)
                                                    <div class="col-md-6">
                                                        <input type="text" name="old_option_{{$question->id}}[{{$mcq->id}}]" value="{{ $mcq->name }}" class="get_input form-control-sm border border-light mb-3" placeholder="option 1" required>
                                                        <input type="checkbox" class="check" name="answer_{{$question->id}}[]" value="{{$mcq->name}}" @if(in_array($mcq->name, $correct)) checked @endif >
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
            <div class="col-lg-12 show_question px-0">
                <div class="form-group mt-2">
                    <label class="form-label mt-2" >Enter Question:</label>
                    <div class="row">
                        <div class="col-md-11">
                            <input type="text" name="question_title[]" class="form-control border border-gray add-row" placeholder="enter your question" id="" required>
                        </div>
                        <div class="col-md-1 text-right btn-group btn-sm">
                            <button type="button" class="btn btn-success btn-sm add_mcq">+</button>
                            <button type="button" class="btn btn-danger btn-sm remove_mcq ">-</button>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-6 ">
                            <span class="d-inline-block">Question Time:</span>
                            <input type="number" min=0 name="new_question_timer[]" class="form-control border border-light mt-2 d-inline-block" placeholder="Add question time">
                        </div>
                        <div class="col-md-6">
                            <span class="d-inline-block">Enter Question Marks:</span>
                            <input type="number" min=0 name="new_question_marks[]" class="form-control border border-light mt-2 d-inline-block" placeholder="Marks for question" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="option_1[]" class="form-control-sm border border-light mb-3" placeholder="option 1" required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="" >
                            <small>Correct answer</small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="option_2[]" class="form-control-sm border border-light mb-3" placeholder="option 2" required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="" >
                            <small>Correct answer</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="option_3[]" class="form-control-sm border border-light" placeholder="option 3"required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="" >
                            <small>Correct answer</small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="option_4[]" class="form-control-sm border border-light" placeholder="option 4" required>
                            <input type="checkbox" class="check" name="answer_${i}[]" value="" >
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
    $(document).on("click",".remove_stored_mcq",function(){
        var id = $(this).data('id');
        var empty = $(this).closest('.show_question');
        var modal = $("#deletemodal_"+id );


        // console.log(modal.hide());

        $.ajax({
                type: "GET",
                url: "/exam/question/" + id,
                success: function (response) {
                    // console.log(response);
                    if(response.data == 'success')
                    {
                        empty.html('');
                        i--;
                        modal.hide();
                        // console.log(modal.modal('hide'));
                        $(".modal-backdrop").remove();
                    }
                },

            });

    });

    $(document).on("click",".check",function(){
        var val = $(this).siblings('input').val();
        $(this).val(val);
        // console.log($(this).val(val));
    });
    // $(document).on("change",".get_input",function(){
    //     var val = $(this).val();
    //     console.log(val);
    //     $(this).val(val);
    //     // console.log($(this).val(val));
    // });
    $('.get_input').on('keyup', function() {
        var val = $(this).val();
        // console.log( $(this).siblings());
        $(this).siblings('input.check').val(val);
        // $(this).val(val);
        // console.log($('.check').val(val));
    });

        // $("").append('');

    // $(document).on('click', '.remove-tr', function(){

    //      $(this).parents('tr').remove();

    // });



</script>
@endsection

