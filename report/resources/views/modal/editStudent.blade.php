<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="editStudentForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Student Name</label>
                        <input type="text" id="edit_name" name="name"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" id="edit_course" name="course"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Office</label>
                        <input type="text" id="edit_office" name="office"
                               class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>