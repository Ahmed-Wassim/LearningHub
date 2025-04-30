@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Create Level</h2>
                </div>
                <div class="body">
                    <form id="basic-form" action="{{ route('admin.levels.store') }}" enctype="multipart/form-data"
                        method="post" novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>

                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="min_age" class="control-label">Min Age</label>
                                <input name="min_age" type="number" id="min-age" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="max_age" class="control-label">Max Age</label>
                                <input name="max_age" type="number" id="max-age" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="5" cols="30" required></textarea>
                        </div>

                        <div class="card">
                            <div class="header">
                                <h2>Upload Photo</h2>
                            </div>
                            <div class="body">
                                <input name="image" type="file" class="dropify">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Create</button>
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
