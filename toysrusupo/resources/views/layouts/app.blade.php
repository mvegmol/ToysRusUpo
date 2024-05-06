<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToysRusUpo</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">ToysRus UPO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @if (Auth::check() && Auth::user()->isAdmin())
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Juguetes</a>

                            </li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page"
                                    href="{{ route('categories.index') }}">Categorias</a>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Pedidos</a>
                            </li>

                        </ul>
                    @else
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Juguetes</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('products.index') }}">Todos los
                                            productos</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="#!">Juguetes más vendidos</a></li>
                                    <li><a class="dropdown-item" href="#!">Juguetes más seguidos</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page"
                                    href="{{ route('categories.index') }}">Categorias</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Pedidos</a>
                            </li>

                        </ul>
                    @endif
                    @if ((Auth::check() && !Auth::user()->isAdmin()) || !Auth::check())
                        <form class="d-flex">
                            <button class="btn btn-outline-dark" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Cart
                                <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                            </button>
                        </form>
                    @endif
                    <!-- Authentication Links -->
                    @guest
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    <footer class="py-5 fixed-bottom">
        <div class="container">
            <p class="m-0 text-center">Copyright &copy; Toysrusupo 2023</p>
        </div>
    </footer>

</body>


</html>
