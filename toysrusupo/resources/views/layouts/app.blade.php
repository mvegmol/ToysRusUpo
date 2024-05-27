<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToysRusUpo</title>


    {{-- @vite(['resources/js/app.js', 'resources/css/app.scss']) --}}
    @vite('resources/css/app.css', 'resources/css/style.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-screen flex flex-col">

    <header>
        @include('partials.navbar')
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="w-full pb-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">

                <ul
                    class="text-lg flex items-center justify-center flex-col gap-7 md:flex-row md:gap-12 transition-all duration-500 py-16 mb-10 border-b border-gray-200">
                    <li><a href="#" class="text-gray-800 hover:text-gray-900">Pagedone</a></li>
                    <li><a href="#" class=" text-gray-800 hover:text-gray-900">Products</a></li>
                    <li><a href="#" class=" text-gray-800 hover:text-gray-900">Resources</a></li>
                    <li><a href="#" class=" text-gray-800 hover:text-gray-900">Blogs</a></li>
                    <li><a href="#" class=" text-gray-800 hover:text-gray-900">Support</a></li>
                </ul>

                <span class="text-lg text-gray-500 text-center block">©<a href="https://pagedone.io/">ToysRus UPO</a>
                    2024, All rights reserved.</span>
            </div>
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
