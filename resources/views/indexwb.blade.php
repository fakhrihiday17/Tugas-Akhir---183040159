<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Buku Novel</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5/10/0/css/all.css">
    <link rel="stylesheet" href="node_modules/swiper/swiper-bundle.min.css" />
    <script src="node_modules/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Document</title>
</head>

<body style="background-image: url(/gambar/bg.svg);">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Novel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item left">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/novel" class="nav-link">Data Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link">Data User</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin" class="nav-link">Data Admin</a>
                    </li>
                </ul>
                <form class="d-flex mx-2" role="search">
                    <input class="form-control me-2 mx-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
                @if (Auth::check())
                <a href="{{ route('novel.favorit') }}" class="btn btn-outline-warning">Daftar Buku Favorit</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger mx-2">Logout</button>
                </form>
                @else
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                <a href="{{ route('login') }}" class="btn btn btn-outline-success mx-2">Login</a>
                @endif
            </div>
        </div>
    </nav>
    @yield('isihalamanawal')

    </div>
</body>

</html>