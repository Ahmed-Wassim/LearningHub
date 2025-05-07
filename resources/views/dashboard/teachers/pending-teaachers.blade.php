@extends('dashboard.layouts.app')
@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                            class="fa fa-arrow-left"></i></a> Teacher Approvals</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Teachers</li>
                    <li class="breadcrumb-item active">Pending Approvals</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2>Pending Teacher Approvals</h2>
                </div>
                <div class="body">
                    <div class="row">
                        @forelse ($pendingTeachers as $userId => $requests)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">{{ $requests->first()->user->name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Subject</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($requests as $request)
                                                        <tr>
                                                            <td>
                                                                @if ($request->hasImage())
                                                                    <img src="{{ $request->getImageUrl() }}"
                                                                        alt="{{ $request->subject->name }}" class="rounded"
                                                                        width="80">
                                                                @else
                                                                    <img src="{{ asset('images/no-image.png') }}"
                                                                        alt="No Image" class="rounded" width="40">
                                                                @endif
                                                            </td>
                                                            <td>{{ $request->subject->name }}</td>
                                                            <td>${{ $request->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-2 mx-2">
                                            <form action="{{ route('admin.teachers.approve', $userId) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary w-100">Approve
                                                    Teacher</button>
                                            </form>
                                        </div>
                                        <div class="col mb-2 mx-2">
                                            <form action="{{ route('admin.teachers.reject', $userId) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger w-100">Reject
                                                    Teacher</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    No pending teacher approvals found.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alternative List View (Commented out) -->

    {{-- <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2>Pending Teacher Approvals (List View)</h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Teacher Name</th>
                                <th>Subjects</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($groupedRequests as $userId => $requests)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requests->first()->user->name }}</td>
                                    <td>
                                        @foreach ($requests as $request)
                                            <div class="d-flex align-items-center mb-1">
                                                @if ($request->subject->image)
                                                    <img src="{{ asset('storage/'.$request->subject->image) }}" alt="{{ $request->subject->name }}" class="rounded mr-2" width="25" height="25">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="rounded mr-2" width="25" height="25">
                                                @endif
                                                <span class="badge badge-info">{{ $request->subject->name }} (${{ $request->price }})</span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{ route('approve.teacher', $userId) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">Approve All</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No pending teacher approvals found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
