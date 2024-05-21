<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToysRusUpo</title>
    {{-- @vite(['resources/js/app.js', 'resources/css/app.scss']) --}}
    @vite('resources/css/app.css', 'resources/css/style.css')
</head>

<body>

    <header class='border-b bg-white font-sans min-h-[60px] px-10 py-3 relative tracking-wide relative z-50'>
        <div class='flex flex-wrap items-center max-lg:gap-y-6 max-sm:gap-x-4'>
            <a href="javascript:void(0)"><img src="imagen" alt="logo" class='w-36' />
            </a>
            @if (Auth::check() && Auth::user()->isAdmin())
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Juguetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('categories.index') }}">Categorias</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">Pedidos</a>
                    </li>
                </ul>
            @else
                <div id="collapseMenu"
                    class="max-lg:hidden lg:!flex lg:items-center max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-40 max-lg:before:inset-0 max-lg:before:z-50">
                    <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-black" viewBox="0 0 320.591 320.591">
                            <path
                                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                data-original="#000000"></path>
                            <path
                                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                data-original="#000000"></path>
                        </svg>
                    </button>

                    <ul
                        class='lg:flex lg:gap-x-10 lg:absolute lg:left-1/2 lg:-translate-x-1/2 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-2/3 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:px-10 max-lg:py-4 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
                        <li class='mb-6 hidden max-lg:block'>
                            <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui.svg"
                                    alt="logo" class='w-36' />
                            </a>
                        </li>
                        <li class='max-lg:border-b max-lg:py-3'><a href='javascript:void(0)'
                                class='hover:text-primary text-[17px] text-primary block font-bold'>Home</a></li>

                        <li class="group max-lg:border-b max-lg:py-3 relative">
                            <button id="toysDropdownButton"
                                class="text-gray-600 font-bold text-[17px] hover:text-primary focus:outline-none block">
                                Toys
                                <svg class="w-4 h-4 inline ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="toysDropdownMenu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-44">
                                <li class="border-b border-gray-200">
                                    <a href="{{ route('categories.index') }}"
                                        class="hover:bg-gray-100 text-gray-600 font-bold text-[17px] block px-4 py-2">
                                        Bestseller
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('categories.index') }}"
                                        class="hover:bg-gray-100 text-gray-600 font-bold text-[17px] block px-4 py-2">
                                        More Follows
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class='group max-lg:border-b max-lg:py-3 relative'>
                            <a href="{{ route('products.index') }}"
                                class='hover:text-primary text-gray-600 font-bold text-[17px] lg:hover:fill-primary block'>
                                Categories
                            </a>
                        </li>
                        <li class='max-lg:border-b max-lg:py-3'><a href="{{ route('orders.index') }}"
                                class='hover:text-primary text-gray-600 font-bold text-[17px] block'>Orders</a></li>

                        <li class='max-lg:border-b max-lg:py-3'><a href='#Contacto'
                                class='hover:text-primary text-gray-600 font-bold text-[17px] block'>Contact</a></li>

                    </ul>
                </div>

                <div class='flex items-center mr-10 ml-auto space-x-8'>
                    <span class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25px"
                            class="cursor-pointer fill-[#000] hover:fill-primary inline-block" viewBox="0 0 64 64">
                            <path
                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                data-original="#000000" />
                        </svg>
                        <span
                            class="absolute left-auto -ml-1 -top-1 rounded-full bg-red-500 px-1 py-0 text-xs text-white">0</span>
                    </span>
                    <a href="{{ route('carts.show_products') }}">
                        <span class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px"
                                class="cursor-pointer fill-[#000] hover:fill-primary inline-block"
                                viewBox="0 0 512 512">
                                <path
                                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                                    data-original="#000000"></path>
                            </svg>
                            <span
                                class="absolute left-auto -ml-1 -top-1 rounded-full bg-red-500 px-1 py-0 text-xs text-white">
                                @if (Auth::check() && Auth::user()->shoppingCart())
                                    {{ Auth::user()->cartQuantity() }}
                                @else
                                    0
                                @endif
                            </span>
                        </span>
                    </a>


                    {{-- Login --}}
                    <span class="relative">
                        @guest

                            <li class="group max-lg:border-b max-lg:py-3 relative list-none">
                                <button id="userDropdownButton"
                                    class="text-gray-600 font-bold text-[17px] hover:text-primary focus:outline-none block">

                                    User
                                    <svg class="w-4 h-4 inline ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <ul id="userDropdownMenu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-22">
                                    <li class="border-b border-gray-200">
                                        <a class="hover:bg-gray-100 text-gray-600 font-bold text-[17px] block px-2 py-2"
                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </a>
                                    </li>
                                    <li class="border-b border-gray-200">
                                        <a class="hover:bg-gray-100 text-gray-600 font-bold text-[17px] block px-2 py-2"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="group max-lg:border-b max-lg:py-3 relative list-none">
                                <button id="logoutDropdownButton"
                                    class="text-gray-600 font-bold text-[17px] hover:text-primary focus:outline-none block">
                                    {{ Auth::user()->name }}
                                    <svg class="w-4 h-4 inline ml-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <ul id="logoutDropdownMenu"
                                    class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-44">
                                    <li class="border-b border-gray-200">
                                        <a href="{{ route('categories.index') }}"
                                            class="hover:bg-gray-100 text-gray-600 font-bold text-[17px] block px-4 py-2">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="hover:bg-gray-100 text-gray-600 font-bold text-[17px] block px-4 py-2">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endguest

                    </span>

                    {{-- Toggle Open --}}
                    <button id="toggleOpen" class='lg:hidden'>
                        <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif
        </div>



        <div
            class="bg-gray-100 border border-transparent focus-within:border-blue-500 focus-within:bg-transparent flex px-6 rounded-full h-10 lg:w-2/4 mt-3 mx-auto max-lg:mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                class="fill-gray-600 mr-3 rotate-90">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
            <input type='email' placeholder='Search...'
                class="w-full outline-none bg-transparent text-gray-600 font-semibold text-[17px]" />
        </div>

    </header>



    <main>
        @yield('content')
    </main>
    <footer class="py-5 ">
        <div class="container">
            <p class="m-0 text-center">Copyright &copy; Toysrusupo 2023</p>
        </div>
    </footer>
    <script>
        var toggleOpen = document.getElementById("toggleOpen");
        var toggleClose = document.getElementById("toggleClose");
        var collapseMenu = document.getElementById("collapseMenu");

        function handleClick() {
            if (collapseMenu.style.display === "block") {
                collapseMenu.style.display = "none";
            } else {
                collapseMenu.style.display = "block";
            }
        }

        toggleOpen.addEventListener("click", handleClick);
        toggleClose.addEventListener("click", handleClick);
    </script>
    @vite('resources/js/dropdown.js', 'resources/js/collapse.js')
</body>


</html>
