<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-light bg-light mb-4 p-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Ecommerce Cart</a>

        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>
