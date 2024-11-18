<form id="noteForm" method="POST" action="{{ route('notes.store') }}">
    @csrf
    <div class="form-group">
        <label for="nci">Nci</label>
        <input type="text" name="nci" class="form-control" id="nci" placeholder="Enter Nce">
    </div>
    <div class="form-group">
        <label for="CodeMat">Code Matière</label>
        <input type="text" name="CodeMat" class="form-control" id="CodeMat" placeholder="Enter Code Matière">
    </div>
    <div class="form-group">
        <label for="DateResultat">Date Résultat</label>
        <input type="date" name="DateResultat" class="form-control" id="DateResultat">
    </div>
    <div class="form-group">
        <label for="NoteControle">Note Contrôle</label>
        <input type="number" step="0.1" name="NoteControle" class="form-control" id="NoteControle" placeholder="Enter Note Contrôle">
    </div>
    <div class="form-group">
        <label for="NoteExamen">Note Examen</label>
        <input type="number" step="0.1" name="NoteExamen" class="form-control" id="NoteExamen" placeholder="Enter Note Examen">
    </div>
    <div class="form-group mb-3">
        <label for="resultat">Résultat</label>
        <input type="text" name="resultat" class="form-control" id="resultat" placeholder="Enter Résultat">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
