@extends('layouts.dashboard')

@section('content')

<div class="card bg-default mt-5">
    <form action="{{ route('employees.check', [ 'exam_id' => $exam->id, 'question_id' => $question->id]) }}" method="get">
        @csrf
    <div class="card-header bg-lighter text-center d-inline-block">
        <strong class="mr-5"> Exam Title: </strong>
        <strong> {{ $exam->title}} </strong>

    </div>
    <div class="countdown d-inline-block mt-2 float-right"></div>
    <input type="hidden" id="question_time" value="{{ $mcq->question_timer }}">
    <div class="card-inner">
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
        <div class="container mt-sm-5 my-1">
            <div class="question ml-sm-5  pl-sm-5 pt-2">
                <div class="d-flex justify-content-between">
                    <b class="py-2 h5 d-inline-block">Q. {{ $question->title }}</b>
                    <div id="timer" class="countdown py-2"></div>
                </div>
                {{-- <input type="hidden" id="question_time" value="{{ $question->timer }}"> --}}
                <div class="pt-sm-0" id="options">
                    @foreach ($question->mcqs as $mcq)
                        <label class="options"> <span class="ml-5"> {{ $mcq->name }}</span>
                            <input type="checkbox" name="answer[]" value="{{$mcq->name}}">
                            <span class="checkmark"></span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="d-flex align-items-center pt-3">
                <div class="ml-auto mr-sm-5">
                    <button type="submit" class="btn btn-success next_question">Next</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box
    }

    body {
        background-color: rgb(199, 199, 199)
    }

    .container {
        background-color: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
        border-radius: 10px;
        padding: 20px;
        font-family: 'Montserrat', sans-serif;
        max-width: 1000px
    }

    .container>p {
        font-size: 32px
    }

    .question {
        width: 75%
    }

    .options {
        background-color: rgb(245 246 250);
        position: relative;
        border-radius: 20px;
        padding: 10px 10px;
    }

    #options label {
        display: block;
        margin-bottom: 15px;
        font-size: 14px;
        cursor: pointer
    }

    .options input {
        opacity: 0
    }

    .checkmark {
        position: absolute;
        /* top: -1px; */
        left: 10px;
        height: 25px;
        width: 25px;
        background-color: #555;
        border: 1px solid #ddd;
        border-radius: 50%
    }

    .options input:checked~.checkmark:after {
        display: block
    }

    .options .checkmark:after {
        content: "";
        width: 10px;
        height: 10px;
        display: block;
        background: white;
        position: absolute;
        top: 50%;
        left: 50%;
        border-radius: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: 300ms ease-in-out 0s
    }

    .options input[type="checkbox"]:checked~.checkmark {
        background: #21bf73;
        transition: 300ms ease-in-out 0s
    }

    .options input[type="checkbox"]:checked~.checkmark:after {
        transform: translate(-50%, -50%) scale(1)
    }

    .btn-primary {
        background-color: #555;
        color: #ddd;
        border: 1px solid #ddd
    }

    .btn-primary:hover {
        background-color: #21bf73;
        border: 1px solid #21bf73
    }

    .btn-success {
        padding: 5px 25px;
        background-color: #21bf73
    }

    @media(max-width:576px) {
        .question {
            width: 100%;
            word-spacing: 2px
        }
    }
 </style>

@endsection

@section('js')
<script>
    var sec = $('#question_time').val();
    var time = setInterval(myTimer, 1000);
    var exam_id = {!! $exam->id !!};
    var question_id = {!! $question->id !!};
    function myTimer() {

        document.getElementById('timer').innerHTML = sec + " sec left";
        var update_timer = sec--;
        $.ajax({
                type: "POST",
                url: `/questions/update_time/${exam_id}/${question_id}`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "update_timer": update_timer,
                },
                success: function (response) {
                    if(response.data == 'success')
                    {

                    }
                },

            });
        if (sec == 0) {
            clearInterval(time);
            $('form').submit();
        }
        $(document).on('click', '.next_question', function(){
            clearInterval(time);
            $('form').submit();
        })
    }
</script>
@endsection
