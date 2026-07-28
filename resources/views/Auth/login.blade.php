@extends('Auth.cover')
@section('content')
<style>
    .btn[data-loading="true"]{
        pointer-events: none;
        opacity: 0.85;
    }
    .btn-spinner{
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.35);
        border-top-color: #fff;
        border-radius: 50%;
        animation: btn-spin 0.6s linear infinite;
        display: none;
    }
    .btn[data-loading="true"] .btn-spinner{ display: inline-block; }
    .btn[data-loading="true"] .btn-label{ opacity: 0.85; }
    @keyframes btn-spin{
        to{ transform: rotate(360deg); }
    }
</style>
<header class="nav">
  <div class="container nav-row">
    <a href="{{ url('/') }}" class="brand">
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
    <div class="nav-actions">
      <span style="font-size:14px; color:var(--ink-soft);">New here?</span>
      <a href="{{ route('register') }}" class="btn btn-primary">Create account</a>
    </div>
  </div>
</header>

<main class="auth-main">

  <aside class="auth-side">
    <div class="auth-side-top">
      <div class="auth-quote">
        <span class="eyebrow">Welcome back</span>
        <h2>Your case updates and messages are waiting where you left them.</h2>
        <p>Log in to check the status of a report, respond to your investigator, or file a new one.</p>
      </div>
    </div>

    <div class="evidence-tag">
      <div class="tag-top">
        <div>
          <div class="eyebrow" style="margin-bottom:4px;">Incident report</div>
          <div class="tag-id">REF · RIB-2026-04821</div>
        </div>
        <span class="tag-status">Under review</span>
      </div>
      <hr class="tag-divider">
      <div class="tag-row"><span>Investigator</span><span>Assigned</span></div>
      <div class="tag-row"><span>Last update</span><span>2 hours ago</span></div>
      <div class="seal">
        <div class="seal-inner">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2F8F5B" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
          SECURE<br>CHANNEL
        </div>
      </div>
    </div>

    <div class="auth-side-bottom">
      <div class="side-metric"><b>24/7</b><span>Portal availability</span></div>
      <div class="side-metric"><b>256-bit</b><span>Encryption standard</span></div>
    </div>
  </aside>

  <div class="auth-panel">
    <div class="auth-card">
      <div class="auth-card-head">
        <h1>Log in to your account</h1>
        <p>Enter your credentials to access your reports and messages.</p>
      </div>

      @if(session('error'))
        <div class="alert-danger" role="alert">
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any() && !$errors->has('username') && !$errors->has('password'))
        <div class="alert-danger" role="alert">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('submit.login') }}" method="POST" data-validate novalidate>
          @csrf

          <div class="field {{ $errors->has('username') ? 'invalid' : '' }}">
            <label for="login-email">Email or phone number</label>

            <div class="input-wrap has-icon">
              <span class="input-icon">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <rect x="3" y="5" width="18" height="14" rx="2"/>
                  <path d="m3 7 9 6 9-6"/>
                </svg>
              </span>

              <input
                type="text"
                id="login-email"
                name="username"
                value="{{ old('username') }}"
                placeholder="Enter email or phone number"
                required
              >
            </div>

            <p class="error-text">
              {{ $errors->first('username') ?: 'Enter the email or phone number linked to your account.' }}
            </p>
          </div>

          <div class="field {{ $errors->has('password') ? 'invalid' : '' }}">
            <div class="field-row" style="margin-bottom:7px;">
              <label for="login-password" style="margin-bottom:0;">Password</label>
              <a href="{{ route('forgot-password') }}" class="link-sm">Forgot password?</a>
            </div>

            <div class="input-wrap">
              <input
                type="password"
                id="login-password"
                name="password"
                placeholder="Enter your password"
                required
              >

              <button type="button" class="input-toggle" aria-label="Show password">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>

            <p class="error-text">
              {{ $errors->first('password') ?: 'Enter your password to continue.' }}
            </p>
          </div>

          <div class="check-row" style="margin-top:6px;">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Keep me signed in on this device</label>
          </div>

          <button type="submit" class="btn btn-primary btn-block btn-lg" id="login-submit">
            <span class="btn-spinner"></span>
            <span class="btn-label">Log in</span>
          </button>
      </form>

      <div class="divider-row">or</div>

      <a href="{{ url('/') }}" class="btn btn-ghost btn-block">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Back to homepage
      </a>

      <p class="auth-switch">Don't have an account? <a href="{{ route('register') }}" class="link-sm">Create one</a></p>
    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('form[data-validate]').forEach(originalForm => {

    // The shared Guest/assets/script.js file also attaches a submit handler to
    // every form[data-validate] (leftover from the pre-backend static mockups --
    // it preventDefault()s and hides the form looking for a mock success panel).
    // That conflicts with this page's real Laravel submission. Cloning the node
    // drops any previously-attached JS listeners (attributes/children are kept,
    // event listeners are not), so only the handlers set up below apply here.
    const form = originalForm.cloneNode(true);
    originalForm.parentNode.replaceChild(form, originalForm);

    form.querySelectorAll('.input-toggle').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = btn.previousElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
      });
    });

    form.addEventListener('submit', (e) => {
      let hasError = false;
      let firstInvalid = null;

      form.querySelectorAll('.field').forEach(field => {
        const input = field.querySelector('input');
        if (!input) return;

        let valid = true;
        if (input.hasAttribute('required') && !input.value.trim()) {
          valid = false;
        }

        field.classList.toggle('invalid', !valid);
        if (!valid) {
          hasError = true;
          if (!firstInvalid) firstInvalid = input;
        }
      });

      if (hasError) {
        e.preventDefault();
        firstInvalid.focus();
        return;
      }

      // validation passed — show loading state and let the form submit normally
      const submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) {
        submitBtn.setAttribute('data-loading', 'true');
        submitBtn.disabled = true;
        const label = submitBtn.querySelector('.btn-label');
        if (label) label.textContent = 'Logging in...';
      }
    });

    form.querySelectorAll('.field input').forEach(input => {
      input.addEventListener('input', () => {
        input.closest('.field').classList.remove('invalid');
      });
    });
  });
});
</script>

@endsection