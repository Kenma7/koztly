<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/landing/navbar/navbar.css') }}">
    <title>Document</title>
</head>
<body>
     <!-- Navigation -->
        <nav class="navbar" id="navbar">
            <div class="logo-container">
                <img src="images/logo.png" alt="Koztly Logo" class="logo">
            </div>

            <div class="nav-menu">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#testimoni">Testimoni</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </div>

            <div class="auth-buttons">
                <a href="/login" class="btn btn-glass">Masuk</a>
                <a href="/register" class="btn btn-glass">Daftar</a>
            </div>
        </nav>
        <script src="{{ asset('js/landing/navbar/navbar.js') }}"></script>

</body>
</html>