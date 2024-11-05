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
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth('admin')
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('etudiants.index') }}">Étudiants</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('matieres.index') }}">Matières</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('notes.index') }}">Notes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('specialites.index') }}">Specialités</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('villes.index') }}">Villes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('inscriptions.index') }}">Inscriptions</a></li>
            </ul>
            @else
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#">Étudiants</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Matières</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Notes</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Specialités</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Villes</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Inscriptions</a></li>
            </ul>
            @endauth
            <span class="navbar-text me-2" id="adminUsername" style="display: none;"></span>
            <button class="btn btn-primary" id="loginButton" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        </div>
    </nav>


    <footer class="bg-light text-center py-4">
        <h1 class="text-center">Bienvenue</h1>
        <p>&copy; {{ date('Y') }} Abdelbari Guenichi. All rights reserved.</p>
    </footer>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div id="loginError" class="text-danger" style="display: none;"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="loginForm" class="btn btn-primary" id="submitLogin">Login</button>
                    </div>
                </div>
            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
