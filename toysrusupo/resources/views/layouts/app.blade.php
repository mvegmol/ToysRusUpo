<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToysRusUpo</title>
    @vite('resources/css/app.css', 'resources/css/style.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-screen flex flex-col">

    <header>
        @include('partials.navbar')
    </header>

    <main class="flex-grow pt-24">
        @yield('content')
    </main>

    <footer>
        @include('partials.footer')
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
