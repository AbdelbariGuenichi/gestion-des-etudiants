@extends('layouts.app')
<title>@yield('title', 'Inscriptions')</title>

@section('content')
<h1 class="text-center">Liste des Inscriptions</h1>
<div class="d-flex justify-content-center mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inscriptionModal" >Ajouter une Inscription</button>
</div>
<div class="container mt-5">
    @include('partials.sql-errors')
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

    @if(isset($inscriptions) && $inscriptions->count() > 0)
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>NCI</th>
                    <th>Code Spécialité</th>
                    <th>Date Inscription</th>
                    <th>Niveau</th>
                    <th>Résultat Final</th>
                    <th>Mention</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inscriptions as $inscription)
                    <tr>
                        <td>{{ $inscription->nci }}</td>
                        <td>{{ $inscription->CodeSp }}</td>
                        <td>{{ $inscription->DateInscription }}</td>
                        <td>{{ $inscription->niveau }}</td>
                        <td>{{ $inscription->resultatFinale }}</td>
                        <td>{{ $inscription->Mention }}</td>
                        <td>
                            <div class="d-inline-flex align-items-center">
                                <button class="btn btn-success btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editInscriptionModal" onclick="editInscription({{ json_encode($inscription) }})" >
                                    Modifier
                                </button>
                                <button class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#deleteInscriptionModal" onclick="deleteInscription('{{ $inscription->nci }}', '{{ $inscription->CodeSp }}', '{{ $inscription->DateInscription }}')" >
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
        <p class="alert alert-warning">Aucune inscription trouvée dans la base de données.</p>
    @endif
</div>

<!-- Add Modal -->
<div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inscriptionModalLabel">Ajouter une Inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inscriptions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nci">NCI</label>
                        <input type="text" name="nci" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="CodeSp">Code Spécialité</label>
                        <input type="text" name="CodeSp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="DateInscription">Date Inscription</label>
                        <input type="date" name="DateInscription" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="niveau">Niveau</label>
                        <input type="text" name="niveau" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="resultatFinale">Résultat Final</label>
                        <input type="text" name="resultatFinale" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Mention">Mention</label>
                        <input type="text" name="Mention" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editInscriptionModal" tabindex="-1" role="dialog" aria-labelledby="editInscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInscriptionModalLabel">Modifier une Inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editInscriptionForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editNci">NCI</label>
                        <input type="text" name="nci" class="form-control" id="editNci" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="editCodeSp">Code Spécialité</label>
                        <input type="text" name="CodeSp" class="form-control" id="editCodeSp" required>
                    </div>
                    <div class="form-group">
                        <label for="editDateInscription">Date Inscription</label>
                        <input type="date" name="DateInscription" class="form-control" id="editDateInscription" required>
                    </div>
                    <div class="form-group">
                        <label for="editNiveau">Niveau</label>
                        <input type="text" name="niveau" class="form-control" id="editNiveau" required>
                    </div>
                    <div class="form-group">
                        <label for="editResultatFinale">Résultat Final</label>
                        <input type="text" name="resultatFinale" class="form-control" id="editResultatFinale" required>
                    </div>
                    <div class="form-group">
                        <label for="editMention">Mention</label>
                        <input type="text" name="Mention" class="form-control" id="editMention" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteInscriptionModal" tabindex="-1" aria-labelledby="deleteInscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteInscriptionModalLabel">Supprimer une Inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette inscription?</p>
                <form id="deleteInscriptionForm" method="POST" action="{{ route('inscriptions.destroy', 'delete') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="nci" id="deleteInscriptionNci">
                    <input type="hidden" name="CodeSp" id="deleteInscriptionCodeSp">
                    <input type="hidden" name="DateInscription" id="deleteInscriptionDateInscription">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
function editInscription(inscription) {
    console.log('Editing inscription:', inscription);
    document.querySelector('#editInscriptionModal #editNci').value = inscription.nci;
    document.querySelector('#editInscriptionModal #editCodeSp').value = inscription.CodeSp;
    document.querySelector('#editInscriptionModal #editDateInscription').value = inscription.DateInscription;
    document.querySelector('#editInscriptionModal #editNiveau').value = inscription.niveau;
    document.querySelector('#editInscriptionModal #editResultatFinale').value = inscription.resultatFinale;
    document.querySelector('#editInscriptionModal #editMention').value = inscription.Mention;

    const form = document.getElementById('editInscriptionForm');
    form.action = `{{ url('inscriptions') }}/${inscription.nci}`;
}

function deleteInscription(nci, codeSp, dateInscription) {
    console.log('Deleting inscription:', { nci, codeSp, dateInscription });
    document.querySelector('#deleteInscriptionNci').value = nci;
    document.querySelector('#deleteInscriptionCodeSp').value = codeSp;
    document.querySelector('#deleteInscriptionDateInscription').value = dateInscription;
}
</script>
