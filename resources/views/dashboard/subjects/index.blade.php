@extends('dashboard.layouts.app')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                            class="fa fa-arrow-left"></i></a> Table Example</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Subjects</li>
                    <li class="breadcrumb-item active">All Subjects</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2>Subjects</h2>
                    <a href="{{ route('admin.subjects.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add Subject
                    </a>
                </div>
                <div class="body table-responsive">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Level</th>
                                <th>Price</th>
                                <th>is Free</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ Str::limit($subject->slug, 50) }}</td>
                                    <td>{{ $subject->grade->name }}</td>
                                    <td>{{ $subject->price }}</td>
                                    <td>{{ $subject->is_free ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <img src="{{ $subject->getImageUrl() }}" alt="Primary School"
                                            style="width: 50px; height: 50px;" />
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.subjects.edit', $subject) }}"
                                            class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $subject->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $subject->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel{{ $subject->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $subject->id }}">Confirm
                                                    Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete "{{ $subject->name }}"?</p>
                                                <p class="text-danger"><small>This action cannot be undone.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.subjects.destroy', $subject->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No subjects found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
