@extends('layouts.dashboard')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="card card-bordered card-full mt-5">
                <div class="card-inner border border-{top|bottom|left|right}-0">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title ml-4">Exams</h6>
                        </div>
                        <div class="card-tools">
                            <a href="{{ route('exams.create') }}" class="btn btn-dim btn-primary mr-4" >Create Exam</a>
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
                            <span>Exam Title</span>
                        </span>
                        <span class="tb-tnx-date d-md-inline-block d-none">
                            <span class="d-none d-md-block">
                                <span>Start Date</span>
                                <span>End Date</span>
                            </span>
                        </span>
                    </th>
                    <th class="tb-tnx-amount is-alt">
                        <span class="tb-tnx-total">Subject Title</span>
                        <span class="tb-tnx-status d-none d-md-inline-block">Action</span>
                    </th>
                    <th class="tb-tnx-action">
                        <span>&nbsp;</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr class="tb-tnx-item">
                        <td class="tb-tnx-id ">
                            <a href="#"><span class="d-none"></span></a>
                        </td>
                        <td class="tb-tnx-info">
                            <div class="tb-tnx-desc">
                                <span class="title">{{ $exam->title }}</span>
                            </div>
                            <div class="tb-tnx-date">
                                <span class="date">{{ $exam->start_time }}</span>
                                <span class="date">{{ $exam->end_time }}</span>
                            </div>
                        </td>
                        <td class="tb-tnx-amount is-alt">
                            <div class="tb-tnx-total">
                                <span class="amount">{{ $exam->subject->title }}</span>
                            </div>
                            <div class="tb-tnx-status">
                                <span class="">
                                    <a href="{{ route('exams.show', $exam->id) }}"><em class="icon ni ni-eye mr-1" data-toggle="tooltip" data-placement="top" title="View"></em></a>
                                    <a href="{{ route('exams.edit', $exam->id) }}"><em class="icon ni ni-edit mr-1" data-toggle="tooltip" data-placement="top" title="Edit"></em></a>
                                    <a href="" data-toggle="modal" data-target="#deletemodal_{{ $exam->id }}"><em class="icon ni ni-delete mr-1" data-toggle="tooltip" data-placement="top" title="Delete"></em></a>
                                    <div class="modal fade" tabindex="-1" id="deletemodal_{{ $exam->id }}">
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
                                    </div>
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






@endsection
