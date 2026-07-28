<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Web-Based Witness Management System Case Study: RIB | Umutekano</title>
<!-- <link rel="stylesheet" href="{{ URL::to('/') }}/Guest/assets/styles.css"> -->
<link rel="stylesheet" href="{{ asset('Guest/assets/styles.css') }}">
</head>
<body>

<header class="nav">
  <div class="container nav-row">
    <a href="index.html" class="brand">
      <svg class="brand-mark" viewBox="0 0 36 36" fill="none">
        <rect x="1" y="1" width="34" height="34" rx="9" fill="#17335C"/>
        <path d="M18 6 L28 10 V17.5 C28 24.5 23.5 28.7 18 30 C12.5 28.7 8 24.5 8 17.5 V10 L18 6Z" stroke="#fff" stroke-width="1.6" fill="none"/>
        <path d="M13.5 18 L16.7 21.2 L23 14.5" stroke="#D99A2B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      </svg>
      <div>
        <div class="brand-name">Web-Based Witness<span> MS</span></div>
        <div class="brand-sub">RIB Witness Portal</div>
      </div>
    </a>

    <nav class="nav-links">
      <a href="#about">About</a>
      <a href="#features">Platform</a>
      <a href="#how-it-works">How it works</a>
      <a href="#security">Security</a>
      <a href="{{ route('login') }}" class="mobile-only-link">Log in</a>
      <a href="{{ route('register') }}" class="mobile-only-link">Report a crime</a>
    </nav>

    <div class="nav-actions">
      <a href="{{ route('login') }}" class="btn btn-ghost">Log in</a>
      <a href="{{ route('register') }}" class="btn btn-primary">Report a crime</a>
    </div>
    <button class="nav-toggle" aria-label="Open menu" aria-expanded="false">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
    </button>
  </div>
</header>

<main>
  @yield('content')
</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-col">
        <div class="brand">
          <svg class="brand-mark" viewBox="0 0 36 36" fill="none">
            <rect x="1" y="1" width="34" height="34" rx="9" fill="#17335C"/>
            <path d="M18 6 L28 10 V17.5 C28 24.5 23.5 28.7 18 30 C12.5 28.7 8 24.5 8 17.5 V10 L18 6Z" stroke="#fff" stroke-width="1.6" fill="none"/>
          </svg>
          <div class="brand-name">Web-Based Witness<span> MS</span></div>
        </div>
        <p class="footer-desc">A secure witness management platform built for the Rwanda Investigation Bureau.</p>
      </div>
      <div class="footer-col">
        <h5>Platform</h5>
        <ul>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#how-it-works">How it works</a></li>
          <li><a href="#security">Security</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Account</h5>
        <ul>
          <li><a href="{{ route('login') }}">Log in</a></li>
          <li><a href="{{ route('register') }}">Create account</a></li>
          <li><a href="{{ route('forgot-password') }}">Reset password</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Rwanda Investigation Bureau</h5>
        <ul>
          <li><a href="#">Official RIB site</a></li>
          <li><a href="#">Emergency contacts</a></li>
          <li><a href="#">Report anonymously</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Rwanda Investigation Bureau. All rights reserved.</span>
      <span>Web-based witness MS Portal built for confidential public safety reporting.</span>
    </div>
  </div>
</footer>

<!-- <script src="{{ URL::to('/') }}/Guest/assets/script.js"></script> -->
<script src="{{ asset('Guest/assets/script.js') }}"></script>
</body>
</html>