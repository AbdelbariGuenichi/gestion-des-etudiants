@extends('layouts.app')
<title>@yield('title', 'Notes')</title>

@section('content')
<h1 class="text-center mt-5">Liste des Notes</h1>
<div class="d-flex justify-content-center mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal">Ajouter un Note</button>
</div>
<div class="container mt-4">
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

    @if(isset($notes) && $notes->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nci</th>
                        <th>Code Matière</th>
                        <th>Date Résultat</th>
                        <th>Note Contrôle</th>
                        <th>Note Examen</th>
                        <th>Résultat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                        <tr>
                            <td>{{ $note->nci }}</td>
                            <td>{{ $note->CodeMat }}</td>
                            <td>{{ $note->DateResultat }}</td>
                            <td>{{ $note->NoteControle }}</td>
                            <td>{{ $note->NoteExamen }}</td>
                            <td>{{ $note->resultat }}</td>
                            <td>
                                <div class="d-inline-flex align-items-center">
                                    <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#editNoteModal" onclick="editNote({{ json_encode($note) }})">
                                        Modifier
                                    </button>
                                    <button class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteNoteModal" onclick="deleteNote('{{ $note->nci }}')">
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
        <p class="alert alert-warning">Aucune note trouvée dans la base de données.</p>
    @endif
</div>

<!-- AjouterModal -->
<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel">Ajouter une Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('forms.note-form')
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog" aria-labelledby="editNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNoteModalLabel">Modifier une Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editNoteForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editNce">Nce</label>
                        <input type="text" name="Nce" class="form-control" id="editNce" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="editCodeMat">Code Matière</label>
                        <input type="text" name="CodeMat" class="form-control" id="editCodeMat" required>
                    </div>
                    <div class="form-group">
                        <label for="editDateResultat">Date Résultat</label>
                        <input type="date" name="DateResultat" class="form-control" id="editDateResultat" required>
                    </div>
                    <div class="form-group">
                        <label for="editNoteControle">Note Contrôle</label>
                        <input type="number" name="NoteControle" class="form-control" id="editNoteControle" required>
                    </div>
                    <div class="form-group">
                        <label for="editNoteExamen">Note Examen</label>
                        <input type="number" name="NoteExamen" class="form-control" id="editNoteExamen" required>
                    </div>
                    <div class="form-group">
                        <label for="editResultFinale">Résultat Finale</label>
                        <input type="text" name="resultat" class="form-control" id="editResultFinale" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteNoteModal" tabindex="-1" aria-labelledby="deleteNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteNoteModalLabel">Supprimer une Note</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette note?</p>
                <form id="deleteNoteForm" method="POST" action="{{ route('notes.destroy', 'delete') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="Nce" id="deleteNoteNce">
                    <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function editNote(note) {
        document.querySelector('#editNoteModal #editNce').value = note.Nce;
        document.querySelector('#editNoteModal #editCodeMat').value = note.CodeMat;
        document.querySelector('#editNoteModal #editDateResultat').value = note.DateResultat;
        document.querySelector('#editNoteModal #editNoteControle').value = note.NoteControle;
        document.querySelector('#editNoteModal #editNoteExamen').value = note.NoteExamen;
        document.querySelector('#editNoteModal #editResultFinale').value = note.resultat;
        document.querySelector('#editNoteModal form').action = '{{ route('notes.update', '') }}/' + note.Nce;
    }

    function deleteNote(Nce) {
        document.getElementById('deleteNoteNce').value = Nce;
    }
</script>
