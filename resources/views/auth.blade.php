<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Scenity Authentication</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    body{
      font-family:'Inter', sans-serif;
      background:#f8f5f0;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:40px;
      overflow-x:hidden;
    }

    a{
      text-decoration:none;
      color:inherit;
    }

    .auth-wrapper{
      width:100%;
      max-width:1150px;
      background:#fff;
      border-radius:36px;
      overflow:hidden;
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
      box-shadow:0 25px 70px rgba(0,0,0,0.08);
      animation:fadeUp 0.8s ease;
    }

    /* LEFT SIDE */
    .auth-left{
      background:#efe9df;
      padding:70px 60px;
      display:flex;
      flex-direction:column;
      justify-content:center;
    }

    .logo{
      font-family:'Cormorant Garamond', serif;
      font-size:2rem;
      letter-spacing:8px;
      margin-bottom:50px;
    }

    .auth-left h1{
      font-family:'Cormorant Garamond', serif;
      font-size:4.5rem;
      line-height:1;
      margin-bottom:24px;
      font-weight:600;
    }

    .auth-left p{
      color:#555;
      line-height:1.9;
      margin-bottom:40px;
      max-width:500px;
    }

    .auth-left img{
      width:100%;
      height:340px;
      object-fit:cover;
      border-radius:28px;
      box-shadow:0 20px 50px rgba(0,0,0,0.08);
    }

    /* RIGHT SIDE */
    .auth-right{
      padding:70px 60px;
      display:flex;
      flex-direction:column;
      justify-content:center;
      position:relative;
    }

    /* Notification message styles */
    .alert {
      padding: 12px 20px;
      border-radius: 12px;
      margin-bottom: 20px;
      font-size: 0.9rem;
    }
    .alert-success {
      background-color: #e6f4ea;
      color: #137333;
    }
    .alert-danger {
      background-color: #fce8e6;
      color: #c5221f;
      padding-left: 30px;
    }

    .form-toggle{
      display:flex;
      gap:14px;
      margin-bottom:40px;
    }

    .toggle-btn{
      padding:12px 24px;
      border-radius:999px;
      border:1px solid #1f1f1f;
      background:transparent;
      cursor:pointer;
      transition:0.3s ease;
      font-size:0.92rem;
    }

    .toggle-btn.active{
      background:#1f1f1f;
      color:#fff;
    }

    .form-section{
      display:none;
      animation:fadeIn 0.4s ease;
    }

    .form-section.active{
      display:block;
    }

    .form-section h2{
      font-family:'Cormorant Garamond', serif;
      font-size:3rem;
      margin-bottom:35px;
    }

    .input-group{
      margin-bottom:22px;
    }

    .input-group label{
      display:block;
      margin-bottom:10px;
      color:#555;
      font-size:0.92rem;
    }

    .input-group input{
      width:100%;
      padding:16px 20px;
      border-radius:18px;
      border:1px solid rgba(0,0,0,0.08);
      background:#fafafa;
      outline:none;
      font-size:0.95rem;
      transition:0.3s ease;
    }

    .input-group input:focus{
      border-color:#1f1f1f;
      background:#fff;
    }

    .password-field{
      position:relative;
    }

    .password-field input{
      padding-right:52px;
    }

    .password-toggle{
      position:absolute;
      right:16px;
      top:50%;
      transform:translateY(-50%);
      width:24px;
      height:24px;
      display:flex;
      align-items:center;
      justify-content:center;
      border:none;
      background:transparent;
      color:#777;
      cursor:pointer;
      opacity:0.7;
      transition:0.2s ease;
    }

    .password-toggle:hover,
    .password-toggle.is-visible{
      color:#1f1f1f;
      opacity:1;
    }

    .password-toggle svg{
      width:20px;
      height:20px;
      pointer-events:none;
    }

    .password-toggle .icon-eye-off{
      display:none;
    }

    .password-toggle.is-visible .icon-eye{
      display:none;
    }

    .password-toggle.is-visible .icon-eye-off{
      display:block;
    }

    .password-warning{
      display:none;
      margin-top:8px;
      color:#b42318;
      font-size:0.82rem;
      line-height:1.4;
    }

    .password-warning.active{
      display:block;
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
      margin-top:10px;
    }

    .submit-btn:hover{
      background:#333;
    }

    .submit-btn:disabled{
      cursor:not-allowed;
      opacity:0.45;
      background:#888;
    }

    .submit-btn:disabled:hover{
      background:#888;
    }

    .forgot-link{
      display:block;
      width:fit-content;
      margin:4px 0 0 auto;
      color:#555;
      font-size:0.86rem;
      transition:0.3s ease;
    }

    .forgot-link:hover{
      color:#1f1f1f;
      text-decoration:underline;
      text-underline-offset:4px;
    }

    .extra-text{
      margin-top:24px;
      color:#666;
      text-align:center;
      font-size:0.92rem;
    }

    .extra-text span{
      color:#1f1f1f;
      font-weight:600;
      cursor:pointer;
    }

    .admin-login-link{
      display:block;
      width:fit-content;
      margin:18px auto 0;
      padding:10px 20px;
      border-radius:999px;
      border:1px solid rgba(31,31,31,0.18);
      color:#555;
      font-size:0.86rem;
      transition:0.3s ease;
    }

    .admin-login-link:hover{
      border-color:#1f1f1f;
      color:#1f1f1f;
      background:#fafafa;
    }

    @keyframes fadeUp{
      from{
        opacity:0;
        transform:translateY(40px);
      }
      to{
        opacity:1;
        transform:translateY(0);
      }
    }

    @keyframes fadeIn{
      from{
        opacity:0;
      }
      to{
        opacity:1;
      }
    }

    @media(max-width:900px){
      .auth-left,
      .auth-right{
        padding:50px 35px;
      }

      .auth-left h1{
        font-size:3.2rem;
      }

      .form-section h2{
        font-size:2.4rem;
      }
    }

    @media(max-width:600px){
      body{
        padding:20px;
      }

      .auth-left h1{
        font-size:2.8rem;
      }

      .logo{
        margin-bottom:30px;
      }

      .form-toggle{
        flex-wrap:wrap;
      }
    }
  </style>
