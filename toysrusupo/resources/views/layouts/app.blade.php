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
    <main>
        <div class="container">
            <div class="row align-items-start mt-5 position-ref full-height">
                @yield('content')
            </div>    
        </div>
    </main>    
</body>
</html>