@extends('Auth.cover')
@section('content')

<style>
.alert-danger{
  display: flex; gap: 12px; padding: 13px 15px; border-radius: var(--radius-sm);
  background: var(--danger-100); border: 1px solid rgba(193,68,58,0.28);
  color: var(--danger); font-size: 13.5px; font-weight: 500; margin-bottom: 22px;
}
</style>

<header class="nav">
  <div class="container nav-row">
    <a href="{{ route('guest.home') }}" class="brand">
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
  <div class="auth-panel" style="margin:0 auto;">
    <div class="auth-card">
      <div class="auth-card-head">
        <h1>Set a new password</h1>
        <p>Choose a strong password you haven't used before.</p>
      </div>

      @if ($errors->any())
        <div class="alert-danger" role="alert">
          <ul style="margin:0; padding-left:16px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="field">
          <label for="reset-email">Email address</label>
          <div class="input-wrap">
            <input type="email" id="reset-email" name="email" value="{{ old('email', $email) }}" required readonly>
          </div>
        </div>

        <div class="field">
          <label for="reset-password">New password</label>
          <div class="input-wrap">
            <input type="password" id="reset-password" name="password" required minlength="8" placeholder="Enter a new password">
            <button type="button" class="input-toggle" aria-label="Show password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
          <p class="field-hint">Use 8+ characters, with a mix of letters, numbers and symbols.</p>
        </div>

        <div class="field">
          <label for="reset-password-confirm">Confirm new password</label>
          <div class="input-wrap">
            <input type="password" id="reset-password-confirm" name="password_confirmation" required minlength="8" placeholder="Re-enter your new password">
            <button type="button" class="input-toggle" aria-label="Show password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-lg">Reset password</button>
      </form>

      <p class="auth-switch">
        <a href="{{ route('login') }}" class="link-sm">Back to log in</a>
      </p>
    </div>
  </div>
</main>

@endsection
