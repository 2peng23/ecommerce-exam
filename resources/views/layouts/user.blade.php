<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- fa --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">Rio<span class="font-weight-bolder"
                    style="color: rgb(255, 85, 0)">Shop</span> <i class="fa fa-shopping-bag"></i> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                </ul>
                <div>
                    @if (Auth::user() && $cartCount)
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('view-cart', Auth::user()->id) }}" class="mx-5 text-decoration-none p-3"
                                style="position:relative; color: orangered;">
                                <i class="fa fa-shopping-cart"></i> Cart
                                <p style="position: absolute; top:5px; right:0;">{{ $cartCount }}</p>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="border p-2 rounded bg-secondary text-white text-decoration-none"
                                    href="#" data-toggle="modal" data-target="#logoutModal"
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </form>
                        </div>
                    @else
                        <a href="{{ url('login') }}" class="btn btn-warning text-secondary">Login</a>
                        <a href="{{ url('register') }}" class="btn btn-warning text-secondary">Register</a>
                    @endif

                </div>
            </div>
        </div>
    </nav>
    <div class="container">

        @yield('content')
    </div>
</body>

</html>
