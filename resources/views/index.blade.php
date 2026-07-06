<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Scenity</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f8f5f0;
      color: #1f1f1f;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* NAVBAR */
    nav {
      position: fixed;
      top: 0;
      width: 100%;
      padding: 28px 8%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
      background: rgba(248, 245, 240, 0.85);
      backdrop-filter: blur(10px);
    }

    .logo {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      letter-spacing: 8px;
      font-weight: 600;
    }

    .nav-links {
      display: flex;
      gap: 40px;
      font-size: 0.95rem;
      letter-spacing: 1px;
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

    .nav-links a:hover::after {
      width: 100%;
    }

    .auth-buttons {
      display: flex;
      gap: 16px;
    }

    .btn {
      padding: 12px 26px;
      border-radius: 999px;
      border: 1px solid #1f1f1f;
      transition: 0.3s ease;
      font-size: 0.9rem;
      letter-spacing: 1px;
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

    /* HERO SECTION */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 8%;
      gap: 60px;
    }

    .hero-content {
      flex: 1;
      animation: fadeUp 1s ease;
    }

    .hero-content h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 5.5rem;
      line-height: 1;
      margin-bottom: 24px;
      font-weight: 600;
    }

    .hero-content p {
      max-width: 520px;
      font-size: 1.05rem;
      line-height: 1.9;
      color: #555;
      margin-bottom: 36px;
    }

    .hero-buttons {
      display: flex;
      gap: 18px;
    }

    .hero-image {
      flex: 1;
      display: flex;
      justify-content: center;
      animation: fadeIn 1.4s ease;
    }

    .hero-image img {
      width: 100%;
      max-width: 520px;
      border-radius: 30px;
      object-fit: cover;
      box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    }

    /* SECTION STYLING */
    section {
      padding: 120px 8%;
    }

    .section-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 3rem;
      margin-bottom: 18px;
      text-align: center;
    }

    .section-subtitle {
      text-align: center;
      color: #666;
      max-width: 700px;
      margin: 0 auto 70px;
      line-height: 1.8;
    }

    /* COLLECTIONS */
    .collections-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 28px;
    }

    .collection-card {
      background: #fff;
      border-radius: 28px;
      overflow: hidden;
      transition: 0.4s ease;
      box-shadow: 0 8px 30px rgba(0,0,0,0.04);
    }

    .collection-card:hover {
      transform: translateY(-8px);
    }

    .collection-card img {
      width: 100%;
      height: 350px;
      object-fit: cover;
    }

    .collection-info {
      padding: 28px;
    }

    .collection-info h3 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .collection-info p {
      color: #666;
      line-height: 1.7;
      font-size: 0.95rem;
    }

    /* ABOUT */
    .about {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      align-items: center;
      gap: 60px;
    }

    .about img {
      width: 100%;
      border-radius: 30px;
      object-fit: cover;
      box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    }

    .about-content h2 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 4rem;
      margin-bottom: 20px;
    }

    .about-content p {
      color: #555;
      line-height: 1.9;
      margin-bottom: 30px;
    }

    /* EXPERIENCE CARDS */
    .experience-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      margin-top: 60px;
    }

    .experience-card {
      background: rgba(255,255,255,0.6);
      padding: 40px;
      border-radius: 28px;
      backdrop-filter: blur(12px);
      border: 1px solid rgba(0,0,0,0.05);
      transition: 0.3s ease;
    }

    .experience-card:hover {
      transform: translateY(-6px);
    }

    .experience-card h3 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      margin-bottom: 16px;
    }

    .experience-card p {
      color: #666;
      line-height: 1.8;
    }

    /* FOOTER */
    footer {
      padding: 50px 8%;
      border-top: 1px solid rgba(0,0,0,0.08);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .footer-logo {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      letter-spacing: 8px;
    }

    .footer-links {
      display: flex;
      gap: 30px;
      color: #666;
    }

    /* ANIMATIONS */
    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    /* RESPONSIVE */
    @media(max-width: 992px) {
      .hero {
        flex-direction: column;
        justify-content: center;
        padding-top: 140px;
      }

      .hero-content h1 {
        font-size: 4rem;
      }

      nav {
        flex-direction: column;
        gap: 20px;
      }
    }

    @media(max-width: 600px) {
      .hero-content h1 {
        font-size: 3rem;
      }

      .section-title {
        font-size: 2.2rem;
      }

      .about-content h2 {
        font-size: 2.8rem;
      }

      .hero-buttons {
        flex-direction: column;
      }

      .nav-links {
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
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

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1>Discover Fragrances Tailored To Your Identity</h1>

      <p>
        Experience luxury fragrance discovery through a refined digital platform designed to help users explore perfumes that complement their personality, preferences, and skin characteristics.
      </p>

      <div class="hero-buttons">
        <a href="{{ route('catalogue') }}" class="btn btn-filled">Explore Catalogue</a>
        <a href="/auth" class="btn">Create Account</a>
      </div>
    </div>

    <div class="hero-image">
      <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=1974&auto=format&fit=crop" alt="Perfume">
    </div>
  </section>

  <!-- COLLECTIONS -->
  <section id="collections">
    <h2 class="section-title">Featured Collections</h2>

    <p class="section-subtitle">
      Explore curated fragrance categories crafted to suit different moods, personalities, and scent preferences.
    </p>

    <div class="collections-grid">
      <div class="collection-card">
        <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?q=80&w=1887&auto=format&fit=crop" alt="Floral">
        <div class="collection-info">
          <h3>Floral</h3>
          <p>Elegant and romantic fragrances inspired by blooming flowers and soft feminine notes.</p>
        </div>
      </div>

      <div class="collection-card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwA4xaNLJ8mZKaqVFj-ENgRMArGKU5Ae5mUiZnQcRozA&s=10" alt="Woody">
        <div class="collection-info">
          <h3>Woody</h3>
          <p>Warm and sophisticated scents featuring earthy accords, sandalwood, and cedar notes.</p>
        </div>
      </div>

      <div class="collection-card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrazgTsAOnmFZhnC2q6eWM_LmdKPFH9q2Tb-uIYl-8rA&s=10" alt="Fresh">
        <div class="collection-info">
          <h3>Fresh</h3>
          <p>Light and energising fragrances with citrus, aquatic, and clean aromatic compositions.</p>
        </div>
      </div>

      <div class="collection-card">
        <img src="https://images.unsplash.com/photo-1615634260167-c8cdede054de?q=80&w=1887&auto=format&fit=crop" alt="Oriental">
        <div class="collection-info">
          <h3>Oriental</h3>
          <p>Rich and luxurious scents characterised by spices, amber, vanilla, and deep accords.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="about">
    <img src="https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=1974&auto=format&fit=crop" alt="About Scenity">

    <div class="about-content">
      <h2>About Scenity</h2>

      <p>
        Scenity is a web-based perfume recommendation platform that combines intelligent personalization with luxury fragrance exploration. By integrating user preferences, behavioural patterns, and skin-aware analysis, Scenity creates a more refined and personalised perfume discovery experience.
      </p>

      <a href="{{ route('about') }}" class="btn btn-filled">Learn More</a>
    </div>
  </section>

  <!-- EXPERIENCE -->
  <section>
    <h2 class="section-title">The Scenity Experience</h2>

    <p class="section-subtitle">
      A modern fragrance journey designed to blend personalization, elegance, and intelligent discovery.
    </p>

    <div class="experience-grid">
      <div class="experience-card">
        <h3>Personalized Discovery</h3>
        <p>
          Discover fragrances tailored to your individual preferences and scent profile.
        </p>
      </div>

      <div class="experience-card">
        <h3>Weather-Aware Matching</h3>
        <p>
          Recommendations consider weather characteristics to improve fragrance compatibility and longevity.
        </p>
      </div>

      <div class="experience-card">
        <h3>Behaviour-Based Learning</h3>
        <p>
          The platform adapts over time by understanding user interactions and fragrance interests.
        </p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-logo">SCENITY</div>

    <div class="footer-links">
      <a href="{{ route('index') }}">Home</a>
      <a href="#collections">Catalogue</a>
      <a href="{{ route('about') }}">About</a>
      <a href="#">Contact</a>
    </div>
  </footer>

</body>
</html>
