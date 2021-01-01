@extends('layouts.dashboard')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="card card-bordered card-full mt-5">
                <div class="card-inner border border-{top|bottom|left|right}-0">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title ml-4">Employess</h6>
                        </div>
                        <div class="card-tools">
                            <a href="{{ route('exams.create') }}" class="btn btn-dim btn-primary mr-4">Create Exam</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <table class="table table-tranx">
            <thead>
                <tr class="tb-tnx-head ">
                    <th class="tb-tnx-id"><span class="d-none"></span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Name</span>
                        </span>

                    </th>
                    <th class="tb-tnx-amount is-alt">
                        <span class="tb-tnx-total">Email</span>
                    </th>
                    <th class="tb-tnx-action">
                        <span>&nbsp;</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="tb-tnx-item">
                        <td class="tb-tnx-id ">
                            <a href="#"><span class="d-none"></span></a>
                        </td>

                        <td class="tb-tnx-info">
                            <div class="tb-tnx-desc">
                                <span class="title">{{ $user->name }}</span>
                            </div>

                        </td>
                        <td class="tb-tnx-amount is-alt">
                            <div class="tb-tnx-total">
                                <span class="amount"> {{ $user->email }} </span>
                            </div>
                            <div class="tb-tnx-status">
                                <span class="">
                                </span>
                            </div>
                        </td>
                        <td class="tb-tnx-action">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div>


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
