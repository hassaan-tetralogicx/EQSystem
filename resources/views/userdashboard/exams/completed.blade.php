@extends('layouts.dashboard')

@section('content')

    <div class="row container mt-5">
        <div class="col-md-12">
            <a href="{{ route('employees.index') }}" class="btn btn-primary float-right">Go Back</a>
        </div>
    </div>
    <div class="jumbotron mt-3">
        <h3 class="text-center">Exam Completed!</h3>
    </div>
    
@endsection


