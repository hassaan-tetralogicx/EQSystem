@extends('layouts.dashboard')

@section('content')


<div class="nk-block">
    <div class="row">
        <div class="col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body">My Exams</h5>
                        </div>
                        <div class="card-tools">
                            <a href="" class="btn btn-dim btn-primary ml-2">Result Record</a>
                        </div>
                    </div>
                </div>
                {{-- @if (count($exams) > 0) --}}
                    <div class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>#</span></div>
                                <div class="nk-tb-col tb-col-lg"><span>Exam Title</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Subject</span></div>
                                {{-- <div class="nk-tb-col tb-col-lg"><span>End Date</span></div> --}}
                                {{-- <div class="nk-tb-col"><span>Amount</span></div> --}}
                                {{-- <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div> --}}
                                <div class="nk-tb-col text-right"><span>Action</span></div>
                            </div>
                            <?php $i=1 ?>
                            @foreach ($exams->unique() as $exam)
                            <div class="nk-tb-item text-body">
                                <div class="nk-tb-col">
                                    <span>{{ $i++ }}</span>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <strong><span >{{ $exam->title }}</span></strong>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span >{{ $exam->subject->title }}</span>
                                </div>

                                <div class="nk-tb-col text-right">
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li><a href="{{ route('employees.show', $exam->id) }}">View</a></li>
                                            </ul>
                                        </div>
                                        {{-- <div class="modal fade" tabindex="-1" id="deletemodal_{{ $exam->id }}">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Are you sure?</h5>
                                                    </div>
                                                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf

                                                        <div class="modal-body">
                                                            <p class="text-left"> You're about to delete your record</p>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-dim btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-dim btn-danger btn-sm">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                {{-- @else
                <div class="nk-tb-item bg-lighter p-2">
                    <div class="nk-tb-col">
                        <span class="text-body ">No exam is created currently.</span>
                    </div>
                </div>
                @endif --}}
            </div><!-- .card -->
        </div>
    </div>
</div>
{{-- <div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Employee / <strong class="text-primary small">{{ auth()->user()->name }}</strong></h3>
                </div>

            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-aside-wrap">
                    <div class="card-content">
                        <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><em class="icon ni ni-file-text"></em><span>All Exams</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><em class="icon ni ni-repeat"></em><span>Exam Results</span></a>
                            </li>
                        </ul><!-- .nav-tabs -->
                        <div class="card-inner">
                            <div class="nk-block nk-block-lg">
                                <div class="card card-bordered card-preview">
                                    <table class="table table-tranx">
                                        <thead>
                                            <tr class="tb-tnx-head ">
                                                <th class="tb-tnx-id"><span class="d-none"></span></th>
                                                <th class="tb-tnx-info">
                                                    <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                        <span>Exam Title</span>
                                                    </span>
                                                </th>
                                                <th class="tb-tnx-amount is-alt">
                                                    <span class="tb-tnx-status d-none d-md-inline-block">Action</span>
                                                </th>
                                                <th class="tb-tnx-action">
                                                    <span>&nbsp;</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exams->unique() as $exam)
                                                <tr class="tb-tnx-item">
                                                    <td class="tb-tnx-id ">
                                                        <a href="#"><span class="d-none"></span></a>
                                                    </td>
                                                    <td class="tb-tnx-info">
                                                        <div class="tb-tnx-desc">
                                                            <span class="title">{{ $exam->title }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="tb-tnx-amount is-alt">
                                                        <div class="tb-tnx-status">
                                                            <span class="">
                                                                <a href="{{ route('employees.show', $exam->id) }}"><em class="icon ni ni-eye mr-1" data-toggle="tooltip" data-placement="top" title="View"></em></a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="tb-tnx-action">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card-content -->
                </div><!-- .card-aside-wrap -->
            </div><!-- .card -->
        </div><!-- .nk-block -->
    </div>
</div> --}}
@endsection
