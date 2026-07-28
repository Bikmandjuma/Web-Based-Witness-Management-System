@extends('Guest.cover')
@section('content')
<!-- ================= HERO ================= -->
  <section class="hero">
    <div class="container hero-grid">
      <div>
        <span class="eyebrow">Case Study: Rwanda Investigation Bureau (RIB)</span>
        <h1>A safer way to come forward as a witness.</h1>
        <p class="hero-lede">
          Web-Based Witness Management System built for the RIB. It replaces
          physical visits, phone calls and paper-based records with a secure platform where
          citizens report crimes, submit digital evidence, and track a case through to
          resolution without ever losing confidentiality along the way.
        </p>
        <div class="hero-actions">
          <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create a witness account</a>
          <a href="#how-it-works" class="btn btn-ghost btn-lg">See how reporting works</a>
        </div>
        <p class="hero-note">No case is too small. Reports are reviewed by a real investigator, always.</p>

        <div class="hero-stats">
          <div class="stat"><b>3</b><span>Role-based access tiers</span></div>
          <div class="stat"><b>24/7</b><span>Report submission window</span></div>
          <div class="stat"><b>256-bit</b><span>Evidence encryption</span></div>
        </div>
      </div>

      <div class="tag-wrap">
        <div class="float-card float-1">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#17335C" stroke-width="2"><path d="M12 2l3 6 6 .9-4.5 4.3 1 6.3L12 16.8 6.5 19.5l1-6.3L3 8.9 9 8z"/></svg>
          Investigator assigned
        </div>

        <div class="evidence-tag" data-reveal>
          <div class="tag-top">
            <div>
              <div class="eyebrow" style="margin-bottom:4px;">Incident report</div>
              <div class="tag-id">REF · RIB-2026-04821</div>
            </div>
            <span class="tag-status">Under review</span>
          </div>
          <hr class="tag-divider">
          <div class="tag-row"><span>Filed</span><span>18 Jul 2026, 21:42</span></div>
          <div class="tag-row"><span>Category</span><span>Theft &amp; burglary</span></div>
          <div class="tag-row"><span>Evidence attached</span><span>2 photos, 1 clip</span></div>
          <div class="tag-row"><span>Confidentiality</span><span>Identity sealed</span></div>
          <div class="tag-bars" aria-hidden="true">
            <i style="height:60%"></i><i style="height:100%"></i><i style="height:40%"></i><i style="height:80%"></i>
            <i style="height:30%"></i><i style="height:70%"></i><i style="height:90%"></i><i style="height:50%"></i>
            <i style="height:65%"></i><i style="height:35%"></i><i style="height:85%"></i><i style="height:45%"></i>
          </div>
          <div class="seal">
            <div class="seal-inner">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2F8F5B" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
              SECURE<br>CHANNEL
            </div>
          </div>
        </div>

        <div class="float-card float-2">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.5-3.4 8-7.4 8-12V6l-8-3-8 3v4c0 4.6 2.5 8.6 8 12Z"/></svg>
          Identity never shared
        </div>
      </div>
    </div>
  </section>

  <!-- ================= ABOUT / FULL DESCRIPTION ================= -->
  <section class="section" id="about">
    <div class="container about-grid">
      <div data-reveal>
        <span class="eyebrow">About the project</span>
        <h2 style="margin-top:14px; font-size:30px;">Why RIB needed a witness management system</h2>
        <div class="about-copy" style="margin-top:20px;">
          <p>
            The <strong>Rwanda Investigation Bureau (RIB)</strong> investigates crimes such as
            theft, robbery, fraud, cybercrime and corruption, and depends heavily on witness
            statements and evidence to build a case. Until now, witness-related activity has
            been conducted mainly through <strong>physical visits, paper-based records and
            telephone communication</strong> a process that causes delays, loses records, and
            limits how many people can realistically take part.
          </p>
          <p>
            Many crimes go unreported, or are reported late, because witnesses find physical
            visits and phone calls inconvenient, time-consuming and costly especially for
            people living far from an investigation office. Evidence stored manually is
            difficult to organise and retrieve, and witnesses often fear exposing their
            identity, which discourages the public from coming forward at all.
          </p>
          <p>
            <strong>Web-Based Witness Management System</strong> was built to close that gap: a secure web-based platform
            that lets citizens report incidents, submit digital evidence and communicate with
            investigators in real time, while giving RIB a centralised, confidential system for
            managing every witness account, report and piece of evidence.
          </p>
        </div>
      </div>

      <div class="mandate-list" data-reveal>
        <span class="eyebrow" style="margin-bottom:6px; display:inline-flex;">Specific objectives</span>
        <div class="mandate-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
          <div>
            <h4>i. A user-friendly reporting platform</h4>
            <p>Design an interface simple enough for any citizen to report a crime without training or assistance.</p>
          </div>
        </div>
        <div class="mandate-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16v12H7l-3 3Z"/></svg>
          <div>
            <h4>ii. Centralised witness–investigator communication</h4>
            <p>Give witnesses and investigators one direct channel, instead of scattered calls and office visits.</p>
          </div>
        </div>
        <div class="mandate-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="14" rx="2"/><path d="m3 15 5-5 4 4 5-6 4 5"/></svg>
          <div>
            <h4>iii. Secure digital evidence submission</h4>
            <p>Let witnesses upload photos, videos and documents, and let investigators access and manage that evidence safely.</p>
          </div>
        </div>
        <div class="mandate-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="m9 12 2 2 4-4"/></svg>
          <div>
            <h4>iv. Tested functionality &amp; security</h4>
            <p>Evaluate the system's functionality, usability, security and effectiveness before adoption.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= FEATURES ================= -->
  <section class="section section-alt" id="features">
    <div class="container">
      <div class="section-head center">
        <span class="eyebrow">The platform</span>
        <h2>Three roles, one connected case record</h2>
        <p>Witnesses, investigators and administrators each get an interface built for exactly what they need to do.</p>
      </div>

      <div class="feature-grid">
        <div class="feature-card" data-reveal>
          <div class="feature-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
          </div>
          <h3>Secure incident reporting</h3>
          <p>Submit a detailed report in minutes location, description, date and time routed straight into RIB's case queue.</p>
        </div>
        <div class="feature-card" data-reveal>
          <div class="feature-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="14" rx="2"/><path d="m3 15 5-5 4 4 5-6 4 5"/></svg>
          </div>
          <h3>Secure evidence submission &amp; management</h3>
          <p>Witnesses upload photographs, videos and documents; investigators access and manage that evidence from one place.</p>
        </div>
        <div class="feature-card" data-reveal>
          <div class="feature-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16v12H7l-3 3Z"/></svg>
          </div>
          <h3>Direct investigator messaging</h3>
          <p>Answer follow-up questions and receive updates through a private thread tied to your specific case.</p>
        </div>
        <div class="feature-card" data-reveal>
          <div class="feature-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>
          </div>
          <h3>Real-time case tracking</h3>
          <p>Follow a report from "Submitted" to "Under review" to "Resolved" no need to call or visit an office to check.</p>
        </div>
        <div class="feature-card" data-reveal>
          <div class="feature-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
          </div>
          <h3>Confidential by default</h3>
          <p>Passwords are encrypted, access is role-based, and witness identity is sealed from anyone outside the assigned case.</p>
        </div>
        <div class="feature-card" data-reveal>
          <div class="feature-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>
          </div>
          <h3>Administrator oversight</h3>
          <p>RIB administrators assign reports to investigators, manage accounts, and audit activity logs across every case.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= HOW IT WORKS ================= -->
  <section class="section" id="how-it-works">
    <div class="container">
      <div class="section-head">
        <span class="eyebrow">Process</span>
        <h2>From incident to investigator, in four steps</h2>
      </div>
      <div class="steps">
        <div class="step" data-reveal>
          <div class="step-num">01</div>
          <h4>Create your account</h4>
          <p>Register with your name, phone number and email your identity stays private to RIB, always.</p>
        </div>
        <div class="step" data-reveal>
          <div class="step-num">02</div>
          <h4>Submit your report</h4>
          <p>Describe what happened, where, and when as much or as little detail as you're able to give.</p>
        </div>
        <div class="step" data-reveal>
          <div class="step-num">03</div>
          <h4>Attach evidence</h4>
          <p>Upload photos, video or documents that support your report directly from your device.</p>
        </div>
        <div class="step" data-reveal>
          <div class="step-num">04</div>
          <h4>Track &amp; stay in touch</h4>
          <p>Follow status updates and message your assigned investigator until the case is resolved.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECURITY / TRUST ================= -->
  <section class="section" id="security">
    <div class="container">
      <div class="trust-panel" data-reveal>
        <div>
          <span class="eyebrow">Security &amp; confidentiality</span>
          <h2>Your safety is the whole point of this system.</h2>
          <p>
            Web-Based Witness Management System was built on the principle that witnesses shouldn't have to choose between coming forward and staying safe. Every design decision from password
            hashing to role-based dashboards exists to protect that choice.
          </p>
        </div>
        <div class="trust-grid">
          <div class="trust-item"><b>Role-based</b><span>Investigators only see cases assigned to them</span></div>
          <div class="trust-item"><b>Encrypted</b><span>Passwords and evidence files are never stored in plain form</span></div>
          <div class="trust-item"><b>Audited</b><span>Every login and status change is logged for accountability</span></div>
          <div class="trust-item"><b>Sealed identity</b><span>Your details are never visible outside your case thread</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= CTA ================= -->
  <section class="section-tight">
    <div class="container">
      <div class="cta-banner" data-reveal>
        <div>
          <h2>Ready to report, or just want to see how it works?</h2>
          <p>Creating an account takes less than two minutes no station visit required.</p>
        </div>
        <div style="display:flex; gap:14px; flex-wrap:wrap;">
          <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create account</a>
          <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">I already have one</a>
        </div>
      </div>
    </div>
  </section>
  
  <script>
    // ============================================================
