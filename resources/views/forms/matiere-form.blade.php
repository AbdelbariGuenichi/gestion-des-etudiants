<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Submit Your Information</div>
                <div class="card-body">
                    <form id="matiereForm" method="POST" action="{{ route('matieres.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="CodeMat">Code Matière</label>
                            <input type="text" name="CodeMat" id="CodeMat" class="form-control" placeholder="Enter Code Matière" value="{{ old('CodeMat') }}">
                            @error('CodeMat')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="CodeSp">Code Specialite</label>
                            <input type="text" name="CodeSp" id="CodeSp" class="form-control" placeholder="Enter Code Specialite" value="{{ old('CodeSp') }}">
                            @error('CodeSp')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="niveau">Niveau</label>
                            <input type="text" name="niveau" id="niveau" class="form-control" placeholder="Enter Niveau" value="{{ old('niveau') }}">
                            @error('niveau')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="coef">Coefficient</label>
                            <input type="number" step="0.1" name="coef" id="coef" class="form-control" placeholder="Enter Coefficient" value="{{ old('coef') }}">
                            @error('coef')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="credit">Credit</label>
                            <input type="number" step="0.1" name="credit" id="credit" class="form-control" placeholder="Enter Credit" value="{{ old('credit') }}">
                            @error('credit')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
