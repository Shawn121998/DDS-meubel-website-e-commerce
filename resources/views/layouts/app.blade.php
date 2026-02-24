<!DOCTYPE html>
<html>
<head>
    <title>DDS Meubel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">DDS Meubel</a>
        <div>
            <a href="/products" class="btn btn-outline-light me-2">Produk</a>
            <a href="/cart" class="btn btn-warning">Keranjang</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>