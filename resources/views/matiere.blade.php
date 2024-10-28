@extends('layouts.app')
<title>@yield('title', 'Matieres')</title>

@section('content')
<h1>Liste des Matières</h1>
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

    <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#matiereModal">Ajouter une Matière</button>
    </div>

    @if(isset($matieres) && $matieres->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Code Matière</th>
                    <th>Code Spécialité</th>
                    <th>Niveau</th>
                    <th>Coefficient</th>
                    <th>Crédit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matieres as $matiere)
                    <tr>
                        <td>{{ htmlspecialchars((string)$matiere->CodeMat) }}</td>
                        <td>{{ htmlspecialchars((string)$matiere->CodeSp) }}</td>
                        <td>{{ htmlspecialchars((string)$matiere->niveau) }}</td>
                        <td>{{ htmlspecialchars((string)$matiere->coef) }}</td>
                        <td>{{ htmlspecialchars((string)$matiere->credit) }}</td>
                        <td>
                            <div class="d-inline-flex align-items-center">
                                <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#editMatiereModal" onclick="editMatiere({{ json_encode($matiere) }})">
                                    Modifier
                                </button>
                                <button class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteMatiereModal" onclick="deleteMatiere('{{ $matiere->CodeMat }}')" >
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
        <p class="alert alert-warning text-center">Aucun matière trouvé dans la base de données.</p>
    @endif
</div>

<!-- Add Modal -->
<div class="modal fade" id="matiereModal" tabindex="-1" role="dialog" aria-labelledby="matiereModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="matiereModalLabel">Ajouter une Matière</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('forms.matiere-form')
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editMatiereModal" tabindex="-1" role="dialog" aria-labelledby="editMatiereModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMatiereModalLabel">Modifier une Matière</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMatiereForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editCodeMat">Code Matière</label>
                        <input type="text" name="CodeMat" class="form-control" id="editCodeMat" required>
                    </div>
                    <div class="form-group">
                        <label for="editCodeSp">Code Spécialité</label>
                        <input type="text" name="CodeSp" class="form-control" id="editCodeSp" required>
                    </div>
                    <div class="form-group">
                        <label for="editNiveau">Niveau</label>
                        <input type="text" name="niveau" class="form-control" id="editNiveau" required>
                    </div>
                    <div class="form-group">
                        <label for="editCoef">Coefficient</label>
                        <input type="text" name="coef" class="form-control" id="editCoef" required>
                    </div>
                    <div class="form-group">
                        <label for="editCredit">Crédit</label>
                        <input type="text" name="credit" class="form-control" id="editCredit" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteMatiereModal" tabindex="-1" role="dialog" aria-labelledby="deleteMatiereModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMatiereModalLabel">Supprimer une Matière</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette matière ?</p>
                <form id="deleteMatiereForm" method="POST" action="{{ route('matieres.destroy', 'delete') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="CodeMat" id="deleteCodeMat">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editMatiere(matiere) {
        document.querySelector('#editCodeMat').value = matiere.CodeMat;
        document.querySelector('#editCodeSp').value = matiere.CodeSp;
        document.querySelector('#editNiveau').value = matiere.niveau;
        document.querySelector('#editCoef').value = matiere.coef;
        document.querySelector('#editCredit').value = matiere.credit;
        document.querySelector('#editMatiereForm').action = '{{ route('matieres.update', '') }}/' + matiere.CodeMat;
    }

    function deleteMatiere(CodeMat) {
        document.querySelector('#deleteCodeMat').value = CodeMat;
    }
</script>
@endsection
