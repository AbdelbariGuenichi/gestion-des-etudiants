<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Submit Your Information</div>
                <div class="card-body">
                    <form id="matiereForm" method="POST" action="{{ route('matieres.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="CodeMat">Code Matière</label>
                            <input type="text" name="CodeMat" class="form-control" id="CodeMat" placeholder="Enter Code Matière">
                        </div>
                        <div class="form-group">
                            <label for="CodeSp">Code Specialite</label>
                            <input type="text" name="CodeSp" class="form-control" id="CodeSp" placeholder="Enter Code Specialite">
                        </div>
                        <div class="form-group">
                            <label for="niveau">Niveau</label>
                            <input type="text" name="niveau" class="form-control" id="niveau" placeholder="Enter Niveau">
                        </div>
                        <div class="form-group">
                            <label for="coef">Coefficient</label>
                            <input type="number" step="0.1" name="coef" class="form-control" id="coef" placeholder="Enter Coefficient">
                        </div>
                        <div class="form-group">
                            <label for="credit">Credit</label>
                            <input type="number" step="0.1" name="credit" class="form-control" id="credit" placeholder="Enter Credit">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
