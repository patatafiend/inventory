<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/js/categoryTree.js')
    @vite('resources/js/ajax/category.js')
    @vite('resources/js/ajax/unit.js')
    @vite('resources/js/ajax/user.js')
    <style>
        body {
            padding-top: 60px; /* Adjust based on navbar height */
            background-color: white !important; /* Ensure background is white */
        }
    </style>
</head>
<body>
    <header>
        @if(!request()->is('login') && !request()->is('register'))
            @include('products.partials.header')
        @endif
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
