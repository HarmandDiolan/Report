<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ $school->id }}">

                    <div class="mb-3">
                        <label for="studentNames" class="form-label">Student Names (one per line)</label>
                        <textarea class="form-control @error('studentNames') is-invalid @enderror" 
                                  id="studentNames" name="studentNames" rows="5" placeholder="Enter each student name on a new line" required>{{ old('studentNames') }}</textarea>
                        @error('studentNames')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="studentCourse" class="form-label">Course</label>
                        <input type="text" class="form-control @error('studentCourse') is-invalid @enderror" 
                               id="studentCourse" name="studentCourse" value="{{ old('studentCourse') }}">
                        @error('studentCourse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="studentOffice" class="form-label">Office</label>
                        <input type="text" class="form-control @error('studentOffice') is-invalid @enderror" 
                               id="studentOffice" name="studentOffice" value="{{ old('studentOffice') }}">
                        @error('studentOffice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Student</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>