// UMUTEKANO — shared front-end behaviour
// ============================================================

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- mobile nav toggle ---------- */
  const navToggle = document.querySelector('.nav-toggle');
  const navLinks = document.querySelector('.nav-links');
  if (navToggle && navLinks) {
    navToggle.addEventListener('click', () => {
      const open = navLinks.classList.toggle('nav-links-open');
      navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  /* ---------- scroll reveal ---------- */
  const revealEls = document.querySelectorAll('[data-reveal]');
  if ('IntersectionObserver' in window && revealEls.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    revealEls.forEach(el => io.observe(el));
  } else {
    revealEls.forEach(el => el.classList.add('is-visible'));
  }

  /* ---------- password show/hide toggles ---------- */
  document.querySelectorAll('.input-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.parentElement.querySelector('input');
      if (!input) return;
      const isPassword = input.getAttribute('type') === 'password';
      input.setAttribute('type', isPassword ? 'text' : 'password');
      btn.innerHTML = isPassword ? eyeOffIcon() : eyeIcon();
      btn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
    });
  });

  /* ---------- password strength meter (register page) ---------- */
  const pwInput = document.querySelector('[data-password-strength]');
  const meter = document.querySelector('.strength-meter');
  if (pwInput && meter) {
    const bars = meter.querySelectorAll('i');
    pwInput.addEventListener('input', () => {
      const score = scorePassword(pwInput.value);
      bars.forEach((bar, i) => {
        bar.style.background = i < score ? strengthColor(score) : 'var(--border)';
      });
    });
  }

  /* ---------- generic client-side validation ---------- */
  document.querySelectorAll('form[data-validate]').forEach(form => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      let valid = true;

      form.querySelectorAll('[required]').forEach(input => {
        const field = input.closest('.field');
        if (!field) return;
        let ok = input.value.trim().length > 0;

        if (ok && input.type === 'email') {
          ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
        }
        if (ok && input.dataset.match) {
          const other = form.querySelector(input.dataset.match);
          if (other) ok = other.value === input.value;
        }
        if (ok && input.type === 'checkbox') {
          ok = input.checked;
        }

        field.classList.toggle('invalid', !ok);
        if (!ok) valid = false;
      });

      if (valid) {
        const successHandler = form.dataset.onSuccess;
        if (successHandler && typeof window[successHandler] === 'function') {
          window[successHandler](form);
        } else {
          form.classList.add('hidden');
          const done = form.parentElement.querySelector('[data-success-panel]');
          if (done) done.classList.remove('hidden');
        }
      }
    });

    // clear invalid state as the person types
    form.querySelectorAll('input').forEach(input => {
      input.addEventListener('input', () => {
        const field = input.closest('.field');
        if (field) field.classList.remove('invalid');
      });
    });
  });

});

/* ---------- helpers ---------- */
function scorePassword(value) {
  let score = 0;
  if (value.length >= 8) score++;
  if (/[A-Z]/.test(value) && /[a-z]/.test(value)) score++;
  if (/\d/.test(value)) score++;
  if (/[^A-Za-z0-9]/.test(value)) score++;
  return score;
}
function strengthColor(score) {
  if (score <= 1) return 'var(--danger)';
  if (score === 2) return 'var(--accent)';
  return 'var(--verified)';
}
function eyeIcon() {
  return '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>';
}
function eyeOffIcon() {
  return '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 3l18 18M10.6 10.6a3 3 0 0 0 4.24 4.24M9.9 5.1A10.9 10.9 0 0 1 12 5c7 0 11 7 11 7a13.2 13.2 0 0 1-3.17 3.88M6.6 6.6C4.2 8.1 2 12 2 12s2.4 4.8 6.2 6.4"/></svg>';
}

  </script>
  @endsection