</head>

<body>

  <div class="auth-wrapper">

    <div class="auth-left">
      <div class="logo">SCENITY</div>
      <h1>Discover Your Signature Scent</h1>
      <p>
        Join Scenity and unlock a personalized fragrance experience tailored to your preferences, skin characteristics, and scent journey.
      </p>
      <img 
        src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=1974&auto=format&fit=crop" 
        alt="Perfume">
    </div>

    <div class="auth-right">

      @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 15px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif


      <div class="form-toggle">
        <button class="toggle-btn active" onclick="showLogin()">
          Login
        </button>
        <button class="toggle-btn" onclick="showRegister()">
          Register
        </button>
      </div>

      <div class="form-section active" id="loginForm">
        <h2>Welcome Back</h2>

        <form action="{{ route('login.submit') }}" method="POST">
        @csrf
          <div class="input-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
          </div>

          <div class="input-group">
            <label>Password</label>
            <div class="password-field">
              <input type="password" name="password" id="loginPassword" placeholder="Enter your password" required>
              <button type="button" class="password-toggle" data-password-toggle="loginPassword" aria-label="Show password" aria-pressed="false">
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
            <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
          </div>

          <button type="submit" class="submit-btn">
            Sign In
          </button>
        </form>

        <p class="extra-text">
          Don’t have an account?
          <span onclick="showRegister()">Register</span>
        </p>

        <a href="{{ route('adminlogin') }}" class="admin-login-link">Admin Login</a>
      </div>

      <div class="form-section" id="registerForm">
        <h2>Create Account</h2>

        <form action="{{ route('register.submit') }}" method="POST">
          @csrf

          <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Enter your full name" required value="{{ old('name') }}">
          </div>

          <div class="input-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>
          </div>

          <div class="input-group">
            <label>Password</label>
            <div class="password-field">
              <input type="password" name="password" id="registerPassword" placeholder="Create your password" required>
              <button type="button" class="password-toggle" data-password-toggle="registerPassword" aria-label="Show password" aria-pressed="false">
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
          </div>

          <div class="input-group">
            <label>Confirm Password</label>
            <div class="password-field">
              <input type="password" name="password_confirmation" id="registerPasswordConfirmation" placeholder="Confirm your password" required>
              <button type="button" class="password-toggle" data-password-toggle="registerPasswordConfirmation" aria-label="Show password" aria-pressed="false">
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
            <div class="password-warning" id="passwordMatchWarning">Passwords do not match yet.</div>
          </div>

          <button type="submit" class="submit-btn" id="registerSubmitBtn">
            Create Account
          </button>
        </form>

        <p class="extra-text">
          Already have an account?
          <span onclick="showLogin()">Login</span>
        </p>
      </div>

    </div>

  </div>

  <script>
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const buttons = document.querySelectorAll('.toggle-btn');
    const registerPassword = document.getElementById('registerPassword');
    const registerPasswordConfirmation = document.getElementById('registerPasswordConfirmation');
    const registerSubmitBtn = document.getElementById('registerSubmitBtn');
    const passwordMatchWarning = document.getElementById('passwordMatchWarning');

    function showLogin(){
      loginForm.classList.add('active');
      registerForm.classList.remove('active');
      buttons[0].classList.add('active');
      buttons[1].classList.remove('active');
    }

    function showRegister(){
      registerForm.classList.add('active');
      loginForm.classList.remove('active');
      buttons[1].classList.add('active');
      buttons[0].classList.remove('active');
    }

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

    function validatePasswordMatch(){
      const password = registerPassword.value;
      const confirmation = registerPasswordConfirmation.value;
      const hasConfirmation = confirmation.length > 0;
      const mismatch = hasConfirmation && password !== confirmation;

      passwordMatchWarning.classList.toggle('active', mismatch);
      registerSubmitBtn.disabled = mismatch;
    }

    registerPassword.addEventListener('input', validatePasswordMatch);
    registerPasswordConfirmation.addEventListener('input', validatePasswordMatch);
    validatePasswordMatch();

    // Auto-toggle form context if validation fails on registration
    @if($errors->any() && !old('email'))
       // Keep default interface view or adjust based on active states
    @endif
  </script>

</body>
</html>

