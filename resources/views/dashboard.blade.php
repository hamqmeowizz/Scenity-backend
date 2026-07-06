<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity | Dashboard</title>
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

        /* Dashboard Container & Grid Layout */
        .dashboard-wrapper {
            padding: 60px 8% 100px;
        }
        
        /* Welcome Block Header */
        .welcome-header {
            margin-bottom: 50px;
        }
        .welcome-header h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.5rem;
            font-weight: 400;
            line-height: 1.2;
            margin-bottom: 8px;
        }
        .welcome-header p {
            color: #666;
            font-size: 1.05rem;
            letter-spacing: 0.3px;
        }

        /* Quick Metric Stats Matrix */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        .metric-card {
            background: #fff;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,.02);
            border: 1px solid rgba(0,0,0,0.01);
        }
        .metric-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #888;
            margin-bottom: 12px;
        }
        .metric-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 500;
            line-height: 1;
            margin-bottom: 6px;
        }
        .metric-sub {
            font-size: 0.85rem;
            color: #555;
        }
        .metric-link {
            display: inline-block;
            margin-top: 16px;
            font-size: 0.82rem;
            font-weight: 600;
            border-bottom: 1px solid #1f1f1f;
            padding-bottom: 3px;
        }

        /* Two Column Focus Layout */
        .content-split {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 50px;
            align-items: start;
        }

        /* Left Side: Weather recommendation spotlight */
        .weather-recommendation {
            background: #fff;
            border-radius: 30px;
            padding: 45px;
            box-shadow: 0 15px 40px rgba(0,0,0,.03);
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 35px;
            align-items: center;
            margin-bottom: 40px;
        }
        .weather-meta h3 {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888;
            margin-bottom: 10px;
        }
        .weather-status,
        .weather-status-live {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .weather-status {
            display: none;
        }
        .weather-perfume-img {
            width: 100%;
            height: 340px;
            object-fit: contain;
            border-radius: 20px;
            background: #fff;
        }
        .weather-info .brand {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888;
            margin-bottom: 4px;
        }
        .weather-info .title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            line-height: 1.1;
            margin-bottom: 12px;
        }
        .weather-info p {
            color: #666;
            line-height: 1.7;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }
        .btn-inline {
            display: inline-block;
            border-bottom: 1px solid #1f1f1f;
            padding-bottom: 4px;
            font-size: 0.95rem;
        }
        .overview-section {
            background: #fff;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,.03);
        }
        .section-title-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding-bottom: 14px;
            margin-bottom: 24px;
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
        }
        .recent-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }
        .recent-card {
            border: 1px solid #f0ece5;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
        }
        .recent-card img {
            width: 100%;
            height: 170px;
            object-fit: contain;
            background: #fff;
        }
        .recent-info {
            padding: 16px;
        }
        .recent-brand {
            font-size: 0.72rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 4px;
        }
        .recent-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            line-height: 1.15;
            margin-bottom: 8px;
        }
        .recent-meta {
            font-size: 0.8rem;
            color: #666;
        }
        .empty-overview {
            color: #666;
            line-height: 1.8;
            background: #fdfcfb;
            border-radius: 18px;
            padding: 22px;
        }

        /* Right Side: Quick Navigation Actions */
        .action-panel {
            background: #fff;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,.03);
        }
        .panel-headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding-bottom: 12px;
        }
        .profile-summary {
            display: grid;
            gap: 14px;
            margin-bottom: 28px;
        }
        .profile-row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            color: #666;
            font-size: 0.9rem;
        }
        .profile-row strong {
            color: #1f1f1f;
            text-align: right;
        }
        .menu-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            transition: padding-left 0.3s ease;
        }
        .menu-link:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .menu-link:first-of-type {
            padding-top: 0;
        }
        .menu-link:hover {
            padding-left: 8px;
            color: #888;
        }
        .menu-link-title {
            font-weight: 500;
            font-size: 0.95rem;
            margin-bottom: 2px;
            color: #1f1f1f;
        }
        .menu-link-desc {
            font-size: 0.8rem;
            color: #888;
        }
        .arrow {
            font-size: 0;
            color: #1f1f1f;
        }
        .arrow::before {
            content: "\2192";
            font-size: 1.2rem;
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

        /* Responsive Breakpoints */
        @media(max-width: 1024px) {
            .content-split {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .recent-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media(max-width: 650px) {
            .weather-recommendation {
                grid-template-columns: 1fr;
            }
            .welcome-header h1 {
                font-size: 2.8rem;
            }
            .recent-grid {
                grid-template-columns: 1fr;
            }
            .section-title-row {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">SCENITY</div>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('user.catalogue') }}">Catalogue</a>
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

    <div class="dashboard-wrapper">
        
        <header class="welcome-header">
            <h1>Welcome, {{ $user->name }}</h1>
            <p>Here is a quick overview of your profile, shelf activity, and next fragrance actions.</p>
        </header>

        <section class="metrics-grid">
            <div class="metric-card">
                <div class="metric-label">My Scent Shelf</div>
                <div class="metric-value">{{ $libraryCount }}</div>
                <div class="metric-sub">{{ $libraryCount === 1 ? 'Fragrance saved' : 'Fragrances saved' }}</div>
                <a href="{{ route('library') }}" class="metric-link">Open Shelf</a>
            </div>
            <div class="metric-card">
                <div class="metric-label">Rated Fragrances</div>
                <div class="metric-value">{{ $ratedCount }}</div>
                <div class="metric-sub">
                    {{ $averageRating ? 'Average rating: ' . $averageRating . ' / 5' : 'Start rating your shelf' }}
                </div>
                <a href="{{ route('library') }}" class="metric-link">Rate Perfumes</a>
            </div>
            <div class="metric-card">
                <div class="metric-label">Favorite Family</div>
                <div class="metric-value">{{ $favoriteFamily }}</div>
                <div class="metric-sub">Based on your saved collection</div>
                <a href="{{ route('recommendations') }}" class="metric-link">Find Similar</a>
            </div>
            <div class="metric-card">
                <div class="metric-label">Catalogue Size</div>
                <div class="metric-value">{{ $catalogueCount }}</div>
                <div class="metric-sub">Fragrances available to explore</div>
                <a href="{{ route('user.catalogue') }}" class="metric-link">Browse Catalogue</a>
            </div>
        </section>

        <div class="content-split">
            
            <div>
            <section class="weather-recommendation">
                <div>
                    <h3>{{ $libraryCount > 0 ? 'Latest Shelf Addition' : 'Catalogue Spotlight' }}</h3>
                    <div class="weather-status-live">{{ $featuredPerfume?->scent_family ?? 'Explore' }}<br>Profile</div>
                    <div class="weather-status">Crisp &<br>Sunny, 18°C</div>
                    <img src="{{ $featuredPerfume?->image_url ?? asset('images/default-perfume.jpg') }}" alt="{{ $featuredPerfume?->name ?? 'Featured fragrance' }}" class="weather-perfume-img">
                </div>
                <div class="weather-info">
                    <div class="brand">{{ $featuredPerfume?->brand ?? 'Scenity' }}</div>
                    <h2 class="title">{{ $featuredPerfume?->name ?? 'Featured Fragrance' }}</h2>
                    <p>
                        @if($featuredPerfume)
                            A {{ strtolower($featuredPerfume->scent_family) }} profile with {{ strtolower($featuredPerfume->longevity) }} longevity and {{ strtolower($featuredPerfume->sillage) }} sillage, suited for {{ $featuredPerfume->weather_suitability }} conditions.
                        @else
                            Add perfumes to the catalogue to surface a useful fragrance overview here.
                        @endif
                    </p>
                    @if($featuredPerfume)
                        <a href="{{ route('fdetails', $featuredPerfume) }}" class="btn-inline">View Note Structure</a>
                    @else
                        <a href="{{ route('user.catalogue') }}" class="btn-inline">Browse Catalogue</a>
                    @endif
                </div>
            </section>
            <section class="overview-section">
                <div class="section-title-row">
                    <h3 class="section-title">Recent Shelf Activity</h3>
                    <a href="{{ route('library') }}" class="btn-inline">View All</a>
                </div>

                @if($recentPerfumes->isNotEmpty())
                    <div class="recent-grid">
                        @foreach($recentPerfumes as $perfume)
                            <article class="recent-card">
                                <img src="{{ $perfume->image_url ?? asset('images/default-perfume.jpg') }}" alt="{{ $perfume->name }}">
                                <div class="recent-info">
                                    <div class="recent-brand">{{ $perfume->brand }}</div>
                                    <h4 class="recent-name">
                                        <a href="{{ route('fdetails', $perfume) }}">{{ $perfume->name }}</a>
                                    </h4>
                                    <div class="recent-meta">
                                        {{ $perfume->scent_family }} / Rating:
                                        {{ $perfume->pivot->rating ? $perfume->pivot->rating . ' / 5' : 'Not rated' }}
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-overview">
                        Your shelf is empty right now. Browse the catalogue and add fragrances you own or want to track.
                        <br>
                        <a href="{{ route('user.catalogue') }}" class="btn-inline">Start Browsing</a>
                    </div>
                @endif
            </section>
            </div>

            <aside class="action-panel">
                <h3 class="panel-headline">Profile Overview</h3>

                <div class="profile-summary">
                    <div class="profile-row">
                        <span>Name</span>
                        <strong>{{ $user->name }}</strong>
                    </div>
                    <div class="profile-row">
                        <span>Email</span>
                        <strong>{{ $user->email }}</strong>
                    </div>
                    <div class="profile-row">
                        <span>Account Role</span>
                        <strong>{{ ucfirst($user->role) }}</strong>
                    </div>
                    <div class="profile-row">
                        <span>Joined</span>
                        <strong>{{ $user->created_at ? \Illuminate\Support\Carbon::parse($user->created_at)->format('M d, Y') : 'Unavailable' }}</strong>
                    </div>
                </div>
                
                <a href="{{ route('recommendations') }}" class="menu-link">
                    <div>
                        <div class="menu-link-title">Run Scent Curator</div>
                        <div class="menu-link-desc">Reconstruct recommendations by weather or climate input.</div>
                    </div>
                    <div class="arrow">&rarr;</div>
                </a>

                <a href="{{ route('profile') }}" class="menu-link">
                    <div>
                        <div class="menu-link-title">Update Profile</div>
                        <div class="menu-link-desc">Edit your name, email, or password.</div>
                    </div>
                    <div class="arrow">→</div>
                </a>

                <a href="{{ route('library') }}" class="menu-link">
                    <div>
                        <div class="menu-link-title">Manage Perfume Library</div>
                        <div class="menu-link-desc">Organize your owned vanity collection.</div>
                    </div>
                    <div class="arrow">→</div>
                </a>
            </aside>

        </div>
    </div>

</body>
</html>
