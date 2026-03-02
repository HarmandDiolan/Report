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

                    <!-- Student Names -->
                    <div class="mb-3">
                        <label class="form-label">Student Names (one per line)</label>
                        <textarea class="form-control"
                                  name="studentNames"
                                  rows="5"
                                  required></textarea>
                    </div>

                    <!-- Course -->
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <input type="text"
                               name="studentCourse"
                               class="form-control">
                    </div>

                    <!-- Office -->
                    <div class="mb-3">
                        <label class="form-label">Office</label>
                        <select name="office_id" class="form-control">
                            <option value="">-- Select Office --</option>
                            @foreach($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Contact Number (FIXED) -->
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text"
                               id="contactNumber"
                               name="contactNumber"
                               class="form-control"
                               placeholder="09XXXXXXXXX"
                               maxlength="11"
                               inputmode="numeric">
                    </div>

                    <!-- Dates -->
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Date Started</label>
                            <input type="date"
                                   name="dateStart"
                                   class="form-control">
                        </div>
                        <div class="col">
                            <label class="form-label">End Of Duty</label>
                            <input type="date"
                                   name="endOfDuty"
                                   class="form-control">
                        </div>
                    </div>

                    <!-- Duty -->
                    <div class="row mt-2">
                        <div class="col">
                            <label class="form-label">Hours Of Duty</label>
                            <input type="number"
                                   name="hoursOfDuty"
                                   class="form-control">
                        </div>
                        <div class="col">
                            <label class="form-label">Days Of Duty</label>
                            <input type="number"
                                   name="daysOfDuty"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Student</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>