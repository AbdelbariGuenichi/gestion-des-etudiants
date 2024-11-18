@extends('layouts.app')
@section('title', 'Spécialités')
@section('content')

<h1 class="text-center">Liste des Spécialités</h1>
<div class="d-flex justify-content-center mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSpecialiteModal">Ajouter une Spécialité</button>
</div>

<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($specialites) && $specialites->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Code Spécialité</th>
                    <th>Désignation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($specialites as $specialite)
                    <tr>
                        <td>{{ $specialite->CodeSp }}</td>
                        <td>{{ $specialite->DesignationSp }}</td>
                        <td>
                            <div class="d-inline-flex align-items-center">
                                <!-- Edit Button -->
                                <button class="btn btn-success btn-sm m-1" data-bs-toggle="modal"
                                        data-bs-target="#editSpecialiteModal"
                                        data-codesp="{{ $specialite->CodeSp }}"
                                        data-designationsp="{{ $specialite->DesignationSp }}">
                                    Modifier
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm m-1" data-bs-toggle="modal"
                                        data-bs-target="#deleteSpecialiteModal"
                                        data-codesp="{{ $specialite->CodeSp }}">
                                    Supprimer
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="alert alert-warning">Aucune spécialité trouvée dans la base de données.</p>
    @endif
</div>

<!-- Add Specialite Modal -->
<div class="modal fade" id="addSpecialiteModal" tabindex="-1" role="dialog" aria-labelledby="addSpecialiteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSpecialiteModalLabel">Ajouter une Spécialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Include only the form -->
                @include('forms.specialite-form')
            </div>
        </div>
    </div>
</div>

<!-- Global Edit Specialite Modal -->
<div class="modal fade" id="editSpecialiteModal" tabindex="-1" aria-labelledby="editSpecialiteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSpecialiteModalLabel">Modifier une Spécialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editSpecialiteForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editCodeSp">Code Spécialité</label>
                        <input type="text" name="CodeSp" class="form-control" id="editCodeSp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editDesignationSp">Désignation</label>
                        <input type="text" name="DesignationSp" class="form-control" id="editDesignationSp" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Global Delete Specialite Modal -->
<div class="modal fade" id="deleteSpecialiteModal" tabindex="-1" aria-labelledby="deleteSpecialiteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSpecialiteModalLabel">Supprimer une Spécialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette spécialité?</p>
                <form method="POST" id="deleteSpecialiteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Populate Edit Modal
    document.querySelectorAll('[data-bs-target="#editSpecialiteModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.querySelector('#editSpecialiteModal');
            modal.querySelector('#editCodeSp').value = this.dataset.codesp;
            modal.querySelector('#editDesignationSp').value = this.dataset.designationsp;
            modal.querySelector('#editSpecialiteForm').action = `/specialites/${this.dataset.codesp}`;
        });
    });

    document.querySelectorAll('[data-bs-target="#deleteSpecialiteModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.querySelector('#deleteSpecialiteModal');
            modal.querySelector('#deleteSpecialiteForm').action = `/specialites/${this.dataset.codesp}`;
        });
    });
</script>

@endsection
