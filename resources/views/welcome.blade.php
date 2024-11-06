<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bienvenue')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
        <a class="navbar-brand" href="{{ route('welcome') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('etudiants.index') }}">Étudiants</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('matieres.index') }}">Matières</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('notes.index') }}">Notes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('specialites.index') }}">Spécialités</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('villes.index') }}">Villes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('inscriptions.index') }}">Inscriptions</a></li>
            </ul>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger mt-3">Logout</a>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>


    <footer class="bg-light text-center py-4">
        <h1 class="text-center">Bienvenue Admin</h1>
        <p>&copy; {{ date('Y') }} Abdelbari Guenichi. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
