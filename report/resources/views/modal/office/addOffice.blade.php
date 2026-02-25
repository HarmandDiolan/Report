<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Office</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
            <div class="modal-body">
                <form action="{{ route('offices.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="officeName" class="form-label">Office Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="officeName" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Office</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>