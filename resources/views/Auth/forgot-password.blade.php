@extends('Auth.cover')
@section('content')

<style>
	.alert-danger{
  display: flex;
  gap: 12px;
  padding: 13px 15px;
  border-radius: var(--radius-sm);
  background: var(--danger-100);
  border: 1px solid rgba(193,68,58,0.28);
  color: var(--danger);
  font-size: 13.5px;
  font-weight: 500;
  margin-bottom: 22px;
}
.btn[data-loading="true"]{ pointer-events: none; opacity: 0.85; }
.btn-spinner{
  width: 16px; height: 16px;
  border: 2px solid rgba(255,255,255,0.35);
  border-top-color: #fff;
  border-radius: 50%;
  animation: btn-spin 0.6s linear infinite;
  display: none;
}
.btn[data-loading="true"] .btn-spinner{ display: inline-block; }
@keyframes btn-spin{ to{ transform: rotate(360deg); } }
</style>
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
    <div class="nav-actions">
      <span style="font-size:14px; color:var(--ink-soft);">Remembered it?</span>
      <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
    </div>
  </div>
</header>

<main class="auth-main">

  <aside class="auth-side">
    <div class="auth-side-top">
      <div class="auth-quote">
        <span class="eyebrow">Account recovery</span>
        <h2>Locked out doesn't mean losing touch with your case.</h2>
        <p>We'll send a secure reset link to your registered email so you can get straight back to your reports.</p>
      </div>
    </div>

    <div class="mandate-list">
      <div class="mandate-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
        <div>
          <h4>Links expire in 30 minutes</h4>
          <p>Reset links are single-use and time-limited for your security.</p>
        </div>
      </div>
      <div class="mandate-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="m9 12 2 2 4-4"/></svg>
        <div>
          <h4>Your case data stays put</h4>
          <p>Resetting your password never affects your reports, evidence or messages.</p>
        </div>
      </div>
    </div>

    <div class="auth-side-bottom">
      <div class="side-metric"><b>30 min</b><span>Link validity</span></div>
      <div class="side-metric"><b>1-use</b><span>Per reset link</span></div>
    </div>
  </aside>

  <div class="auth-panel">
    <div class="auth-card">

      @php
        $flashStatus = session('status');
        $flashMessage = session('message');
        $flashErrors = session('errors', []); // raw array from $e->errors(), NOT the ViewErrorBag
        $emailError = $flashErrors['email'][0] ?? null;
        $showSuccess = $flashStatus === 'success';
      @endphp

      <!-- STEP 1: request form -->
      <div id="request-panel" class="{{ $showSuccess ? 'hidden' : '' }}">
        <a href="{{ route('login') }}" class="back-link">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
          Back to log in
        </a>

        <div class="auth-card-head">
          <h1>Reset your password</h1>
          <p>Enter the email address linked to your account and we'll send you a reset link.</p>
        </div>

        @if($flashStatus === 'error' && $flashMessage && !$emailError)
          <div class="alert-danger" role="alert">
            {{ $flashMessage }}
          </div>
        @endif

        <form
          data-validate
          action="{{ route('submit-forgot-password') }}"
          method="POST"
          novalidate
        >
          @csrf

          <div class="field {{ $emailError ? 'invalid' : '' }}">
            <label for="forgot-email">Email address</label>

            <div class="input-wrap has-icon">
              <span class="input-icon">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <rect x="3" y="5" width="18" height="14" rx="2"/>
                  <path d="m3 7 9 6 9-6"/>
                </svg>
              </span>

              <input
                type="email"
                id="forgot-email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter email ex: samarmutesi2004@gmail.com"
                required
              >
            </div>

            <p class="error-text">
              {{ $emailError ?: 'Enter the email address linked to your account.' }}
            </p>
          </div>

          <button type="submit" class="btn btn-primary btn-block btn-lg" id="reset-submit">
            <span class="btn-spinner"></span>
            <span class="btn-label">Send reset link</span>
          </button>
        </form>
      </div>

      <!-- STEP 2: success state -->
      <div id="success-panel" class="success-state {{ $showSuccess ? '' : 'hidden' }}">
        <div class="success-icon">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="m3 7 9 6 9-6v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/><path d="M21 7 12 13 3 7"/></svg>
        </div>
        <h1>Check your inbox</h1>
        <p>We've sent a password reset link to<br><span class="success-email" id="sent-email">{{ old('email', $showSuccess ? request()->old('email') : '') }}</span></p>
        <p style="margin-top:18px;">Didn't get it? Check your spam folder, or</p>
        <button class="btn btn-ghost btn-block" style="margin-top:14px;" id="resend-btn">Resend the link</button>
        <a href="{{ route('login') }}" class="btn btn-primary btn-block" style="margin-top:12px;">Back to log in</a>
      </div>

    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('form[data-validate]').forEach(form => {

        form.addEventListener('submit', function (e) {

            let valid = true;

            form.querySelectorAll('[required]').forEach(input => {
                const field = input.closest('.field');
                if (!field) return;

                let isValid = true;

                if (input.value.trim() === '') {
                    isValid = false;
                }

                if (isValid && input.type === 'email') {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(input.value.trim())) {
                        isValid = false;
                    }
                }

                if (isValid) {
                    field.classList.remove('invalid');
                } else {
                    field.classList.add('invalid');
                    valid = false;
                }
            });

            if (!valid) {
                e.preventDefault();
                return;
            }

            // validation passed — show loading state on the submit button
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.setAttribute('data-loading', 'true');
                submitBtn.disabled = true;
                const label = submitBtn.querySelector('.btn-label');
                if (label) label.textContent = 'Sending...';
            }
        });

        form.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function () {
                const field = input.closest('.field');
                if (!field) return;
                if (input.value.trim() !== '') {
                    field.classList.remove('invalid');
                }
            });
        });

    });

});
</script>

@endsection