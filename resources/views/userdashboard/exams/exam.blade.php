@extends('layouts.dashboard')

@section('content')
<form action="{{ route('employees.check', [ 'exam_id' => $exam->id, 'question_id' => $question->id]) }}" method="get">
    @csrf
<div class="card bg-default mt-5">
    <div class="card-header bg-dark text-white">
        <strong class="mr-5"> Exam Title: </strong>
        <strong> {{ $exam->title}} </strong>
    </div>
    <div class="card-inner">
        <h5>Q: {{ $question->title }}</h5>
        <div class="row">
            <?php $j = 1 ?>
            @foreach ($question->mcqs as $mcq)
                <div class="col-md-6 pt-3">
                    {{ $j++}}) <strong class="text-dark">{{ $mcq->name }}</strong>
                    <input type="radio" name="answer" value="{{$mcq->id}}" >
                    <small>Correct answer</small>
                </div>
            @endforeach
        </div>
    </div>
</div>
<br>
    <button type="submit" class="btn btn-secondary float-right">Next</button>
</form>
@endsection
