<div class='border-b px-20 bg-secondary font-sans min-h-[60px] relative tracking-wide z-50 shadow-primary'>
    <div class='flex flex-wrap items-center max-lg:gap-y-6 max-sm:gap-x-4'>
        <a href="javascript:void(0)"><img src="{{ asset('images/icons/toysrusupo.png') }}" alt="logo" class='w-28' />
        </a>
        @if (Auth::check() && Auth::user()->isAdmin())
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Juguetes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('categories.index') }}">Categorías</a>
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
                    class='lg:flex lg:gap-x-10 lg:absolute lg:left-1/2 lg:-translate-x-1/2 max-lg:space-y-3 max-lg:fixed max-lg:bg-secondary max-lg:w-2/3 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:px-10 max-lg:py-4 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
                    <li class='mb-6 hidden max-lg:block'>
                        <a href="javascript:void(0)"><img src="{{ asset('images/icons/toysrusupo.png') }}"
                                alt="logo" class='w-36' />
                        </a>
                    </li>
                    <li class='max-lg:border-b max-lg:py-3'><a href="{{ route('welcome.index') }}"
                            class='hover:text-primary text-lg text-primary block font-bold'>Home</a></li>

                    <li class="group max-lg:border-b max-lg:py-3 relative">
                        <button id="toysDropdownButton"
                            class="text-gray-600 font-bold text-lg hover:text-primary focus:outline-none block">
                            @lang('messages.toys')
                            <svg class="w-4 h-4 inline ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="toysDropdownMenu" class="absolute hidden bg-secondary shadow-lg rounded-lg mt-2 w-44">
                            <li class="border-b border-gray-200">
                                <a href="{{ route('products.toys') }}"
                                    class="hover:bg-secondary-hover hover:text-primary text-gray-600 font-bold text-lg block px-4 py-2">
                                    @lang('messages.bestseller')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('products.toys') }}"
                                    class="hover:bg-secondary-hover hover:text-primary text-gray-600 font-bold text-lg block px-4 py-2">
                                    @lang('messages.morefollows')
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='group max-lg:border-b max-lg:py-3 relative'>
                        <a href="{{ route('categories.index') }}"
                            class='hover:text-primary text-gray-600 font-bold text-lg lg:hover:fill-primary block'>
                            @lang('messages.categories')
                        </a>
                    </li>
                    <li class='max-lg:border-b max-lg:py-3'><a href="{{ route('orders.index') }}"
                            class='hover:text-primary text-gray-600 font-bold text-lg block'>@lang('messages.orders')</a>
                    </li>

                    <li class='max-lg:border-b max-lg:py-3'><a href='#Contacto'
                            class='hover:text-primary text-gray-600 font-bold text-lg block'>@lang('messages.contact')</a>
                    </li>

                </ul>
            </div>

            <div class='flex items-center mr-10 ml-auto space-x-8'>
                {{-- Login --}}
                <span class="relative">
                    @guest
                        <li class="group max-lg:border-b max-lg:py-3 relative list-none">
                            <button id="userDropdownButton"
                                class="text-gray-600 font-bold text-lg hover:text-primary focus:outline-none block flex items-center">
                                @lang('messages.user')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-8 inline ml-2 align-middle">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <ul id="userDropdownMenu" class="absolute hidden bg-secondary shadow-lg rounded-lg mt-2 w-22">
                                <li class="border-b border-gray-200">
                                    <a class="hover:bg-secondary-hover hover:text-primary text-gray-600 font-bold text-lg block px-2 py-2"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="border-b border-gray-200">
                                    <a class="hover:bg-secondary-hover hover:text-primary text-gray-600 font-bold text-lg block px-2 py-2"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="group max-lg:border-b max-lg:py-3 relative list-none">
                            <button id="logoutDropdownButton"
                                class="text-gray-600 font-bold text-lg hover:text-primary focus:outline-none block flex items-center">
                                {{ Auth::user()->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-8 inline ml-2 align-middle">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>

                            <ul id="logoutDropdownMenu" class="absolute hidden bg-secondary shadow-lg rounded-lg mt-2 w-44">
                                <li class="border-b border-gray-200">
                                    <a href="{{ route('clients.profile') }}"
                                        class="hover:bg-secondary-hover hover:text-primary text-gray-600 font-bold text-lg block px-4 py-2">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="hover:bg-secondary-hover hover:text-primary text-gray-600 font-bold text-lg block px-4 py-2">
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

                <span class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#4A5568" class="size-8 cursor-pointer hover:stroke-primary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>

                    <span class="absolute left-auto -ml-1 -top-1 rounded-full bg-primary px-1 py-0 text-xs text-white">
                        @if (Auth::check() && Auth::user()->favouriteProducts())
                            {{ Auth::user()->favoriteQuantity() }}
                        @else
                            0
                        @endif
                    </span>
                </span>
                <a href="{{ Auth::check() ? route('carts.show_products') : route('login') }}">
                    <span class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="#4A5568" class="size-8 cursor-pointer hover:stroke-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span
                            class="absolute left-auto -ml-1 -top-1 rounded-full bg-primary px-1 py-0 text-xs text-white">
                            @if (Auth::check() && Auth::user()->shoppingCart())
                                {{ Auth::user()->cartQuantity() }}
                            @else
                                0
                            @endif
                        </span>
                    </span>
                </a>

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
</div>
