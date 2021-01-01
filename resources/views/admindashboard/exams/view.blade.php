@extends('layouts.dashboard')

@section('content')
<div class="col-xl-12 col-xxl-8 mt-5">
    <div class="card card-bordered card-full">
        <div class="card-inner border-bottom">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Your Exam!</h6>
                </div>
                <div class="card-tools">
                    <a href="/exams" class="btn btn-dim btn-primary d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                </div>
            </div>
        </div>
        <div class="card-inner">
            <div class="nk-block">
                <div class="nk-block-head">
                    <h5 class="title">Select Employees</h5>
                    <small>Invite the employees you want for the exam.</small>
                    <form action="{{ route('exams.invite', $exam->id) }}" method="GET">
                        @csrf
                        <select class="form-control user_list @error('select_users') is-invalid @enderror" name="select_users[]" multiple="multiple" data-placeholder="Select employees">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('select_users')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-info mt-2 float-right">Invite</button>
                    </form>
                </div><!-- .nk-block-head -->
                <div class="profile-ud-list pt-4">
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Exam Title</span>
                            <span class="profile-ud-value">{{ $exam->title }}</span>
                        </div>
                    </div>

                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Subject</span>
                            <span class="profile-ud-value">{{ $exam->subject->title }}</span>
                        </div>
                    </div>

                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Start Time <em class="icon ni ni-alarm-alt " ></em></span>
                            <span class="profile-ud-value">{{ date('m/d/Y | h:i a', strtotime($exam->start_time)) }}</span>
                        </div>
                    </div>

                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">End Time <em class="icon ni ni-alarm-alt " ></em></span>
                            <span class="profile-ud-value">{{ date('m/d/Y | h:i a', strtotime($exam->end_time)) }}</span>
                        </div>
                    </div>
                </div><!-- .profile-ud-list -->
            </div>
        </div>
        <div class="nk-tb-item nk-tb-head p-4">
            <div>
                <h6>Total Questions -
                    {{ $exam->questions()->count() }}
                </h6>
                <?php $i = 1 ?>
                @foreach ($exam->questions as $question)
                    <div class="mt-4">
                        <h6 class="d-inline-block">{{ $i++ }} ) {{ $question->title }}</h6>
                    </div>
                    <div class="mt-2">
                        <?php $j=1 ?>
                        @foreach ($question->mcqs as $mcq)
                            @if($question->correct_answer_id === $mcq->id)
                                {{ $j++ }} ) <span class="badge badge-pill badge-success  mr-5" style="display: inline">{{ $mcq->name }}</span>
                            @else
                                <span class="mr-5" style="display: inline">{{ $j++ }} ) {{ $mcq->name }}</span>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div><!-- .card -->
</div>

@endsection

@section('js')
    <script>
        $(".user_list").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    </script>
@endsection


