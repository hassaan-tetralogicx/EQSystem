@extends('layouts.dashboard')

@section('content')
<!-- With Only Header -->
<div class="row mt-5">
    <div class="col-md-12">
        <div class="card card-bordered">
        <div class="card-inner mr-5 ">
            <a href="" class="btn btn-dark ">Upcoming</a>
            <a href="" class="btn btn-success">Completed</a>
            <a href="" class="btn btn-primary">All</a>

            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
    </div></div>
</div>
<h6 class="mt-5">My Exams</h6>
<table class="table table-striped mt-4">
    <thead>
      <tr>
        <th scope="col">Exams</th>
        <th scope="col">Handle</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($exams as $exam)
            <tr>
                <td>{{ $exam->title }}</td>
                <td>sd</td>
                <td><a href="{{ route('employees.show', $exam->id) }}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
