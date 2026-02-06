<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wheely Good Cars</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand" href="{{ route('home') }}">🚗 Wheely Good Cars</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            @guest
                <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-primary me-2">Inloggen</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-outline-primary">Registreren</a></li>
                <li class="nav-item"><a href="{{ route('public.cars.other') }}" class="btn btn-secondary me-2">Andere auto's</a></li>

            @endguest
            @auth
                <li class="nav-item"><a href="{{ route('cars.index') }}" class="btn btn-success me-2">Mijn auto's</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button type="submit" class="btn btn-danger">Uitloggen</button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container mt-5">
    @yield('content')
</div>
</body>
</html>
