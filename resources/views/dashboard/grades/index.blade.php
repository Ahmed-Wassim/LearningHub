@extends('dashboard.layouts.app')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                        <i class="fa fa-arrow-left"></i></a> Grades Management
                </h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Education</li>
                    <li class="breadcrumb-item active">Grades</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2>All Grades</h2>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createGradesModal">
                        <i class="fa fa-plus"></i> Generate Grades
                    </button>
                </div>
                <div class="body table-responsive">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Grade Name</th>
                                <th>Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->level->name }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $grade->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button> --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteModal{{ $grade->id }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>


                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel{{ $grade->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $grade->id }}">Confirm
                                                    Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete "{{ $grade->name }}" grade?</p>
                                                <p class="text-danger"><small>This action cannot be undone.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.grades.destroy', $grade) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Grades Modal -->
    <div class="modal fade" id="createGradesModal" tabindex="-1" role="dialog" aria-labelledby="createGradesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.grades.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGradesModalLabel">Generate Multiple Grades</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="level_id">Select Level</label>
                            <select name="level_id" id="level_id" class="form-control" required>
                                <option value="">-- Select Level --</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}"
                                        data-prefix="{{ strtolower(substr($level->name, 0, 1)) }}"
                                        data-max="{{ $level->name == 'Primary School' ? 6 : 3 }}">
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="grade_count">Number of Grades</label>
                            <input type="number" id="grade_count" name="grade_count" min="1" max="6"
                                class="form-control" value="1" required>
                            <small class="form-text text-muted">
                                Primary School: Max 6 grades | High School: Max 3 grades
                            </small>
                        </div>

                        <div class="alert alert-info">
                            <p><strong>How it works:</strong></p>
                            <p>For Primary School, grades will be generated as: 1-p, 2-p, 3-p, etc.</p>
                            <p>For High School, grades will be generated as: 1-h, 2-h, 3-h, etc.</p>
                        </div>

                        <div id="previewContainer" class="d-none">
                            <h6>Grades to be created:</h6>
                            <div id="gradesPreview" class="bg-light p-2 rounded">
                                <!-- Preview will be shown here -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Generate Grades</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Single Grade Modal -->
    <div class="modal fade" id="createSingleGradeModal" tabindex="-1" role="dialog"
        aria-labelledby="createSingleGradeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.grades.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSingleGradeModalLabel">Add Single Grade</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="single_name">Grade Name</label>
                            <input type="text" class="form-control" id="single_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="single_level_id">Level</label>
                            <select name="level_id" id="single_level_id" class="form-control" required>
                                <option value="">-- Select Level --</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="single_code">Grade Code</label>
                            <input type="text" class="form-control" id="single_code" name="code" required>
                            <small class="form-text text-muted">
                                Example format: 1-p for Primary School Grade 1, 2-h for High School Grade 2
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Grade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Update max attribute of grade_count based on selected level
            $('#level_id').change(function() {
                var selectedOption = $(this).find('option:selected');
                var maxGrades = selectedOption.data('max');

                $('#grade_count').attr('max', maxGrades);

                // If current value is greater than new max, reset to max
                if (parseInt($('#grade_count').val()) > maxGrades) {
                    $('#grade_count').val(maxGrades);
                }

                updatePreview();
            });

            // Update preview when grade count changes
            $('#grade_count').on('input', function() {
                updatePreview();
            });

            function updatePreview() {
                var levelOption = $('#level_id').find('option:selected');
                var levelId = $('#level_id').val();
                var gradeCount = $('#grade_count').val();

                // Only show preview if level is selected and grade count is valid
                if (levelId && gradeCount > 0) {
                    var prefix = levelOption.data('prefix');
                    var levelName = levelOption.text().trim();
                    var maxGrades = levelOption.data('max');

                    // Validate grade count
                    if (gradeCount > maxGrades) {
                        gradeCount = maxGrades;
                        $('#grade_count').val(maxGrades);
                    }

                    var previewHTML = '';
                    for (var i = 1; i <= gradeCount; i++) {
                        previewHTML += '<div class="badge badge-primary mr-2 mb-2">';
                        previewHTML += 'Grade ' + i + ' (' + i + '-' + prefix + ')';
                        previewHTML += '</div>';
                    }

                    $('#gradesPreview').html(previewHTML);
                    $('#previewContainer').removeClass('d-none');
                } else {
                    $('#previewContainer').addClass('d-none');
                }
            }
        });
    </script>
@endsection
