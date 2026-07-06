<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity | Catalogue</title>
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
        .nav-links { display: flex; gap: 40px; font-size: .95rem; letter-spacing: 1px; }
        .nav-links a { position: relative; transition: .3s ease; }
        .nav-links a::after {
            content: ''; position: absolute; left: 0; bottom: -5px; width: 0; height: 1px;
            background: #1f1f1f; transition: .3s ease;
        }
        .nav-links a:hover::after { width: 100%; }
        .auth-buttons { display: flex; gap: 16px; }
        .btn {
            padding: 12px 26px; border-radius: 999px; border: 1px solid #1f1f1f;
            transition: .3s ease; font-size: .9rem; letter-spacing: 1px; display: inline-block;
        }
        .btn:hover, .btn-filled { background: #1f1f1f; color: #fff; }
        .hero {
            padding: 90px 8% 50px; display: grid; grid-template-columns: 1.2fr 1fr;
            gap: 50px; align-items: center;
        }
        .hero h1 { font-family: 'Cormorant Garamond', serif; font-size: 4.8rem; line-height: 1; margin-bottom: 20px; }
        .hero p { color: #666; line-height: 1.9; max-width: 550px; }
        .hero img { width: 100%; height: 500px; object-fit: cover; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,.08); }
        .filters { padding: 0 8% 32px; display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
        .search, select {
            padding: 16px 22px; border: 1px solid #ebe5db; border-radius: 999px; background: #fff;
            box-shadow: 0 6px 20px rgba(0,0,0,.05);
        }
        .search { flex: 1; min-width: 240px; padding: 16px 24px; }
        .search:focus { outline: none; border-color: #1f1f1f; }
        .search-submit, .search-clear { min-height: 50px; padding: 0 22px; border-radius: 999px; font-size: .85rem; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: .2s ease; white-space: nowrap; }
        .search-submit { border: 1px solid #1f1f1f; background: #1f1f1f; color: #fff; }
        .search-clear { border: 1px solid #ebe5db; background: #fff; color: #555; }
        .search-submit:hover, .search-clear:hover { background: #c5a880; border-color: #c5a880; color: #1f1f1f; }
        select { cursor: pointer; }
        .tabs { padding: 0 8%; display: flex; gap: 15px; margin-bottom: 22px; flex-wrap: wrap; }
        .tab { padding: 12px 24px; border-radius: 999px; background: #ebe5db; color: #555; }
        .tab.active { background: #1f1f1f; color: #fff; }
        .season-note { padding: 0 8% 30px; color: #666; }
        .result-summary { padding: 0 8% 28px; color: #777; font-size: .9rem; }
        .grid { max-width: 1400px; margin: 0 auto; padding: 0 8% 40px; display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 40px 30px; }
        .card { background: #fff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 35px rgba(0,0,0,.04); transition: .4s; min-width: 0; height: 100%; display: flex; flex-direction: column; }
        .card:hover { transform: translateY(-10px); }
        .card img { display: block; width: 100%; height: 340px; object-fit: contain; transition: .5s; background: #fff; }
        .card:hover img { transform: scale(1.05); }
        .info { padding: 28px; display: flex; flex-direction: column; flex-grow: 1; }
        .brand { min-height: 42px; font-size: .85rem; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; }
        .title { min-height: 76px; font-family: 'Cormorant Garamond', serif; font-size: 2rem; line-height: 1.15; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .notes { height: 86px; overflow: hidden; color: #666; line-height: 1.8; margin-bottom: 20px; }
        .card-actions { margin-top: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; border-top: 1px solid #f5f5f5; padding-top: 16px; }
        .library-form { margin: 0; }
        .action-btn, .add-library {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 999px;
            border: 1px solid #1f1f1f;
            padding: 10px 14px;
            font-size: .82rem;
            font-weight: 600;
            line-height: 1.2;
            cursor: pointer;
            transition: .2s ease;
        }
        .action-btn { background: #fff; color: #1f1f1f; }
        .add-library { width: 100%; background: #1f1f1f; color: #fff; }
        .action-btn:hover, .add-library:hover { background: #c5a880; border-color: #c5a880; color: #1f1f1f; }
        .pagination-wrap { max-width: 1400px; margin: 0 auto 100px auto; padding: 0 8%; display: flex; justify-content: center; align-items: center; gap: 10px; flex-wrap: wrap; }
        .page-link, .page-current, .page-disabled {
            min-width: 42px;
            height: 42px;
            padding: 0 14px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            border: 1px solid #ebe5db;
            background: #fff;
            color: #555;
        }
        .page-link { transition: .2s ease; }
        .page-link:hover { border-color: #1f1f1f; color: #1f1f1f; }
        .page-current { background: #1f1f1f; color: #fff; border-color: #1f1f1f; }
        .page-disabled { color: #b8b0a6; background: #f2eee8; }
        @media(max-width:1200px) {
            .grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }
        @media(max-width:900px) {
            nav { flex-direction: column; gap: 20px; }
            .hero { grid-template-columns: 1fr; }
            .hero h1 { font-size: 3.5rem; }
            .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media(max-width:640px) {
            .grid { grid-template-columns: 1fr; }
            .brand, .title, .notes { min-height: 0; height: auto; }
            .filters { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">SCENITY</div>
        <div class="nav-links">
            <a href="{{ route('index') }}">Home</a>
            <a href="{{ route('catalogue') }}">Catalogue</a>
            <a href="{{ route('about') }}">About Us</a>
        </div>
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn">Login</a>
        </div>
    </nav>

    <section class="hero">
        <div>
            <h1>Explore The Art of Fragrance</h1>
            <p>Discover curated scents crafted for different moods, personalities, and occasions. Browse luxury fragrances and uncover your signature scent through a refined editorial experience.</p>
        </div>
        <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?q=80&w=1974&auto=format&fit=crop" alt="Perfume">
    </section>

    <form class="filters" action="{{ route('catalogue') }}" method="GET">
        <input class="search" type="search" name="search" value="{{ $search }}" placeholder="Search by perfume, brand, notes, family...">
        <button class="search-submit" type="submit">Search</button>
        @if($search !== '')
            <a class="search-clear" href="{{ route('catalogue') }}">Clear</a>
        @endif
    </form>

    <p class="season-note">Showing the complete fragrance catalogue.</p>

    @if($search !== '')
        <p class="result-summary">
            Showing {{ $perfumes->total() }} result{{ $perfumes->total() === 1 ? '' : 's' }} for "{{ $search }}".
        </p>
    @endif

    <section class="grid">
        @forelse($perfumes as $perfume)
            <div class="card">
                <img src="{{ $perfume->image_url ?? 'images/default-perfume.jpg' }}" alt="{{ $perfume->name }}">
                <div class="info">
                    <div class="brand">{{ $perfume->brand }}</div>
                    <div class="title">{{ $perfume->name }}</div>
                    <div class="notes">{{ $perfume->scent_family }} | {{ $perfume->top_notes }}</div>
                    <div class="card-actions">
                        <a class="action-btn" href="{{ route('fdetails', $perfume) }}">View Details</a>
                        <form class="library-form" action="{{ route('library.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="perfume_id" value="{{ $perfume->perfume_id }}">
                            <button type="submit" class="add-library">Add to Library</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p style="grid-column: 1/-1; text-align:center; color:#888;">
                {{ $search !== '' ? 'No fragrances match your search.' : 'No fragrances have been added to the catalogue yet.' }}
            </p>
        @endforelse
    </section>

    @if($perfumes->hasPages())
        <nav class="pagination-wrap" aria-label="Catalogue pagination">
            @if($perfumes->onFirstPage())
                <span class="page-disabled">Previous</span>
            @else
                <a class="page-link" href="{{ $perfumes->previousPageUrl() }}">Previous</a>
            @endif

            @foreach($perfumes->getUrlRange(1, $perfumes->lastPage()) as $page => $url)
                @if($page === $perfumes->currentPage())
                    <span class="page-current">{{ $page }}</span>
                @else
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($perfumes->hasMorePages())
                <a class="page-link" href="{{ $perfumes->nextPageUrl() }}">Next</a>
            @else
                <span class="page-disabled">Next</span>
            @endif
        </nav>
    @endif
</body>
</html>
