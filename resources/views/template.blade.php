<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> E-shop </title>
        <link href="/css/bootstrap.css" rel="stylesheet" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @stack("styles")
        <style>
        </style>
    </head>
    <body class="antialiased">
            @include("partials.sidebar")
            <div class="max-w-6xl container mx-auto sm:px-6 lg:px-8" id="main-container">
                @yield("main")
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack("scripts")
    </body>
</html>
