@extends('layouts.dashboard')

@section('content')

<div class="nk-block nk-block-lg">
    {{-- <div class="nk-block-head ">
        <div class="nk-block-head-content">
            <div class="card card-bordered card-full">
                <div class="card-inner border border-{top|bottom|left|right}-0">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="text-body">Subjects</h5>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-dim btn-primary ml-2" data-toggle="modal" data-target="#addmodal">Add New</button>                            <div class="modal fade" tabindex="-1" id="addmodal">
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
                                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="subject" placeholder="add new subject" required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <textarea name="description" class="form-control mt-2 @error('description') is-invalid @enderror" id="subject" placeholder="add description" required></textarea>
                                                @error('description')
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
    </div> --}}

    <div class="nk-block">
        <div class="row">
            <div class="col-xxl-8">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h5 class="title text-body"><span>Subjects</span></h5>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-dim btn-primary ml-2" data-toggle="modal" data-target="#addmodal">Create Subject</button>                            <div class="modal fade" tabindex="-1" id="addmodal">
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
                                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="subject" placeholder="add new subject" required>
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <textarea name="description" class="form-control mt-2 @error('description') is-invalid @enderror" id="subject" placeholder="add description" required></textarea>
                                                    @error('description')
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

                    <div class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            @if (count($subjects)>0)
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>Subject Title</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Subject Description</span></div>
{{--                                <div class="nk-tb-col tb-col-md"><span>Created at</span></div>--}}
                                <div class="nk-tb-col text-right"><span>Action</span></div>
                            </div>
                            @foreach ($subjects as $subject)

                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <strong><span class="text-body">{{ $subject->title }}</span></strong>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <div>
                                        <span class="text-body">{{ $subject->description }}</span>
                                    </div>
                                </div>
{{--                                <div class="nk-tb-col tb-col-md">--}}
{{--                                    <div>--}}
{{--                                        <span class="text-body">{{ date('m/d/Y | h:i', strtotime($subject->description)) }}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="nk-tb-col text-right">
                                    <div class="dropdown">
                                        <a class="text-primary dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li><a href="{{ route('admin.view-subject', $subject->id) }}">View</a></li>
                                                <li><a href="" data-toggle="modal" data-target="#editmodal_{{ $subject->id }}">Edit</a></li>
                                                <li><a href="" data-toggle="modal" data-target="#deletemodal_{{ $subject->id }}">Delete</a></li>
                                            </ul>
                                        </div>
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
                                                            <textarea name="description" class="form-control mt-2 @error('description') is-invalid @enderror" id="subject" placeholder="add description" required>{{ $subject->description }}</textarea>
                                                            @error('description')
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
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <div class="nk-tb-item bg-lighter p-2">
                                    <div class="nk-tb-col">
                                        <span class="text-body">No subject is registered currently.</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div><!-- .card -->
            </div>
        </div>
    </div>
</div>

@endsection


