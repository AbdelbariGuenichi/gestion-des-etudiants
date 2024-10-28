<form action="{{ route('inscriptions.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nci">NCI:</label>
        <input type="text" class="form-control" id="nci" name="nci" value="{{ old('nci') }}">
        @error('nci')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="CodeSp">CodeSp:</label>
        <input type="text" class="form-control" id="CodeSp" name="CodeSp" value="{{ old('CodeSp') }}">
        @error('CodeSp')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="DateInscription">Date d'Inscription:</label>
        <input type="date" class="form-control" id="DateInscription" name="DateInscription" value="{{ old('DateInscription') }}">
        @error('DateInscription')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="niveau">Niveau:</label>
        <input type="text" class="form-control" id="niveau" name="niveau" value="{{ old('niveau') }}">
        @error('niveau')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="resultatFinale">Résultat Final:</label>
        <input type="text" class="form-control" id="resultatFinale" name="resultatFinale" value="{{ old('resultatFinale') }}">
        @error('resultatFinale')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="Mention">Mention:</label>
        <input type="text" class="form-control" id="Mention" name="Mention" value="{{ old('Mention') }}">
        @error('Mention')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Ajouter Inscription</button>
</form>
