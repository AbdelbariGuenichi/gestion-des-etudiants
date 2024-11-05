@extends('layouts.app')
@section('title', 'Spécialités')
@section('content')

<h1 class="text-center">Liste des Spécialités</h1>
<div class="d-flex justify-content-center mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#specialiteModal" name="button-form" >Ajouter une Spécialité</button>
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
                                <button class="btn btn-success btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editSpecialiteModal" name="button-form" >Modifier</button>
                                <button class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#deleteSpecialiteModal" name="button-form" >Supprimer</button>
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

<!-- Add Modal -->
<div class="modal fade" id="specialiteModal" tabindex="-1" role="dialog" aria-labelledby="specialiteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="specialiteModalLabel">Ajouter une Spécialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('specialites.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="CodeSp">Code Spécialité</label>
                        <input type="text" name="CodeSp" class="form-control" id="CodeSp" required>
                    </div>
                    <div class="form-group">
                        <label for="DesignationSp">Désignation</label>
                        <input type="text" name="DesignationSp" class="form-control" id="DesignationSp" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSpecialiteModal" tabindex="-1" role="dialog" aria-labelledby="editSpecialiteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSpecialiteModalLabel">Modifier une Spécialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSpecialiteForm" method="POST" action="{{ route('specialites.update', '') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editCodeSp">Code Spécialité</label>
                        <input type="text" name="CodeSp" class="form-control" id="editCodeSp" required readonly value="{{ $specialite->CodeSp }}">
                    </div>
                    <div class="form-group">
                        <label for="editDesignationSp">Désignation</label>
                        <input type="text" name="DesignationSp" class="form-control" id="editDesignationSp" required value="{{ $specialite->DesignationSp }}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteSpecialiteModal" tabindex="-1" aria-labelledby="deleteSpecialiteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSpecialiteModalLabel">Supprimer une Spécialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette spécialité?</p>
                <form id="deleteSpecialiteForm" method="POST" action="{{ route('specialites.destroy', '') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="CodeSp" id="deleteSpecialiteCodeSp" value="{{ $specialite->CodeSp }}">
                    <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
