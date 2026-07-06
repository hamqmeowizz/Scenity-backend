<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity | My Shelf</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f5f0;
            color: #1f1f1f;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Navigation Bar */
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

        /* Library Workspace Header */
        .shelf-container {
            padding: 60px 8% 100px;
        }
        .shelf-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding-bottom: 25px;
        }
        .shelf-title h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.5rem;
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 6px;
        }
        .shelf-title p {
            color: #777;
            font-size: 0.95rem;
        }

        /* Interactive Sorting Tabs Control */
        .shelf-filters {
            display: flex;
            gap: 10px;
        }
        .filter-tab {
            padding: 10px 22px;
            border-radius: 999px;
            border: 1px solid #ebe5db;
            background: #fff;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.3s;
            color: #555;
        }
        .filter-tab:hover {
            border-color: #1f1f1f;
        }
        .filter-tab.active {
            background: #1f1f1f;
            color: #fff;
            border-color: #1f1f1f;
        }

        /* Grid Framework for Displaying Shelf Bottles */
        .shelf-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 40px 30px;
        }
        .bottle-card {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,.02);
            border: 1px solid rgba(0,0,0,0.02);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
        }
        .bottle-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 40px rgba(0,0,0,.05);
        }
        
        /* Image presentation layout */
        .image-wrapper {
            height: 340px;
            background: #fff;
            overflow: hidden;
            position: relative;
        }
        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }
        .bottle-card:hover .image-wrapper img {
            transform: scale(1.02);
        }

        /* Dynamic Attribute Badges on Card overlay */
        .weather-tag {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: rgba(248, 245, 240, 0.85);
            backdrop-filter: blur(4px);
            color: #1f1f1f;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 500;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .remove-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.1rem;
            color: #888;
            transition: 0.2s;
            opacity: 0;
        }
        .bottle-card:hover .remove-btn {
            opacity: 1;
        }
        .remove-btn:hover {
            color: #1f1f1f;
            background: #fff;
        }

        /* Details Content Area inside Card */
        .bottle-details {
            padding: 24px;
        }
        .bottle-brand {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #888;
            margin-bottom: 4px;
        }
        .bottle-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            line-height: 1.2;
            margin-bottom: 6px;
        }

        /* Personalized Fragrance Star Rating System */
        .personal-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 14px;
        }
        .star {
            font-size: 1.2rem;
            color: #ebe5db;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .star.active {
            color: #c5a880; /* Elegant soft gold luxury tone */
        }

        .bottle-meta {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.85rem;
            color: #666;
            border-top: 1px solid rgba(0,0,0,0.04);
            padding-top: 12px;
        }
        .bottle-meta span:last-child {
            text-align: right;
        }
        .empty-shelf {
            grid-column: 1 / -1;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.03);
            border-radius: 24px;
            padding: 45px;
            text-align: center;
            color: #777;
            box-shadow: 0 10px 30px rgba(0,0,0,.02);
        }
        .empty-shelf a {
            display: inline-block;
            margin-top: 18px;
            border-bottom: 1px solid #1f1f1f;
            color: #1f1f1f;
            padding-bottom: 4px;
        }
        .notice {
            margin-bottom: 24px;
            padding: 14px 18px;
            border-radius: 14px;
            background: #e8f3ea;
            color: #245b31;
            border: 1px solid rgba(36, 91, 49, 0.08);
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
            transform: scale(1.05); /* Subtle zoom on hover */
            opacity: 0.85;          /* Slight fade luxury effect */
        }

        /* Responsive Formatting */
        @media(max-width: 900px) {
            .shelf-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            .shelf-title h1 {
                font-size: 2.8rem;
            }
            .remove-btn {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">SCENITY</div>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('user.catalogue') }}">Catalogue</a>
            <a href="{{ route('recommendations') }}">Scent Curator</a>
            <a href="{{ route('library') }}" class="active">My Fragrances</a>
            
            <div class="user-profile">
                <a href="{{ route('profile') }}" class="avatar-link" title="Manage Profile">
                    <span>{{ auth()->user()->name }}</span>
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                </a>
            </div>
        </div>
    </nav>

    <main class="shelf-container">
        
        <header class="shelf-header">
            <div class="shelf-title">
                <h1>My Fragrances</h1>
                <p>A digitized overview of your current personal perfume collection.</p>
            </div>
            
            <div class="shelf-filters">
                <button class="filter-tab active" onclick="filterShelf('all', this)">All Layers</button>
                <button class="filter-tab" onclick="filterShelf('high-rated', this)">Highest Rated (4★+)</button>
            </div>
        </header>

        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif

        <div class="shelf-grid">
            @forelse($perfumes as $perfume)
                @php
                    $rating = (int) ($perfume->pivot->rating ?? 0);
                    $weatherType = \Illuminate\Support\Str::contains(strtolower($perfume->weather_suitability), ['summer', 'spring']) ? 'warm' : 'cool';
                @endphp

                <div class="bottle-card" data-weather="{{ $weatherType }}" data-rating="{{ $rating }}">
                    <div class="image-wrapper">
                        <form action="{{ route('library.remove') }}" method="POST" onsubmit="return confirm('Remove {{ addslashes($perfume->name) }} from your library?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="perfume_id" value="{{ $perfume->perfume_id }}">
                            <button type="submit" class="remove-btn" title="Remove from shelf">&times;</button>
                        </form>
                        <img src="{{ $perfume->image_url ?? asset('images/default-perfume.jpg') }}" alt="{{ $perfume->name }}">
                        <span class="weather-tag">Best in: {{ $perfume->weather_suitability }}</span>
                    </div>
                    <div class="bottle-details">
                        <div class="bottle-brand">{{ $perfume->brand }}</div>
                        <h2 class="bottle-title"><a href="{{ route('fdetails', $perfume) }}">{{ $perfume->name }}</a></h2>
                        
                        <div class="personal-rating" data-stars="{{ $rating }}" data-perfume-id="{{ $perfume->perfume_id }}">
                            @for($star = 1; $star <= 5; $star++)
                                <span class="star {{ $star <= $rating ? 'active' : '' }}" data-value="{{ $star }}">&#9733;</span>
                            @endfor
                        </div>

                        <div class="bottle-meta">
                            <span>{{ $perfume->scent_family }}</span>
                            <span>{{ ucfirst($perfume->longevity) }} longevity</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-shelf">
                    <p>Your shelf is empty for now.</p>
                    <a href="{{ route('user.catalogue') }}">Browse the catalogue</a>
                </div>
            @endforelse

            @if(false)
            <div class="bottle-card" data-weather="cool" data-rating="5">
                <div class="image-wrapper">
                    <button class="remove-btn" title="Remove from shelf">&times;</button>
                    <img src="https://fimgs.net/mdimg/perfume/o.46066.jpg" alt="Baccarat Rouge 540">
                    <span class="weather-tag">Best in: Crisp & Sunny</span>
                </div>
                <div class="bottle-details">
                    <div class="bottle-brand">Maison Francis Kurkdjian</div>
                    <h2 class="bottle-title"><a href="{{ route('fdetails') }}">Baccarat Rouge 540</a></h2>
                    
                    <div class="personal-rating" data-stars="5">
                        <span class="star active" data-value="1">★</span>
                        <span class="star active" data-value="2">★</span>
                        <span class="star active" data-value="3">★</span>
                        <span class="star active" data-value="4">★</span>
                        <span class="star active" data-value="5">★</span>
                    </div>

                    <div class="bottle-meta">
                        <span>Woody / Amber</span>
                        <span>70ml Volume</span>
                    </div>
                </div>
            </div>

            <div class="bottle-card" data-weather="cool" data-rating="4">
                <div class="image-wrapper">
                    <button class="remove-btn" title="Remove from shelf">&times;</button>
                    <img src="https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.1826.avif" alt="Oud Wood">
                    <span class="weather-tag">Best in: Cold / Overcast</span>
                </div>
                <div class="bottle-details">
                    <div class="bottle-brand">Tom Ford</div>
                    <h2 class="bottle-title"><a href="#">Oud Wood</a></h2>
                    
                    <div class="personal-rating" data-stars="4">
                        <span class="star active" data-value="1">★</span>
                        <span class="star active" data-value="2">★</span>
                        <span class="star active" data-value="3">★</span>
                        <span class="star active" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>

                    <div class="bottle-meta">
                        <span>Rich Earthy Wood</span>
                        <span>50ml Volume</span>
                    </div>
                </div>
            </div>

            <div class="bottle-card" data-weather="warm" data-rating="3">
                <div class="image-wrapper">
                    <button class="remove-btn" title="Remove from shelf">&times;</button>
                    <img src="https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.20541.avif" alt="Jazz Club">
                    <span class="weather-tag">Best in: Balmy Evening</span>
                </div>
                <div class="bottle-details">
                    <div class="bottle-brand">Maison Margiela</div>
                    <h2 class="bottle-title"><a href="#">Jazz Club</a></h2>
                    
                    <div class="personal-rating" data-stars="3">
                        <span class="star active" data-value="1">★</span>
                        <span class="star active" data-value="2">★</span>
                        <span class="star active" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>

                    <div class="bottle-meta">
                        <span>Spicy Oriental</span>
                        <span>100ml Volume</span>
                    </div>
                </div>
            </div>

            <div class="bottle-card" data-weather="warm" data-rating="5">
                <div class="image-wrapper">
                    <button class="remove-btn" title="Remove from shelf">&times;</button>
                    <img src="https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.42702.avif" alt="Savoy Steam">
                    <span class="weather-tag">Best in: Hot / Humid</span>
                </div>
                <div class="bottle-details">
                    <div class="bottle-brand">Panhaligon's</div>
                    <h2 class="bottle-title"><a href="#">Savoy Steam</a></h2>
                    
                    <div class="personal-rating" data-stars="5">
                        <span class="star active" data-value="1">★</span>
                        <span class="star active" data-value="2">★</span>
                        <span class="star active" data-value="3">★</span>
                        <span class="star active" data-value="4">★</span>
                        <span class="star active" data-value="5">★</span>
                    </div>

                    <div class="bottle-meta">
                        <span>Fresh Clean</span>
                        <span>100ml Volume</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <script>
        // Complex Filter System Configuration
        function filterShelf(filterType, tabElement) {
            const tabs = document.querySelectorAll('.filter-tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            tabElement.classList.add('active');

            const cards = document.querySelectorAll('.bottle-card');
            cards.forEach(card => {
                const cardWeather = card.getAttribute('data-weather');
                const cardRating = parseInt(card.getAttribute('data-rating')) || 0;

                if (filterType === 'all') {
                    card.style.display = 'block';
                } else if (filterType === 'high-rated') {
                    card.style.display = cardRating >= 4 ? 'block' : 'none';
                } else {
                    card.style.display = cardWeather === filterType ? 'block' : 'none';
                }
            });
        }

        // Live Star Interactive Rating Input Handler
        document.querySelectorAll('.personal-rating .star').forEach(star => {
            star.addEventListener('click', async function() {
                const parentGroup = this.parentElement;
                const chosenRating = parseInt(this.getAttribute('data-value'));
                const previousRating = parseInt(parentGroup.getAttribute('data-stars')) || 0;
                const perfumeId = parentGroup.getAttribute('data-perfume-id');
                const cardElement = this.closest('.bottle-card');
                
                // Set structural attributes
                parentGroup.setAttribute('data-stars', chosenRating);
                cardElement.setAttribute('data-rating', chosenRating);
                
                // Repaint UI Stars
                const siblings = parentGroup.querySelectorAll('.star');
                siblings.forEach(s => {
                    const val = parseInt(s.getAttribute('data-value'));
                    if (val <= chosenRating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });

                try {
                    const response = await fetch('{{ route('library.rate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            perfume_id: perfumeId,
                            rating: chosenRating,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('Rating could not be saved.');
                    }
                } catch (error) {
                    parentGroup.setAttribute('data-stars', previousRating);
                    cardElement.setAttribute('data-rating', previousRating);

                    siblings.forEach(s => {
                        const val = parseInt(s.getAttribute('data-value'));
                        s.classList.toggle('active', val <= previousRating);
                    });

                    alert('The rating could not be saved. Please try again.');
                }
            });
        });
    </script>
</body>
</html>
