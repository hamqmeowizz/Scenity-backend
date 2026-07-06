<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Scenity')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8f5f0; color: #1f1f1f; }
        a { text-decoration: none; color: inherit; }
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 28px 8%; background: rgba(248, 245, 240, .92);
            backdrop-filter: blur(10px); position: sticky; top: 0; z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,.05);
        }
        .logo { font-family: 'Cormorant Garamond', serif; font-size: 2rem; letter-spacing: 8px; }
        .nav-links { display: flex; gap: 40px; font-size: .95rem; letter-spacing: 1px; align-items: center; }
        .nav-links a { position: relative; transition: .3s ease; }
        .nav-links a::after {
            content: ''; position: absolute; left: 0; bottom: -5px; width: 0; height: 1px;
            background: #1f1f1f; transition: .3s ease;
        }
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }
        .btn {
            padding: 12px 26px; border-radius: 999px; border: 1px solid #1f1f1f;
            transition: .3s ease; font-size: .9rem; letter-spacing: 1px; display: inline-block;
        }
        .btn:hover, .btn-filled { background: #1f1f1f; color: #fff; }
        @media(max-width: 900px) {
            nav { flex-direction: column; gap: 20px; }
            .nav-links { gap: 20px; flex-wrap: wrap; justify-content: center; }
        }
        @yield('styles')
    </style>
</head>
<body>
    <nav>
        <div class="logo">SCENITY</div>
        <div class="nav-links">
            <a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Home</a>
            <a href="{{ Auth::check() ? route('user.catalogue') : route('catalogue') }}" class="{{ request()->routeIs('catalogue') || request()->routeIs('user.catalogue') ? 'active' : '' }}">Catalogue</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            @auth
                <a href="{{ route('library') }}" class="{{ request()->routeIs('library') ? 'active' : '' }}">My Shelf</a>
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @endauth
        </div>
        <div>
            @auth
                <a href="{{ route('profile') }}" class="btn">{{ Auth::user()->name }}</a>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
            @endauth
        </div>
    </nav>

    @yield('content')
</body>
</html>
