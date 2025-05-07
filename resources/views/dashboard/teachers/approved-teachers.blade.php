@extends('dashboard.layouts.app')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                            class="fa fa-arrow-left"></i></a> Teachers</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Teachers</li>
                    <li class="breadcrumb-item active">All Teachers</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if ($teachers->isEmpty())
            <div class="alert alert-info">No teachers found.</div>
        @else
            <div class="row clearfix">
                @foreach ($teachers as $userId => $subjectUsers)
                    @php $teacher = $subjectUsers->first()->user; @endphp
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h3 class="mb-0">{{ $teacher->name }}</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    @foreach ($subjectUsers as $subjectUser)
                                        <div class="col-md-4 mb-3">
                                            <div class="card h-100 shadow-sm">
                                                @if ($subjectUser->image)
                                                    <img src="{{ asset($subjectUser->getImageUrl()) }}" class="card-img-top"
                                                        alt="{{ $subjectUser->subject->name }}"
                                                        style="height: 200px; object-fit: cover">
                                                @else
                                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                        style="height: 200px">
                                                        <i class="fa fa-book fa-3x text-muted"></i>
                                                    </div>
                                                @endif

                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $subjectUser->subject->name }}</h5>
                                                    <div class="card-text">
                                                        <p class="mb-1">
                                                            <strong>Price:</strong>
                                                            ${{ number_format($subjectUser->price, 2) }}
                                                        </p>
                                                        <p class="mb-0">
                                                            <strong>Status:</strong>
                                                            <span
                                                                class="badge {{ $subjectUser->active ? 'badge-success' : 'badge-secondary' }}">
                                                                {{ $subjectUser->active ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-transparent">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            Added: {{ $subjectUser->updated_at->format('M d, Y') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fa fa-book mr-1"></i> {{ count($subjectUsers) }} Subjects
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Add pagination if needed --}}
            @if (method_exists($teachers, 'links'))
                <div class="d-flex justify-content-center mt-4 mb-5">
                    {{ $teachers->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: all 0.3s ease;
        }

        .card-body .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-secondary {
            background-color: #6c757d;
        }

        .card-img-top {
            transition: all 0.3s ease;
        }
    </style>
@endpush
