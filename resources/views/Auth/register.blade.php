@extends('Auth.cover')
@section('content')

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
      <span style="font-size:14px; color:var(--ink-soft);">Already registered?</span>
      <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
    </div>
  </div>
</header>

<main class="auth-main">

<!-- left brand panel -->
  <aside class="auth-side">
    <div class="auth-side-top">
      <div class="auth-quote">
        <span class="eyebrow">Join as a witness</span>
        <h2>Two minutes to register. A lifetime of cases made easier to solve.</h2>
        <p>Your account lets you file reports, attach evidence and message your investigator all kept confidential.</p>
      </div>
    </div>

    <div class="mandate-list">
      <div class="mandate-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22c5.5-3.4 8-7.4 8-12V6l-8-3-8 3v4c0 4.6 2.5 8.6 8 12Z"/></svg>
        <div>
          <h4>Identity sealed</h4>
          <p>Only your assigned investigator can ever see your details.</p>
        </div>
      </div>
      <div class="mandate-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 2v4M16 2v4M3 10h18"/></svg>
        <div>
          <h4>One account, every report</h4>
          <p>File multiple reports and track each one from a single dashboard.</p>
        </div>
      </div>
    </div>

    <div class="auth-side-bottom">
      <div class="side-metric"><b>3</b><span>Minutes to complete</span></div>
      <div class="side-metric"><b>Free</b><span>Always, for every citizen</span></div>
    </div>
  </aside>

  <!-- form panel -->
  <div class="auth-panel">
    <div class="auth-card">
      <div class="auth-card-head">
        <h1>Create your witness account</h1>
        <p>It only takes a few details to get started.</p>
      </div>

      <form action="{{ route('register.store') }}" method="POST" data-validate novalidate>
        @csrf

        @if ($errors->any())
          <div class="alert-danger" role="alert" style="margin-bottom:18px;">
            {{ $errors->first() }}
          </div>
        @endif

        <div class="field {{ $errors->has('name') ? 'invalid' : '' }}">
          <label for="reg-name">Full name</label>
          <div class="input-wrap has-icon">
            <span class="input-icon">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6"/></svg>
            </span>
            <input type="text" id="reg-name" name="name" value="{{ old('name') }}" placeholder="Mutesi Samalie" required>
          </div>
          <p class="error-text">{{ $errors->first('name') ?: 'Enter your full name as it should appear on your account.' }}</p>
        </div>

        <div class="field {{ $errors->has('email') ? 'invalid' : '' }}">
          <label for="reg-email">Email address</label>
          <div class="input-wrap has-icon">
            <span class="input-icon">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            </span>
            <input type="email" id="reg-email" name="email" value="{{ old('email') }}" placeholder="samarmutesi2004@gmail.com" required>
          </div>
          <p class="error-text">{{ $errors->first('email') ?: 'Enter a valid email address.' }}</p>
        </div>

        <div class="field {{ $errors->has('phone') ? 'invalid' : '' }}">
          <label for="reg-phone">Phone number</label>
          <div class="input-wrap has-icon">
            <span class="input-icon">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1.1.4 2.2.7 3.2a2 2 0 0 1-.5 2.1L8 10.5a16 16 0 0 0 6 6l1.5-1.3a2 2 0 0 1 2.1-.5c1 .3 2.1.6 3.2.7a2 2 0 0 1 1.7 2Z"/></svg>
            </span>
            <input type="tel" id="reg-phone" name="phone" value="{{ old('phone') }}" placeholder="+250 78 000 0000" required>
          </div>
          <p class="error-text">{{ $errors->first('phone') ?: 'Enter a phone number where an investigator can reach you.' }}</p>
        </div>

        <div class="field {{ $errors->has('password') ? 'invalid' : '' }}">
          <label for="reg-password">Password</label>
          <div class="input-wrap">
            <input type="password" id="reg-password" name="password" placeholder="Create a strong password" data-password-strength required minlength="8">
            <button type="button" class="input-toggle" aria-label="Show password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
          <div class="strength-meter"><i></i><i></i><i></i><i></i></div>
          <p class="field-hint">{{ $errors->first('password') ?: 'Use 8+ characters, with a mix of letters, numbers and symbols.' }}</p>
        </div>

        <div class="field {{ $errors->has('password_confirm') ? 'invalid' : '' }}">
          <label for="reg-password-confirm">Confirm password</label>
          <div class="input-wrap">
            <input type="password" id="reg-password-confirm" name="password_confirm" placeholder="Re-enter your password" data-match="#reg-password" required>
            <button type="button" class="input-toggle" aria-label="Show password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
          <p class="error-text">{{ $errors->first('password_confirm') ?: "Passwords don't match yet." }}</p>
        </div>

        <div class="check-row">
          <input type="checkbox" id="terms" name="terms" required>
          <label for="terms">I understand my report will be reviewed by an RIB investigator and confirm the details I submit are accurate to the best of my knowledge.</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-lg">Create account</button>
      </form>

      <p class="auth-switch">Already have an account? <a href="{{ route('login') }}" class="link-sm">Log in</a></p>
    </div>
  </div>
 </main>

 <script>
 	// auth-validate.js
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('form[data-validate]').forEach(form => {

    // ---- password strength meter ----
    const strengthInput = form.querySelector('[data-password-strength]');
    if (strengthInput) {
      const bars = form.querySelectorAll('.strength-meter i');
      const colors = ['#c1443a', '#d99a2b', '#d99a2b', '#2f8f5b'];

      strengthInput.addEventListener('input', () => {
        const val = strengthInput.value;
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
        if (/\d/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        bars.forEach((bar, i) => {
          bar.style.background = i < score ? colors[score - 1] : 'var(--border)';
        });
      });
    }

    // ---- password match check ----
    const confirmInput = form.querySelector('[data-match]');
    if (confirmInput) {
      const targetSelector = confirmInput.getAttribute('data-match');
      const targetInput = form.querySelector(targetSelector);

      const checkMatch = () => {
        const field = confirmInput.closest('.field');
        if (confirmInput.value && confirmInput.value !== targetInput.value) {
          field.classList.add('invalid');
        } else {
          field.classList.remove('invalid');
        }
      };
      confirmInput.addEventListener('input', checkMatch);
      targetInput.addEventListener('input', checkMatch);
    }

    // ---- show/hide password ----
    form.querySelectorAll('.input-toggle').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = btn.previousElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
      });
    });

    // ---- submit validation ----
    form.addEventListener('submit', (e) => {
      let hasError = false;
      let firstInvalid = null;

      form.querySelectorAll('.field').forEach(field => {
        const input = field.querySelector('input');
        if (!input) return;

        let valid = true;

        if (input.type === 'checkbox') {
          valid = input.checked;
        } else if (input.hasAttribute('required') && !input.value.trim()) {
          valid = false;
        } else if (input.type === 'email' && input.value.trim()) {
          valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
        } else if (input.type === 'tel' && input.value.trim()) {
          valid = /^[\d+\s()-]{7,}$/.test(input.value.trim());
        } else if (input.hasAttribute('minlength')) {
          valid = input.value.length >= parseInt(input.getAttribute('minlength'), 10);
        }

        if (input.hasAttribute('data-match')) {
          const target = form.querySelector(input.getAttribute('data-match'));
          if (input.value !== target.value) valid = false;
        }

        field.classList.toggle('invalid', !valid);
        if (!valid) {
          hasError = true;
          if (!firstInvalid) firstInvalid = input;
        }
      });

      // terms checkbox lives outside .field, handle separately
      const terms = form.querySelector('#terms');
      if (terms && !terms.checked) {
        hasError = true;
        if (!firstInvalid) firstInvalid = terms;
      }

      if (hasError) {
        e.preventDefault();
        if (firstInvalid) firstInvalid.focus();
      }
    });

    // clear red state as user types/fixes
    form.querySelectorAll('.field input').forEach(input => {
      input.addEventListener('input', () => {
        input.closest('.field').classList.remove('invalid');
      });
    });
  });
});
 </script>
@endsection