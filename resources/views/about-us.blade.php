@extends('layouts.app')

@section('title', 'Scenity | About Us')

@section('styles')
    .about-hero {
        padding: 90px 8% 70px;
        display: grid;
        grid-template-columns: 1.05fr .95fr;
        gap: 60px;
        align-items: center;
    }
    .about-hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 4.8rem;
        line-height: 1;
        margin-bottom: 24px;
    }
    .about-hero p {
        color: #555;
        line-height: 1.9;
        max-width: 620px;
        margin-bottom: 18px;
    }
    .about-hero img {
        width: 100%;
        height: 520px;
        object-fit: cover;
        border-radius: 30px;
        box-shadow: 0 20px 50px rgba(0,0,0,.08);
    }
    .about-values {
        padding: 20px 8% 100px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
    }
    .value-card {
        background: #fff;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,.03);
    }
    .value-card h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        margin-bottom: 12px;
    }
    .value-card p {
        color: #666;
        line-height: 1.8;
    }
    @media(max-width: 900px) {
        .about-hero { grid-template-columns: 1fr; }
        .about-hero h1 { font-size: 3.4rem; }
        .about-hero img { height: 380px; }
    }
@endsection

@section('content')
    <main>
        <section class="about-hero">
            <div>
                <h1>About Scenity</h1>
                <p>Scenity is a fragrance discovery platform built to make perfume selection more personal, practical, and atmospheric.</p>
                <p>We combine curated perfume data, user preferences, and weather-aware matching so each recommendation feels suited to the person wearing it and the day they are stepping into.</p>
                <a href="{{ Auth::check() ? route('user.catalogue') : route('catalogue') }}" class="btn btn-filled">Explore Catalogue</a>
            </div>
            <img src="https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=1974&auto=format&fit=crop" alt="About Scenity">
        </section>

        <section class="about-values">
            <article class="value-card">
                <h2>Personal</h2>
                <p>Scenity helps users build a scent shelf that reflects their taste, lifestyle, and evolving fragrance identity.</p>
            </article>
            <article class="value-card">
                <h2>Weather-Aware</h2>
                <p>Temperature-based matching keeps scent suggestions relevant to warm, fresh, crisp, or cold conditions.</p>
            </article>
            <article class="value-card">
                <h2>Curated</h2>
                <p>Each catalogue entry can surface scent families, notes, longevity, and seasonal suitability in one clear view.</p>
            </article>
        </section>
    </main>
@endsection
