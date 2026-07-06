<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity Control Panel | Secure Administrator Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #111111; /* True dark charcoal pitch to match admin sidebar */
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Sleek Luxury Login Card Window Frame */
        .login-card {
            background: #161616;
            width: 100%;
            max-width: 420px;
            border: 1px solid #222;
            border-radius: 4px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .login-brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 3px;
            text-align: center;
            margin-bottom: 8px;
        }
        .login-brand span {
            font-size: 0.7rem;
            background: #c5a880; /* Signature Premium Brand Gold */
            color: #111;
            padding: 2px 6px;
            border-radius: 2px;
            font-weight: 700;
            letter-spacing: 0.5px;
            vertical-align: middle;
            margin-left: 4px;
        }
        .login-subtitle {
            font-size: 0.8rem;
            color: #666;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 500;
            margin-bottom: 35px;
        }

        /* Error Notification Banner Alert */
        .error-banner {
            background: #2a1412;
            border: 1px solid #5c2420;
            color: #fca5a5;
            font-size: 0.8rem;
            padding: 12px 14px;
            border-radius: 2px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .success-banner {
            background: #142317;
            border: 1px solid #285734;
            color: #a7f3d0;
            font-size: 0.8rem;
            padding: 12px 14px;
            border-radius: 2px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Styled Input Groups Layout Architecture */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 22px;
        }
        label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
        }
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-wrapper i {
            position: absolute;
            left: 14px;
            color: #444;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }
        input {
            width: 100%;
            padding: 12px 14px 12px 40px; /* Offset to make room for icon */
            font-size: 0.85rem;
            border: 1px solid #262626;
            border-radius: 2px;
            background: #1a1a1a;
            color: #fff;
            font-family: inherit;
            transition: all 0.2s ease-in-out;
        }
        input:focus {
            outline: none;
            border-color: #c5a880;
            background: #1f1f1f;
            box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.15);
        }
        input:focus + i {
            color: #c5a880; /* Highlight icon gold on field focus */
        }

        /* Luxury Call To Action Execution Button */
        .btn-login-submit {
            width: 100%;
            background: #c5a880;
            color: #111;
            border: 1px solid #c5a880;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 14px;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.8rem;
            margin-top: 10px;
        }
        .btn-login-submit:hover {
            background: #fff;
            border-color: #fff;
            color: #111;
        }

        .login-footer-link {
            display: block;
            text-align: center;
            font-size: 0.75rem;
            color: #444;
            text-decoration: none;
            margin-top: 25px;
            transition: color 0.2s;
            letter-spacing: 0.5px;
        }
        .login-footer-link:hover {
            color: #888;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-brand">
            SCENITY <span>CMS</span>
        </div>
        <div class="login-subtitle">Secure Gateway Access</div>

        @if(session('success'))
            <div class="success-banner">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="error-banner">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form id="adminLoginForm" action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="field-group">
                <label for="adminEmail">Secure Terminal Identifier</label>
                <div class="input-wrapper">
                    <input type="email" id="adminEmail" name="email" placeholder="admin@scenity.com" required value="{{ old('email') }}">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
            </div>

            <div class="field-group">
                <label for="adminPassword">Cryptographic Access Key</label>
                <div class="input-wrapper">
                    <input type="password" id="adminPassword" name="password" placeholder="••••••••••••" required>
                    <i class="fa-solid fa-key"></i>
                </div>
            </div>

            <button type="submit" class="btn-login-submit">Authorize Session</button>
        </form>

        <a href="{{ route('index') }}" class="login-footer-link">
            <i class="fa-solid fa-arrow-left-long" style="margin-right: 4px;"></i> Return to Public Showcase
        </a>
    </div>

</body>
</html>
