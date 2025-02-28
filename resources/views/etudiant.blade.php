@extends('layouts.app')
<title>@yield('title', 'Etudiants')</title>

@section('content')
<div class="container mt-5">
    <h1 class="text-center my-5">Liste des Étudiants</h1>

    @include('partials.sql-errors')

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterEtudiantModal" name="button-form" >Ajouter un Étudiant</button>
    </div>

    @if ($errors->any())
        @endif

    @if(isset($etudiants) && $etudiants->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nce</th>
                        <th>Nci</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                        <th>CP Lieu de Naissance</th>
                        <th>Adresse</th>
                        <th>Code Postal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiants as $etudiant)
                        <tr class="text-center align-middle">
                            <td>{{ $etudiant->Nce}}</td>
                            <td>{{ $etudiant->nci }}</td>
                            <td>{{ $etudiant->Nom }}</td>
                            <td>{{ $etudiant->Prenom }}</td>
                            <td>{{ $etudiant->DateNaissance }}</td>
                            <td>{{ $etudiant->CpLieuNaissance }}</td>
                            <td>{{ $etudiant->Adresse }}</td>
                            <td>{{ $etudiant->CpAdresse }}</td>
                            <td>
                                <div class="d-inline-flex align-items-center">
                                    <button class="btn btn-success btn-sm m-1" data-bs-toggle="modal" name="button-form" data-bs-target="#editEtudiantModal" onclick="editEtudiant({{ json_encode($etudiant) }})" >
                                        Modifier
                                    </button>
                                    <button class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" name="button-form" data-bs-target="#deleteEtudiantModal" onclick="deleteEtudiant('{{ $etudiant->Nce }}')" >
                                        Supprimer
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="alert alert-warning text-center">Aucun étudiant trouvé dans la base de données.</p>
    @endif
</div>

<!-- Add Modal -->
<div class="modal fade" id="ajouterEtudiantModal" tabindex="-1" aria-labelledby="etudiantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="etudiantModalLabel">Ajouter un Étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('forms.etudiant-form')
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editEtudiantModal" tabindex="-1" aria-labelledby="editEtudiantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEtudiantModalLabel">Modifier un Étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEtudiantForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="editNce">Nce</label>
                        <input type="text" name="Nce" class="form-control" id="editNce" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editNci">Nci</label>
                        <input type="text" name="Nci" class="form-control" id="editNci" required readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editNom">Nom</label>
                        <input type="text" name="Nom" class="form-control" id="editNom" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editPrenom">Prénom</label>
                        <input type="text" name="Prenom" class="form-control" id="editPrenom" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editDateNaissance">Date de Naissance</label>
                        <input type="date" name="DateNaissance" class="form-control" id="editDateNaissance" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editCpLieuNaissance">Lieu de Naissance</label>
                        <input type="text" name="CpLieuNaissance" class="form-control" id="editCpLieuNaissance" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editAdresse">Adresse</label>
                        <input type="text" name="Adresse" class="form-control" id="editAdresse" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editCpAdresse">Code Postal</label>
                        <input type="text" name="CpAdresse" class="form-control" id="editCpAdresse" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteEtudiantModal" tabindex="-1" aria-labelledby="deleteEtudiantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEtudiantModalLabel">Supprimer un Étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet étudiant?</p>
                <form id="deleteEtudiantForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="Nce" id="deleteNce">
                    <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function editEtudiant(etudiant) {
    document.querySelector('#editEtudiantModal #editNce').value = etudiant.Nce;
    document.querySelector('#editEtudiantModal #editNci').value = etudiant.nci;
    document.querySelector('#editEtudiantModal #editNom').value = etudiant.Nom;
    document.querySelector('#editEtudiantModal #editPrenom').value = etudiant.Prenom;
    document.querySelector('#editEtudiantModal #editDateNaissance').value = etudiant.DateNaissance;
    document.querySelector('#editEtudiantModal #editCpLieuNaissance').value = etudiant.CpLieuNaissance;
    document.querySelector('#editEtudiantModal #editAdresse').value = etudiant.Adresse;
    document.querySelector('#editEtudiantModal #editCpAdresse').value = etudiant.CpAdresse;
    document.querySelector('#editEtudiantModal form').action = '{{ route('etudiants.update', '') }}/' + etudiant.nci;
}

function deleteEtudiant(Nce) {
    document.getElementById('deleteNce').value = Nce;
    document.querySelector('#deleteEtudiantForm').action = '{{ route('etudiants.destroy', '') }}/' + Nce;

}
</script>
@endsection
