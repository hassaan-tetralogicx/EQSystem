@extends('layouts.dashboard')

@section('content')

<div class="nk-block">
    <div class="row">
        <div class="col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body">Employees</h5>
                        </div>
                        <div class="card-tools">
                            <a href="{{ route('exams.create') }}" class="btn btn-dim btn-primary">Create Exam</a>
                        </div>
                    </div>
                </div>
                @if (count($users) > 0)
                <div class="card-inner p-0 border-top">
                    <div class="nk-tb-list nk-tb-orders">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>#</span></div>
                            <div class="nk-tb-col text-right"><span>Name</span></div>
                            <div class="nk-tb-col text-right"><span>Email</span></div>
                        </div>
                        <?php $i = 1 ?>
                        @foreach ($users as $user)

                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="text-body">{{ $i++ }}</span>
                            </div>
                            <div class="nk-tb-col text-right">
                               <strong><span class="text-body">{{ $user->name }}</span></strong>
                            </div>
                            <div class="nk-tb-col text-right">
                                <span class="text-body">{{ $user->email }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="nk-tb-item bg-lighter p-2">
                    <div class="nk-tb-col">
                        <span class="text-body ">No employee is registered currently.</span>
                    </div>
                </div>
                @endif
                {{-- <div class="card-inner-sm border-top text-center d-sm-none">
                    <a href="#" class="btn btn-link btn-block">See History</a>
                </div> --}}
            </div><!-- .card -->
        </div>
    </div>
</div>






{{-- <div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="card card-bordered card-full">
                <div class="card-inner border border-{top|bottom|left|right}-0 px-3">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title text-body">Employees</h5>
                        </div>
                        <div class="card-tools">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($users) > 0)
    <div class="card card-bordered card-preview">
        <table class="table table-tranx">
            <thead>
                <tr class="tb-tnx-head ">
                    <th class="">
                        <span class="">
                            <span>Name</span>
                        </span>

                    </th>
                    <th class="text-right">
                        <span>Email</span>
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="tb-tnx-item">
                        <td class="">
                            <span class="title">{{ $user->name }}</span>
                        </td>
                        <td class="text-right">
                            <span > {{ $user->email }} </span>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- .card-preview -->
    @else
        <p class="pt-2">No registered employees.</p>
    @endif
</div> --}}

{{-- <div class="col-xl-12 col-xxl-8 pt-5">
    <div class="card card-bordered card-full">
        <div class="card-inner border-bottom">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Employess</h6>
                </div>

            </div>
        </div>
        <div class="nk-tb-list">
            <form action="" method="get">
                <table class="nk-tb-list">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-sm"><span>Name</span></th>
                            <th class="nk-tb-col tb-col-sm"><span>Email</span></th>
                            <th class="nk-tb-col tb-col-sm"><span>Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="nk-tb-item nk-tb-head">
                            <td class="nk-tb-col tb-col-sm">{{ $user->name }}</td>
                            <td class="nk-tb-col tb-col-sm">{{ $user->email }}</td>
                            <td class="nk-tb-col tb-col-sm"><a href="#" class="btn btn-primary btn-sm">Invite</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div> --}}

@endsection
