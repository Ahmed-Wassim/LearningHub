<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Become Teacher</title>
    <link rel="stylesheet" href="{{ asset('assets/css/checklist.css') }}" />
</head>

<body>
    <div class="container">
        <div class="checklist-form">
            <h2>Grades you want to Become teacher on it</h2>

            <form action="{{ route('teacher.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="checklist-group">
                    @foreach ($grades as $grade)
                        @if ($grade->hasSubjects())
                            <h3>{{ $grade->name }}</h3>
                        @endif

                        @foreach ($grade->subjects as $subject)
                            <div class="subject-block">
                                <div class="checklist-item">
                                    <input type="checkbox" id="subject{{ $subject->id }}" class="subject-checkbox"
                                        onchange="toggleSubjectFields({{ $subject->id }})" />
                                    <label for="subject{{ $subject->id }}">{{ $subject->name }}</label>
                                    <input type="hidden" id="subject_id{{ $subject->id }}"
                                        name="subjects[{{ $subject->id }}][subject_id]" value="{{ $subject->id }}"
                                        disabled>
                                </div>

                                <div class="subject-details" id="details{{ $subject->id }}">
                                    <div class="form-group">
                                        <label for="price{{ $subject->id }}">Price</label>
                                        <input type="number" id="price{{ $subject->id }}"
                                            name="subjects[{{ $subject->id }}][price]" min="0" step="0.01"
                                            placeholder="Enter price" class="price-input" disabled required>
                                    </div>

                                    <div class="form-group toggle-container">
                                        <label for="status{{ $subject->id }}">Active</label>
                                        <div class="toggle-switch">
                                            <input type="checkbox" id="status{{ $subject->id }}"
                                                name="subjects[{{ $subject->id }}][active]" value="1"
                                                class="toggle-input" checked disabled>
                                            <label for="status{{ $subject->id }}" class="toggle-label"></label>
                                        </div>
                                    </div>

                                    <!-- New Image Upload Field -->
                                    <div class="form-group image-upload-container">
                                        <label class="upload-label" for="image{{ $subject->id }}">Subject
                                            Image</label>
                                        <input type="file" id="image{{ $subject->id }}"
                                            name="subjects[{{ $subject->id }}][image]" class="image-input"
                                            accept="image/*" onchange="previewImage(this, {{ $subject->id }})">
                                        <img id="preview{{ $subject->id }}" class="image-preview" src="#"
                                            alt="Preview">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary submit-btn">
                    Submit
                </button>
            </form>
        </div>
    </div>
    <script>
        function toggleSubjectFields(subjectId) {
            const checkbox = document.getElementById('subject' + subjectId);
            const subjectIdField = document.getElementById('subject_id' + subjectId);
            const priceField = document.getElementById('price' + subjectId);
            const statusField = document.getElementById('status' + subjectId);
            const detailsDiv = document.getElementById('details' + subjectId);

            if (checkbox.checked) {
                // Enable the fields for this subject
                subjectIdField.disabled = false;
                priceField.disabled = false;
                statusField.disabled = false;
                detailsDiv.style.display = 'block';
            } else {
                // Disable the fields for this subject
                subjectIdField.disabled = true;
                priceField.disabled = true;
                statusField.disabled = true;
                detailsDiv.style.display = 'none';
            }
        }

        // Initialize all subject fields on page load
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.subject-checkbox');
            checkboxes.forEach(function(checkbox) {
                const subjectId = checkbox.id.replace('subject', '');
                toggleSubjectFields(subjectId);
            });
        });
    </script>
</body>

</html>
