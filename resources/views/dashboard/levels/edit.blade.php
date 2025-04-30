@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Edit Level</h2>
                </div>
                <div class="body">
                    <form id="basic-form" action="{{ route('admin.levels.update', $level->id) }}" enctype="multipart/form-data"
                        method="post" novalidate>
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" value="{{ $level->name }}" class="form-control" required>
                        </div>

                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="min_age" class="control-label">Min Age</label>
                                <input name="min_age" type="number" value="{{ $level->min_age }}" id="min-age"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="max_age" class="control-label">Max Age</label>
                                <input name="max_age" value="{{ $level->max_age }}" type="number" id="max-age"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="5" cols="30" required>{{ $level->description }}</textarea>
                        </div>

                        <div class="card">
                            <div class="header">
                                <h2>Upload Photo</h2>
                            </div>
                            <div class="body">
                                <input name="image" type="file" class="dropify">
                            </div>
                        </div>
                        <img src="{{ $level->image ? asset('storage/' . $level->image) : asset('default/school.jpg') }}"
                            alt="Primary School" style="width: 250px; height: 150px;" />
                        <br><br><br>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/js/pages/forms/dropify.js') }}"></script>
@endsection
