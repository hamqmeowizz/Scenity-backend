<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity | Profile Settings</title>
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
        }

        /* Profile Structural Split Page Layout */
        .profile-container {
            padding: 60px 8% 100px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 60px;
            align-items: start;
        }

        /* Left Side: Editorial Context Sidebar Nav Menu */
        .profile-sidebar h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 400;
            line-height: 1.2;
            margin-bottom: 30px;
        }
        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .menu-tab {
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            color: #777;
            padding: 6px 0;
            cursor: pointer;
            transition: color 0.3s;
            text-align: left;
            background: none;
            border: none;
        }
        .menu-tab:hover, .menu-tab.active {
            color: #1f1f1f;
            font-weight: 500;
        }
        .logout-form {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid rgba(0,0,0,0.06);
        }
        .btn-logout {
            width: 100%;
            padding: 12px 18px;
            border-radius: 999px;
            border: 1px solid rgba(155,44,44,0.22);
            background: transparent;
            color: #9b2c2c;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .btn-logout:hover {
            background: #9b2c2c;
            color: #fff;
            border-color: #9b2c2c;
        }

        /* Right Side: Account Forms View Space Containers */
        .form-card {
            background: #fff;
            padding: 45px;
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,.02);
            border: 1px solid rgba(0,0,0,0.01);
        }
        .form-card h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .section-desc {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 35px;
        }
        .status-message {
            background: #eef7ef;
            color: #2f6b3a;
            border: 1px solid rgba(47,107,58,0.12);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }
        .error-message {
            color: #9b2c2c;
            font-size: 0.8rem;
            margin-top: 2px;
        }

        /* Form Configuration Fields Layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 35px;
        }
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .field-group.full-width {
            grid-column: span 2;
        }
        label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            font-weight: 500;
        }
        input {
            padding: 14px 20px;
            border: 1px solid #ebe5db;
            border-radius: 12px;
            background: #FAF8F5;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: #1f1f1f;
            transition: border-color 0.3s, background 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #1f1f1f;
            background: #fff;
        }
        .password-field {
            position: relative;
        }
        .password-field input {
            width: 100%;
            padding-right: 50px;
        }
        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            background: transparent;
            color: #777;
            cursor: pointer;
            opacity: 0.75;
            transition: color 0.2s ease, opacity 0.2s ease;
        }
        .password-toggle:hover,
        .password-toggle.is-visible {
            color: #1f1f1f;
            opacity: 1;
        }
        .password-toggle svg {
            width: 20px;
            height: 20px;
            pointer-events: none;
        }
        .password-toggle .icon-eye-off {
            display: none;
        }
        .password-toggle.is-visible .icon-eye {
            display: none;
        }
        .password-toggle.is-visible .icon-eye-off {
            display: block;
        }

        /* Call To Action Utility Button Controls */
        .form-actions {
            display: flex;
            gap: 15px;
            border-top: 1px solid rgba(0,0,0,0.05);
            padding-top: 30px;
        }
        .btn {
            padding: 14px 30px;
            border-radius: 999px;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: 0.3s ease;
            border: 1px solid #1f1f1f;
        }
        .btn-save {
            background: #1f1f1f;
            color: #fff;
        }
        .btn-save:hover {
            background: transparent;
            color: #1f1f1f;
        }
        .btn-cancel {
            background: transparent;
            color: #666;
            border-color: transparent;
        }
        .btn-cancel:hover {
            color: #1f1f1f;
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

        /* Responsive Formatting Breakpoints */
        @media(max-width: 900px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .field-group.full-width {
                grid-column: span 1;
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
            <a href="{{ route('library') }}">My Fragrance</a>
            
            <div class="user-profile">
                <a href="{{ route('profile') }}" class="avatar-link" title="Manage Profile">
                    <span>{{ auth()->user()->name }}</span>
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                </a>
            </div>
        </div>
    </nav>

    <main class="profile-container">
        
        <aside class="profile-sidebar">
            <h1>Settings</h1>
            <div class="sidebar-menu">
                <button class="menu-tab active">Account Credentials</button>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn-logout">Log Out</button>
            </form>
        </aside>

        <section class="form-card">
            <h2>Account Details</h2>
            <p class="section-desc">Update your essential profile identifiers and secure credentials here.</p>

            @if(session('success'))
                <div class="status-message">{{ session('success') }}</div>
            @endif
            
            <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="field-group full-width">
                        <label for="firstName">Full Name</label>
                        <input type="text" id="firstName" name="name" value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group full-width">
                        <label for="emailAddress">Email Address</label>
                        <input type="email" id="emailAddress" name="email" value="{{ old('email', auth()->user()->email) }}">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="accountPassword">Update Password</label>
                        <div class="password-field">
                            <input type="password" id="accountPassword" name="password" placeholder="••••••••••••">
                            <button type="button" class="password-toggle" data-password-toggle="accountPassword" aria-label="Show password" aria-pressed="false">
                                <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg class="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                    <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                    <line x1="2" y1="2" x2="22" y2="22"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <div class="password-field">
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="••••••••••••">
                            <button type="button" class="password-toggle" data-password-toggle="confirmPassword" aria-label="Show password" aria-pressed="false">
                                <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg class="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                    <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                    <line x1="2" y1="2" x2="22" y2="22"/>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-save">Save Changes</button>
                    <button type="button" class="btn btn-cancel" onclick="window.location.href='{{ route('dashboard') }}'">Cancel</button>
                </div>
            </form>
        </section>

    </main>

    <script>
        document.querySelectorAll('[data-password-toggle]').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const input = document.getElementById(toggle.dataset.passwordToggle);
                const shouldShow = input.type === 'password';

                input.type = shouldShow ? 'text' : 'password';
                toggle.classList.toggle('is-visible', shouldShow);
                toggle.setAttribute('aria-pressed', shouldShow.toString());
                toggle.setAttribute('aria-label', shouldShow ? 'Hide password' : 'Show password');
            });
        });
    </script>
</body>
</html>
