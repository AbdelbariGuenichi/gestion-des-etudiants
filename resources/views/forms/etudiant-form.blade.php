<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Submit Your Information</div>
                <div class="card-body">
                    <form id="etudiantForm" method="POST" action="{{ route('etudiants.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="Nce">Nce</label>
                            <input type="text" name="Nce" class="form-control" id="Nce" placeholder="Enter Nce" required>
                        </div>
                        <div class="form-group">
                            <label for="nci">Nci</label>
                            <input type="text" name="nci" class="form-control" id="nci" placeholder="Enter Nci" required>
                        </div>
                        <div class="form-group">
                            <label for="Nom">Nom</label>
                            <input type="text" name="Nom" class="form-control" id="Nom" placeholder="Enter Nom" required>
                        </div>
                        <div class="form-group">
                            <label for="Prenom">Prénom</label>
                            <input type="text" name="Prenom" class="form-control" id="Prenom" placeholder="Enter Prénom" required>
                        </div>
                        <div class="form-group">
                            <label for="DateNaissance">Date de Naissance</label>
                            <input type="date" name="DateNaissance" class="form-control" id="DateNaissance" required>
                        </div>
                        <div class="form-group">
                            <label for="CpLieuNaissance">Code Postal De Naissance</label>
                            <input type="text" name="CpLieuNaissance" class="form-control" id="CpLieuNaissance" placeholder="Enter Code Postal de Naissance" required>
                        </div>
                        <div class="form-group">
                            <label for="Adresse">Adresse</label>
                            <input type="text" name="Adresse" class="form-control" id="Adresse" placeholder="Enter Adresse" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="CpAdresse">Code Postal</label>
                            <input type="text" name="CpAdresse" class="form-control" id="CpAdresse" placeholder="Enter Code Postal" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
