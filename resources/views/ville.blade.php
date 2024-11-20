@extends('layouts.app')
<title>@yield('title', 'Villes')</title>

@section('content')
<h1 class="text-center">Liste des Villes</h1>
<div class="d-flex justify-content-center mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVilleModal">Ajouter une Ville</button>
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

    @if(isset($villes) && $villes->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Code Postal</th>
                        <th>Désignation Villes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($villes as $ville)
                        <tr>
                            <td>{{ $ville->cpVilles }}</td>
                            <td>{{ $ville->DesignationVilles }}</td>
                            <td>
                                <div class="d-inline-flex align-items-center">
                                    <button class="btn btn-success btn-sm m-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editVilleModal"
                                            onclick="editVille({{ json_encode($ville) }})">
                                        Modifier
                                    </button>
                                    <button class="btn btn-danger btn-sm m-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteVilleModal"
                                            onclick="deleteVille('{{ $ville->id }}')">
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
        <p class="alert alert-warning">Aucune ville trouvée dans la base de données.</p>
    @endif
</div>

<!-- Add Modal -->
<div class="modal fade" id="addVilleModal" tabindex="-1" role="dialog" aria-labelledby="addVilleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVilleModalLabel">Ajouter une Ville</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('forms.ville-form')
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editVilleModal" tabindex="-1" role="dialog" aria-labelledby="editVilleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVilleModalLabel">Modifier une Ville</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editVilleForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="editCpVilles">Code Postal</label>
                        <input type="text" name="cpVilles" class="form-control" id="editCpVilles" required readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editDesignationVilles">Désignation</label>
                        <input type="text" name="DesignationVilles" class="form-control" id="editDesignationVilles" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteVilleModal" tabindex="-1" role="dialog" aria-labelledby="deleteVilleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteVilleModalLabel">Supprimer une Ville</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette ville?</p>
                <form id="deleteVilleForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function editVille(ville) {
    document.querySelector('#editVilleModal #editCpVilles').value = ville.cpVilles;
    document.querySelector('#editVilleModal #editDesignationVilles').value = ville.DesignationVilles;
    document.querySelector('#editVilleForm').action = '{{ route('villes.update', '') }}/' + ville.id;
}

function deleteVille(id) {
    document.querySelector('#deleteVilleForm').action = '{{ route('villes.destroy', '') }}/' + id;
}
</script>
@endsection
