@extends('layouts.dashboard')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="card card-bordered card-full mt-5">
                <div class="card-inner border border-{top|bottom|left|right}-0">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title ml-4">Subjects</h6>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-dim btn-primary mr-4" data-toggle="modal" data-target="#addmodal">Add New</button>                            <div class="modal fade" tabindex="-1" id="addmodal">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Subject</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                        </div>
                                        <form action="{{ route('subject.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="subject" placeholder="add new subject">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-dim btn-primary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-dim btn-success">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <table class="table table-tranx">
            <thead>
                <tr class="tb-tnx-head">
                    <th class="tb-tnx-id"><span class="d-none"></span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Subject Title</span>
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
                @if (count($subjects)>0)
                <tr class="tb-tnx-item">
                    <td class="tb-tnx-id ">
                        <a href="#"><span class="d-none"></span></a>
                    </td>
                    @foreach ($subjects as $subject)
                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title">{{ $subject->title }}</span>
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-status">
                            <span class="">
                                <a href="" data-toggle="modal" data-target="#editmodal_{{ $subject->id }}"><em class="icon ni ni-edit mr-1" data-toggle="tooltip" data-placement="top" title="Edit"></em> </a>
                                    <div class="modal fade" tabindex="-1" id="editmodal_{{ $subject->id }}">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Subject</h5>
                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                        <em class="icon ni ni-cross"></em>
                                                    </a>
                                                </div>
                                                <form action="{{ route('subject.update', ['id' => $subject->id]) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $subject->title }}" placeholder="edit subject">
                                                        @error('title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-dim btn-primary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-dim btn-success">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <a href="" data-toggle="modal" data-target="#deletemodal_{{ $subject->id }}"><em class="icon ni ni-delete mr-1" data-toggle="tooltip" data-placement="top" title="Delete"></em></a>
                                    <div class="modal fade" tabindex="-1" id="deletemodal_{{ $subject->id }}">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are you sure?</h5>
                                                </div>
                                                <form action="{{ route('subject.delete', ['id' => $subject->id]) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="text-left">You're about to delete your record.</p>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-dim btn-primary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-dim btn-danger">Delete</button>
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
                    @endforeach
                </tr>
                @else
                    No subject is registered.
                @endif
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div>

@endsection
