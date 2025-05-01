@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                            class="fa fa-arrow-left"></i></a> Levels</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Levels</li>
                    <li class="breadcrumb-item active">Create Level</li>
                </ul>
            </div>
            <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                    <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px"
                        data-line-Width="1" data-line-Color="#00c5dc" data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
                    <span>Visitors</span>
                </div>
                <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                    <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px"
                        data-line-Width="1" data-line-Color="#f4516c" data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
                    <span>Visits</span>
                </div>
            </div>
        </div>
    </div>
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

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="min_age" class="control-label">Min Age</label>
                                    <input name="min_age" type="number" id="min-age" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="max_age" class="control-label">Max Age</label>
                                    <input name="max_age" type="number" id="max-age" class="form-control">
                                </div>
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
