<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Submit Your Information</div>
                <div class="card-body">
                    <form id="villeForm" method="POST" action="{{ route('villes.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="cpVilles">Code Postal</label>
                            <input type="text" name="cpVilles" class="form-control" id="cpVilles" placeholder="Enter Code Postal">
                        </div>
                        <div class="form-group">
                            <label for="DesignationVilles">Designation Villes</label>
                            <input type="text" name="DesignationVilles" class="form-control" id="DesignationVilles" placeholder="Enter Designation">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
