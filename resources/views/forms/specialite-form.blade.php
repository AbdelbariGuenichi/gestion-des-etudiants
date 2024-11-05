<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Submit Your Information</div>
                <div class="card-body">
                    <form id="specialiteForm" method="POST" action="{{ route('specialites.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="CodeSp">Code Specialite</label>
                            <input type="text" name="CodeSp" class="form-control" id="CodeSp" placeholder="Enter Code Specialite">
                        </div>
                        <div class="form-group mb-3">
                            <label for="DesignationSp">Designation</label>
                            <input type="text" name="DesignationSp" class="form-control" id="DesignationSp" placeholder="Enter Designation">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
