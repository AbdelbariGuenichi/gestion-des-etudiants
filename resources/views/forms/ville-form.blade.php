<form id="villeForm" method="POST" action="{{ route('villes.store') }}">
    @csrf
    <div class="form-group">
        <label for="cpVilles">Code Postal</label>
        <input type="text" name="cpVilles" class="form-control" id="cpVilles" placeholder="Enter Code Postal">
    </div>
    <div class="form-group mb-3">
        <label for="DesignationVilles">Designation Villes</label>
        <input type="text" name="DesignationVilles" class="form-control" id="DesignationVilles" placeholder="Enter Designation">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
