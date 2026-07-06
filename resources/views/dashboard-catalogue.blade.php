<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scenity — Member Catalogue</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #f8f5f0; color: #1f1f1f; }
    a { text-decoration: none; color: inherit; }
    
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 24px 8%;
      background: rgba(248, 245, 240, .92);
      backdrop-filter: blur(10px);
      position: sticky;
      top: 0;
      z-index: 1000;
      border-bottom: 1px solid rgba(0,0,0,.05);
    }
    .logo {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      letter-spacing: 8px;
    }
    .nav-links {
      display: flex;
      gap: 35px;
      font-size: 0.9rem;
      letter-spacing: 1px;
      align-items: center;
    }
    .nav-links a {
      position: relative;
      transition: 0.3s ease;
    }
    .nav-links a::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -5px;
      width: 0;
      height: 1px;
      background: #1f1f1f;
      transition: 0.3s ease;
    }
    .nav-links a:hover::after, .nav-links a.active::after {
      width: 100%;
    }
    .user-profile {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 0.9rem;
      letter-spacing: 0.5px;
      padding-left: 20px;
      border-left: 1px solid rgba(0,0,0,0.1);
    }
    .avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      background: #ebe5db;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 500;
      font-size: 0.85rem;
      border: 1px solid rgba(0,0,0,0.05);
      text-transform: uppercase;
    }
    .avatar-link {
      display: flex;
      align-items: center;
      gap: 12px;
      transition: transform 0.2s ease, opacity 0.2s ease;
    }
    .nav-links .avatar-link::after {
      display: none;
    }
    .avatar-link:hover {
      transform: scale(1.05);
      opacity: 0.85;
    }

    .title-section { max-width: 1400px; margin: 60px auto 40px auto; padding: 0 8%; }
    .title-section h1 { font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; font-weight: 500; margin-bottom: 10px; }
    .title-section p { color: #666; font-size: 1.1rem; }
    .catalogue-tools { max-width: 1400px; margin: 0 auto 30px auto; padding: 0 8%; display: flex; gap: 12px; align-items: center; }
    .search-input { flex: 1; min-width: 0; padding: 15px 20px; border: 1px solid #ebe5db; border-radius: 999px; background: #fff; font-family: inherit; font-size: 0.95rem; box-shadow: 0 6px 20px rgba(0,0,0,.03); }
    .search-input:focus { outline: none; border-color: #1f1f1f; }
    .search-submit, .search-clear { min-height: 48px; padding: 0 22px; border-radius: 999px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s ease; white-space: nowrap; }
    .search-submit { border: 1px solid #1f1f1f; background: #1f1f1f; color: #fff; }
    .search-clear { border: 1px solid #ebe5db; background: #fff; color: #555; }
    .search-submit:hover, .search-clear:hover { background: #c5a880; border-color: #c5a880; color: #1f1f1f; }
    .result-summary { max-width: 1400px; margin: -12px auto 28px auto; padding: 0 8%; color: #777; font-size: 0.9rem; }

    .grid { max-width: 1400px; margin: 0 auto 40px auto; padding: 0 8%; display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 40px 30px; }
    .card { background: #fff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: transform 0.3s ease; display: flex; flex-direction: column; min-width: 0; height: 100%; }
    .card:hover { transform: translateY(-5px); }
    
    .card-img { display: block; width: 100%; height: 340px; object-fit: contain; background: #fff; }
    
    .card-body { padding: 25px; display: flex; flex-direction: column; flex-grow: 1; }
    .brand { min-height: 42px; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px; color: #888; margin-bottom: 6px; }
    .name { min-height: 76px; font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; font-weight: 600; margin-bottom: 8px; line-height: 1.2; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .family { display: inline-block; background: #efe9df; padding: 4px 12px; border-radius: 999px; font-size: 0.8rem; font-weight: 500; margin-bottom: 15px; width: fit-content; }
    
    .notes-box { height: 150px; overflow: hidden; background: #fafafa; padding: 15px; border-radius: 14px; margin-bottom: 20px; font-size: 0.88rem; line-height: 1.5; }
    .notes-box strong { color: #555; }

    .card-footer { margin-top: auto; display: grid; gap: 14px; font-size: 0.85rem; color: #666; border-top: 1px solid #f5f5f5; padding-top: 16px; }
    .card-meta { display: flex; justify-content: space-between; gap: 12px; align-items: center; }
    .card-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    
    .action-btn { min-height: 44px; display: inline-flex; align-items: center; justify-content: center; text-align: center; border: 1px solid #1f1f1f; padding: 10px 14px; border-radius: 999px; font-size: 0.82rem; font-weight: 600; line-height: 1.2; cursor:pointer; transition: 0.2s; }
    .action-secondary { background: #fff; color: #1f1f1f; }
    .action-primary { width: 100%; background: #1f1f1f; color: #fff; }
    .action-btn:hover { background: #c5a880; border-color: #c5a880; color: #1f1f1f; }
    .library-form { margin: 0; }
    .notice { max-width: 1200px; margin: 0 auto 24px; padding: 14px 18px; border-radius: 14px; background: #e8f3ea; color: #245b31; }
    .pagination-wrap { max-width: 1400px; margin: 0 auto 100px auto; padding: 0 8%; display: flex; justify-content: center; align-items: center; gap: 10px; flex-wrap: wrap; }
    .page-link, .page-current, .page-disabled {
      min-width: 42px;
      height: 42px;
      padding: 0 14px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      border: 1px solid #ebe5db;
      background: #fff;
      color: #555;
    }
    .page-link { transition: 0.2s ease; }
    .page-link:hover { border-color: #1f1f1f; color: #1f1f1f; }
    .page-current { background: #1f1f1f; color: #fff; border-color: #1f1f1f; }
    .page-disabled { color: #b8b0a6; background: #f2eee8; }
    @media(max-width: 1200px) {
      .grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }
    @media(max-width: 900px) {
      .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media(max-width: 640px) {
      .grid { grid-template-columns: 1fr; }
      .brand, .name, .notes-box { min-height: 0; height: auto; }
      .catalogue-tools { flex-direction: column; align-items: stretch; }
    }
  </style>
</head>
<body>

  <nav>
    <div class="logo">SCENITY</div>

    <div class="nav-links">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('user.catalogue') }}" class="active">Catalogue</a>
      <a href="{{ route('recommendations') }}">Scent Curator</a>
      <a href="{{ route('library') }}">My Fragrances</a>

      <div class="user-profile">
        <a href="{{ route('profile') }}" class="avatar-link" title="Manage Profile">
          <span>{{ auth()->user()->name }}</span>
          <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </a>
      </div>
    </div>
  </nav>

  <div class="title-section">
    <h1>The Fragrance Vault</h1>
    <p>Explore the complete fragrance catalogue, complete with scent families and note breakdowns.</p>
  </div>

  <form class="catalogue-tools" action="{{ route('user.catalogue') }}" method="GET">
    <input class="search-input" type="search" name="search" value="{{ $search }}" placeholder="Search by perfume, brand, notes, family...">
    <button class="search-submit" type="submit">Search</button>
    @if($search !== '')
      <a class="search-clear" href="{{ route('user.catalogue') }}">Clear</a>
    @endif
  </form>

  @if($search !== '')
    <p class="result-summary">
      Showing {{ $perfumes->total() }} result{{ $perfumes->total() === 1 ? '' : 's' }} for "{{ $search }}".
    </p>
  @endif

  @if(session('success'))
    <div class="notice">{{ session('success') }}</div>
  @endif

  <div class="grid">
    @forelse($perfumes as $perfume)
        <div class="card">
            <img class="card-img" src="{{ $perfume->image_url ?? 'images/default-perfume.jpg' }}" alt="{{ $perfume->name }}">
            
            <div class="card-body">
                <div class="brand">{{ $perfume->brand }}</div>
                <div class="name">
                    <a href="{{ route('fdetails', $perfume) }}">{{ $perfume->name }}</a>
                </div>
                <div class="family">{{ $perfume->scent_family }}</div>

                <div class="notes-box">
                    <div><strong>Top:</strong> {{ $perfume->top_notes }}</div>
                    <div><strong>Heart:</strong> {{ $perfume->middle_notes }}</div>
                    <div><strong>Base:</strong> {{ $perfume->base_notes }}</div>
                </div>

                <div class="card-footer">
                    <div class="card-meta">
                        <span>Longevity</span>
                        <strong>{{ ucfirst($perfume->longevity) }}</strong>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('fdetails', $perfume) }}" class="action-btn action-secondary">View Details</a>

                        <form class="library-form" action="{{ route('library.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="perfume_id" value="{{ $perfume->perfume_id }}">
                            <button type="submit" class="action-btn action-primary">Add to Library</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p style="grid-column: 1/-1; text-align: center; color: #888;">
          {{ $search !== '' ? 'No fragrances match your search.' : 'No fragrances have been added to the catalogue yet.' }}
        </p>
    @endforelse
  </div>

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
