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
                        <select id="edit_office" name="office_id" class="form-control">
                            <option value="">Select Office</option>
                            @foreach($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="number" id="edit_contact" name="contactNumber"
                               class="form-control">
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label">Date Started</label>
                            <input type="date" id="edit_start" name="dateStart"
                                class="form-control">
                        </div>
                        <div class="col">
                            <label class="form-label">End Of Duty</label>
                            <input type="date" id="edit_end" name="endOfDuty"
                                class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label">Hours Of Duty</label>
                            <input type="number" id="edit_hours" name="hoursOfDuty"
                                class="form-control">
                        </div>
                        <div class="col">
                            <label class="form-label">Days Of Duty</label>
                            <input type="number" id="edit_days" name="daysOfDuty"
                                class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>