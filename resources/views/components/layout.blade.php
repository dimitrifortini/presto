<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presto.it</title>

    {{-- Google FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Manrope:wght@200..800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100 ">


    <x-navbar />

    <main class="flex-grow-1">
        {{ $slot }}

    </main>


    <x-footer />
    {{-- Fontawesome --}}
    <script src="https://kit.fontawesome.com/7c80ed7f5d.js" crossorigin="anonymous"></script>
</body>

</html>
