<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Password | Scenity</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:32px;
      background:#f8f5f0;
      color:#111;
      font-family:'Inter', sans-serif;
    }
    a{color:inherit;text-decoration:none}
    .reset-card{
      width:min(100%, 560px);
      background:#fff;
      border-radius:32px;
      padding:52px;
      box-shadow:0 25px 70px rgba(0,0,0,0.08);
    }
    .logo{
      font-family:'Cormorant Garamond', serif;
      letter-spacing:8px;
      font-size:1.8rem;
      margin-bottom:34px;
      text-align:center;
    }
    h1{
      font-family:'Cormorant Garamond', serif;
      font-size:3rem;
      line-height:1;
      margin-bottom:16px;
      font-weight:600;
    }
    .intro{
      color:#666;
      line-height:1.8;
      margin-bottom:30px;
    }
    .alert{
      padding:12px 16px;
      border-radius:14px;
      margin-bottom:20px;
      font-size:0.9rem;
      line-height:1.5;
    }
    .alert-success{background:#e6f4ea;color:#137333}
    .alert-danger{background:#fce8e6;color:#b42318}
    .input-group{margin-bottom:20px}
    label{
      display:block;
      margin-bottom:10px;
      color:#555;
      font-size:0.92rem;
    }
    input{
      width:100%;
      padding:16px 20px;
      border-radius:18px;
      border:1px solid rgba(0,0,0,0.08);
      background:#fafafa;
      outline:none;
      font-size:0.95rem;
      transition:0.3s ease;
    }
    input:focus{border-color:#1f1f1f;background:#fff}
    .otp-input{
      letter-spacing:0.35em;
      font-weight:600;
      text-align:center;
    }
    .submit-btn{
      width:100%;
      padding:16px;
      border:none;
      border-radius:999px;
      background:#1f1f1f;
      color:#fff;
      font-size:0.95rem;
      cursor:pointer;
      transition:0.3s ease;
      margin-top:8px;
    }
    .submit-btn:hover{background:#333}
    .secondary-actions{
      display:flex;
      align-items:center;
      justify-content:center;
      gap:18px;
      flex-wrap:wrap;
      margin-top:22px;
      color:#555;
      font-size:0.9rem;
    }
    .secondary-actions a:hover{color:#1f1f1f;text-decoration:underline;text-underline-offset:4px}
    @media(max-width:600px){
      body{padding:20px}
      .reset-card{padding:38px 28px;border-radius:26px}
      h1{font-size:2.45rem}
    }
  </style>
</head>
<body>
  <main class="reset-card">
    <div class="logo">SCENITY</div>
    <h1>Create New Password</h1>
    <p class="intro">Enter the OTP from your email and choose a new password for your account.</p>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul style="margin:0;padding-left:18px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
      @csrf
      <div class="input-group">
        <label>Email Address</label>
        <input type="email" name="email" value="{{ old('email', session('reset_email')) }}" placeholder="Enter your email" required>
      </div>

      <div class="input-group">
        <label>OTP Code</label>
        <input class="otp-input" type="text" name="otp" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" placeholder="000000" required>
      </div>

      <div class="input-group">
        <label>New Password</label>
        <input type="password" name="password" placeholder="Create a new password" required>
      </div>

      <div class="input-group">
        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm your new password" required>
      </div>

      <button type="submit" class="submit-btn">Reset Password</button>
    </form>

    <div class="secondary-actions">
      <a href="{{ route('password.request') }}">Send a new OTP</a>
      <a href="{{ route('login') }}">Back to login</a>
    </div>
  </main>
</body>
</html>
