<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity | {{ $perfume->name }}</title>
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
        .btn {
            padding: 12px 26px;
            border-radius: 999px;
            border: 1px solid #1f1f1f;
            transition: 0.3s ease;
            font-size: 0.9rem;
            letter-spacing: 1px;
            cursor: pointer;
            background: transparent;
        }
        .btn:hover {
            background: #1f1f1f;
            color: #fff;
        }
        .btn-filled {
            background: #1f1f1f;
            color: #fff;
        }
        .btn-filled:hover {
            background: transparent;
            color: #1f1f1f;
        }
        .btn-remove {
            border-color: #b95c4d;
            color: #9c3d31;
        }
        .btn-remove:hover {
            background: #9c3d31;
            border-color: #9c3d31;
            color: #fff;
        }

        /* Detail Page Layout */
        .breadcrumb {
            padding: 40px 8% 0;
            font-size: 0.85rem;
            letter-spacing: 1px;
            color: #888;
            text-transform: uppercase;
        }
        .breadcrumb a {
            transition: color 0.3s;
        }
        .breadcrumb a:hover {
            color: #1f1f1f;
        }

        .product-container {
            padding: 40px 8% 100px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: start;
        }

        /* Image Column */
        .image-gallery {
            position: sticky;
            top: 140px;
        }
        .main-image {
            width: 100%;
            height: 650px;
            object-fit: cover;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,.06);
        }

        /* Info Column */
        .product-info h2 {
            font-size: 0.9rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 12px;
            font-weight: 500;
        }
        .product-info h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 24px;
        }
        .description {
            color: #555;
            line-height: 1.9;
            margin-bottom: 40px;
            font-size: 1.05rem;
        }

        /* Fragrance Profile & Characteristics Blocks */
        .profile-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .scent-profile {
            background: #fff;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 35px rgba(0,0,0,.03);
        }
        .scent-profile h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(0,0,0,.06);
            padding-bottom: 10px;
        }
        .note-row {
            display: flex;
            margin-bottom: 14px;
            line-height: 1.6;
            font-size: 0.95rem;
        }
        .note-row:last-child {
            margin-bottom: 0;
        }
        .note-label {
            width: 130px;
            font-weight: 500;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
        }
        .note-values {
            color: #333;
            flex: 1;
        }
        .performance-row {
            align-items: flex-start;
            margin-bottom: 18px;
        }
        .performance-meter {
            flex: 1;
            padding-top: 3px;
        }
        .meter-track {
            width: 100%;
            height: 8px;
            background: #ebe5db;
            border-radius: 999px;
            overflow: hidden;
        }
        .meter-fill {
            height: 100%;
            width: var(--meter-value);
            background: #1f1f1f;
            border-radius: inherit;
        }
        .meter-caption {
            display: block;
            margin-top: 9px;
            color: #333;
            font-size: 0.95rem;
        }

        /* Fragrance Attributes */
        .size-selector {
            margin-bottom: 40px;
        }
        .size-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 15px;
        }
        .size-chips {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .attribute-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 22px;
            border-radius: 999px;
            border: 1px solid #ebe5db;
            background: #fff;
            font-size: 0.95rem;
        }
        .attribute-label {
            color: #888;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .attribute-value {
            color: #1f1f1f;
            font-weight: 500;
        }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 20px;
            margin-bottom: 50px;
        }
        .actions .btn {
            flex: 1;
            padding: 18px;
            text-align: center;
            font-size: 1rem;
        }

        /* Accordion Details */
        .accordion-item {
            border-top: 1px solid rgba(0,0,0,.08);
            padding: 20px 0;
        }
        .accordion-item:last-child {
            border-bottom: 1px solid rgba(0,0,0,.08);
        }
        .accordion-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .accordion-content {
            padding-top: 15px;
            color: #666;
            line-height: 1.8;
            font-size: 0.95rem;
            display: none;
        }
        .accordion-item.active .accordion-content {
            display: block;
        }

        /* Responsive Design */
        @media(max-width:1024px) {
            .product-container {
                grid-template-columns: 1fr;
                gap: 50px;
            }
            .image-gallery {
                position: relative;
                top: 0;
            }
            .main-image {
                height: 500px;
            }
            .product-info h1 {
                font-size: 3rem;
            }
        }
        @media(max-width:640px) {
            .note-row,
            .performance-row {
                flex-direction: column;
                gap: 8px;
            }
            .note-label {
                width: auto;
            }
            .performance-meter {
                width: 100%;
            }
            .attribute-chip {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    @php
        $longevityValue = strtolower($perfume->longevity);
        $sillageValue = strtolower($perfume->sillage);
        $longevityMeter = ['weak' => 33, 'moderate' => 66, 'strong' => 100][$longevityValue] ?? 66;
        $sillageMeter = ['soft' => 33, 'moderate' => 66, 'heavy' => 100][$sillageValue] ?? 66;
    @endphp

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

    <div class="breadcrumb">
        <a href="{{ route('user.catalogue') }}">Catalogue</a> • <span>{{ $perfume->brand }}</span>
    </div>

    <section class="product-container">
        
        <div class="image-gallery">
            <img src="{{ $perfume->image_url ?? asset('images/default-perfume.jpg') }}" alt="{{ $perfume->name }}" class="main-image">
        </div>

        <div class="product-info">
            <h2>{{ $perfume->brand }}</h2>
            <h1>{{ $perfume->name }}</h1>
            
            <p class="description">
                {{ $perfume->name }} is a {{ strtolower($perfume->scent_family) }} fragrance shaped around {{ $perfume->top_notes }} at the opening, {{ $perfume->middle_notes }} through the heart, and {{ $perfume->base_notes }} in the drydown.
            </p>

            <div class="profile-container">
                <div class="scent-profile">
                    <h3>Scent Pyramid</h3>
                    <div class="note-row">
                        <div class="note-label">Top Notes</div>
                        <div class="note-values">{{ $perfume->top_notes }}</div>
                    </div>
                    <div class="note-row">
                        <div class="note-label">Heart Notes</div>
                        <div class="note-values">{{ $perfume->middle_notes }}</div>
                    </div>
                    <div class="note-row">
                        <div class="note-label">Base Notes</div>
                        <div class="note-values">{{ $perfume->base_notes }}</div>
                    </div>
                </div>

                <div class="scent-profile">
                    <h3>Wear Notes</h3>
                    <div class="note-row">
                        <div class="note-label">Best Climate</div>
                        <div class="note-values">{{ $perfume->weather_suitability }}</div>
                    </div>
                    <div class="note-row performance-row">
                        <div class="note-label">Longevity</div>
                        <div class="performance-meter">
                            <div class="meter-track" aria-hidden="true">
                                <div class="meter-fill" style="--meter-value: {{ $longevityMeter }}%;"></div>
                            </div>
                            <span class="meter-caption">{{ ucfirst($perfume->longevity) }}</span>
                        </div>
                    </div>
                    <div class="note-row performance-row">
                        <div class="note-label">Sillage</div>
                        <div class="performance-meter">
                            <div class="meter-track" aria-hidden="true">
                                <div class="meter-fill" style="--meter-value: {{ $sillageMeter }}%;"></div>
                            </div>
                            <span class="meter-caption">{{ ucfirst($perfume->sillage) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="size-selector">
                <div class="size-title">Fragrance Attributes</div>
                <div class="size-chips">
                    <div class="attribute-chip">
                        <span class="attribute-label">Family</span>
                        <span class="attribute-value">{{ $perfume->scent_family }}</span>
                    </div>
                    <div class="attribute-chip">
                        <span class="attribute-label">Longevity</span>
                        <span class="attribute-value">{{ ucfirst($perfume->longevity) }}</span>
                    </div>
                    <div class="attribute-chip">
                        <span class="attribute-label">Sillage</span>
                        <span class="attribute-value">{{ ucfirst($perfume->sillage) }}</span>
                    </div>
                </div>
            </div>

            <div class="actions">
                @if($inLibrary)
                    <form action="{{ route('library.remove') }}" method="POST" style="flex: 1;" onsubmit="return confirm('Remove {{ addslashes($perfume->name) }} from your library?');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="perfume_id" value="{{ $perfume->perfume_id }}">
                        <button type="submit" class="btn btn-remove" style="width: 100%;">Remove from Library</button>
                    </form>
                @else
                    <form action="{{ route('library.add') }}" method="POST" style="flex: 1;">
                        @csrf
                        <input type="hidden" name="perfume_id" value="{{ $perfume->perfume_id }}">
                        <button type="submit" class="btn btn-filled" style="width: 100%;">Add to Library</button>
                    </form>
                @endif
                <a href="{{ route('user.catalogue') }}" class="btn">Back To Catalogue</a>
            </div>

            <div class="accordion">
                <div class="accordion-item" onclick="toggleAccordion(this)">
                    <div class="accordion-header">
                        <span>Sillage & Performance</span>
                        <span>+</span>
                    </div>
                    <div class="accordion-content">
                        This fragrance is classified with {{ $perfume->longevity }} longevity and {{ $perfume->sillage }} sillage, making it suitable for {{ $perfume->weather_suitability }} conditions.
                    </div>
                </div>
                <div class="accordion-item" onclick="toggleAccordion(this)">
                    <div class="accordion-header">
                        <span>Ingredients & Care</span>
                        <span>+</span>
                    </div>
                    <div class="accordion-content">
                        Store {{ $perfume->name }} away from direct sunlight and heat to preserve the character of its {{ strtolower($perfume->scent_family) }} profile.
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        function toggleAccordion(element) {
            element.classList.toggle('active');
            const icon = element.querySelector('.accordion-header span:last-child');
            if (element.classList.contains('active')) {
                icon.textContent = '−';
            } else {
                icon.textContent = '+';
            }
        }
    </script>
</body>
</html>
