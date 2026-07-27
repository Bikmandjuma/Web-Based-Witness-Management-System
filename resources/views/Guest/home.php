@extends('Guest.cover')
@section('content')
<!-- ================= HERO ================= -->
<style>
  /* ============================================================
   UMUTEKANO — Witness Management Portal
   Design tokens
   ============================================================ */

@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap');

:root{
  /* color */
  --bg:            #ffffff;
  --bg-subtle:     #f6f8fb;
  --bg-tint:       #eef2f7;
  --ink:           #10192b;
  --ink-soft:      #52607a;
  --ink-faint:     #8a94a8;

  --primary:       #17335c;
  --primary-700:   #0f2440;
  --primary-100:   #e7ecf3;

  --accent:        #d99a2b;
  --accent-600:    #b87c17;
  --accent-100:    #fbf1de;

  --verified:      #2f8f5b;
  --verified-100:  #e6f4ec;

  --danger:        #c1443a;
  --danger-100:    #fbeae8;

  --border:        #e3e8ef;
  --border-strong: #c9d2df;

  /* type */
  --font-display: 'Space Grotesk', 'Inter', sans-serif;
  --font-body:    'Inter', sans-serif;
  --font-mono:    'IBM Plex Mono', monospace;

  /* shape */
  --radius-sm: 6px;
  --radius-md: 10px;
  --radius-lg: 18px;
  --shadow-sm: 0 1px 2px rgba(16, 25, 43, 0.06);
  --shadow-md: 0 8px 24px rgba(16, 25, 43, 0.08);
  --shadow-lg: 0 20px 48px rgba(16, 25, 43, 0.12);

  --maxw: 1180px;
}

*, *::before, *::after{ box-sizing: border-box; }
html{ scroll-behavior: smooth; }
html, body{ overflow-x: hidden; }
body{
  margin: 0;
  background: var(--bg);
  color: var(--ink);
  font-family: var(--font-body);
  font-size: 16px;
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
}
.mobile-only-link{ display: none; }
h1,h2,h3,h4{
  font-family: var(--font-display);
  color: var(--ink);
  line-height: 1.15;
  margin: 0;
  letter-spacing: -0.01em;
}
p{ margin: 0; }
a{ color: inherit; text-decoration: none; }
ul{ margin: 0; padding: 0; list-style: none; }
img, svg{ display: block; max-width: 100%; }
button{ font-family: inherit; cursor: pointer; }
input{ font-family: inherit; }

:focus-visible{
  outline: 2px solid var(--accent-600);
  outline-offset: 2px;
}

.container{
  max-width: var(--maxw);
  margin: 0 auto;
  padding: 0 32px;
}

.eyebrow{
  font-family: var(--font-mono);
  font-size: 12.5px;
  font-weight: 500;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--primary);
  display: inline-flex;
  align-items: center;
  gap: 10px;
}
.eyebrow::before{
  content: "";
  width: 7px; height: 7px;
  border-radius: 50%;
  background: var(--accent);
  flex: none;
}

/* ---------- buttons ---------- */
.btn{
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  font-family: var(--font-body);
  font-weight: 600;
  font-size: 15px;
  padding: 13px 24px;
  border-radius: var(--radius-sm);
  border: 1.5px solid transparent;
  transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease, border-color .15s ease;
  white-space: nowrap;
}
.btn-primary{
  background: var(--primary);
  color: #fff;
  box-shadow: var(--shadow-sm);
}
.btn-primary:hover{ background: var(--primary-700); transform: translateY(-1px); box-shadow: var(--shadow-md); }

.btn-accent{
  background: var(--accent);
  color: var(--primary-700);
}
.btn-accent:hover{ background: var(--accent-600); color: #fff; transform: translateY(-1px); box-shadow: var(--shadow-md); }

.btn-ghost{
  background: transparent;
  color: var(--primary);
  border-color: var(--border-strong);
}
.btn-ghost:hover{ border-color: var(--primary); background: var(--primary-100); }

.btn-block{ width: 100%; }
.btn-lg{ padding: 15px 28px; font-size: 16px; }

/* ============================================================
   NAV
   ============================================================ */
.nav{
  position: sticky;
  top: 0;
  z-index: 40;
  background: rgba(255,255,255,0.86);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--border);
}
.nav-row{
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 76px;
}
.brand{
  display: flex;
  align-items: center;
  gap: 11px;
}
.brand-mark{
  width: 36px; height: 36px;
  flex: none;
}
.brand-name{
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 19px;
  letter-spacing: -0.01em;
}
.brand-name span{ color: var(--accent-600); }
.brand-sub{
  font-family: var(--font-mono);
  font-size: 10.5px;
  letter-spacing: 0.08em;
  color: var(--ink-faint);
  text-transform: uppercase;
  margin-top: 1px;
}

.nav-links{
  display: flex;
  align-items: center;
  gap: 34px;
}
.nav-links a{
  font-size: 14.5px;
  font-weight: 500;
  color: var(--ink-soft);
}
.nav-links a:hover{ color: var(--primary); }

.nav-actions{ display: flex; align-items: center; gap: 12px; }
.nav-toggle{
  display: none;
  width: 40px; height: 40px;
  border: 1px solid var(--border-strong);
  border-radius: var(--radius-sm);
  background: #fff;
  align-items: center;
  justify-content: center;
}

/* ============================================================
   HERO
   ============================================================ */
.hero{
  padding: 76px 0 40px;
}
.hero-grid{
  display: grid;
  grid-template-columns: 1.05fr 0.95fr;
  gap: 56px;
  align-items: center;
}
.hero h1{
  font-size: 47px;
  margin-top: 18px;
}
.hero-lede{
  margin-top: 22px;
  font-size: 17.5px;
  color: var(--ink-soft);
  max-width: 46ch;
}
.hero-actions{
  display: flex;
  align-items: center;
  gap: 16px;
  margin-top: 34px;
  flex-wrap: wrap;
}
.hero-note{
  font-size: 13px;
  color: var(--ink-faint);
  font-family: var(--font-mono);
}

.hero-stats{
  display: flex;
  gap: 34px;
  margin-top: 48px;
  padding-top: 28px;
  border-top: 1px solid var(--border);
}
.stat b{
  display: block;
  font-family: var(--font-display);
  font-size: 26px;
  color: var(--primary);
}
.stat span{
  font-size: 12.5px;
  color: var(--ink-faint);
}

/* ---- signature element: evidence tag card ---- */
.tag-wrap{
  position: relative;
  display: flex;
  justify-content: center;
}
.evidence-tag{
  position: relative;
  width: 360px;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  padding: 26px 26px 22px;
  transform: rotate(2.5deg);
}
.evidence-tag::before{
  content: "";
  position: absolute;
  left: -11px; top: 50%;
  width: 22px; height: 22px;
  background: var(--bg);
  border: 1px solid var(--border);
  border-radius: 50%;
  transform: translateY(-50%);
}
.tag-top{
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}
.tag-id{
  font-family: var(--font-mono);
  font-size: 12px;
  color: var(--ink-faint);
  letter-spacing: 0.03em;
}
.tag-status{
  font-family: var(--font-mono);
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  background: var(--accent-100);
  color: var(--accent-600);
  padding: 5px 10px;
  border-radius: 999px;
}
.tag-divider{
  border: none;
  border-top: 1.5px dashed var(--border-strong);
  margin: 18px 0;
}
.tag-row{
  display: flex;
  justify-content: space-between;
  font-size: 13.5px;
  padding: 7px 0;
}
.tag-row span:first-child{ color: var(--ink-faint); }
.tag-row span:last-child{ font-weight: 600; }
.tag-bars{
  display: flex;
  align-items: flex-end;
  gap: 3px;
  height: 30px;
  margin-top: 16px;
}
.tag-bars i{
  display: block;
  width: 3px;
  background: var(--ink);
  opacity: .78;
}
.seal{
  position: absolute;
  right: -18px;
  bottom: -18px;
  width: 92px; height: 92px;
  border-radius: 50%;
  background: #fff;
  border: 2px dashed var(--verified);
  display: flex;
  align-items: center;
  justify-content: center;
  transform: rotate(-14deg);
  box-shadow: var(--shadow-md);
}
.seal-inner{
  text-align: center;
  color: var(--verified);
  font-family: var(--font-mono);
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.06em;
  line-height: 1.3;
}
.seal-inner svg{ margin: 0 auto 2px; }

.float-card{
  position: absolute;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-md);
  padding: 12px 14px;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 12.5px;
  font-weight: 600;
}
.float-card svg{ flex: none; }
.float-1{ top: -10px; left: -28px; transform: rotate(-4deg); }
.float-2{ bottom: 30px; right: -34px; transform: rotate(3deg); color: var(--verified); }

/* ============================================================
   SECTIONS (generic)
   ============================================================ */
.section{ padding: 96px 0; }
.section-tight{ padding: 64px 0; }
.section-alt{ background: var(--bg-subtle); }
.section-head{
  max-width: 640px;
  margin-bottom: 52px;
}
.section-head h2{
  font-size: 33px;
  margin-top: 14px;
}
.section-head p{
  margin-top: 16px;
  color: var(--ink-soft);
  font-size: 16px;
}
.section-head.center{ margin-left: auto; margin-right: auto; text-align: center; }

/* about / description */
.about-grid{
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  gap: 64px;
  align-items: start;
}
.about-copy p + p{ margin-top: 16px; }
.about-copy p{ color: var(--ink-soft); font-size: 16px; }
.about-copy strong{ color: var(--ink); }

.mandate-list{ display: flex; flex-direction: column; gap: 18px; }
.mandate-item{
  display: flex;
  gap: 14px;
  padding: 18px;
  background: var(--bg-subtle);
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
}
.mandate-item svg{ flex: none; color: var(--primary); margin-top: 2px; }
.mandate-item h4{ font-size: 15px; font-family: var(--font-body); font-weight: 700; }
.mandate-item p{ font-size: 13.5px; color: var(--ink-soft); margin-top: 4px; }

/* feature cards */
.feature-grid{
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 22px;
}
.feature-card{
  padding: 30px 26px;
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  background: #fff;
  transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease;
}
.feature-card:hover{ box-shadow: var(--shadow-md); transform: translateY(-3px); border-color: var(--border-strong); }
.feature-icon{
  width: 46px; height: 46px;
  border-radius: 12px;
  background: var(--primary-100);
  color: var(--primary);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 20px;
}
.feature-card h3{ font-size: 18px; }
.feature-card p{ margin-top: 10px; font-size: 14.5px; color: var(--ink-soft); }

/* steps */
.steps{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0;
  position: relative;
}
.step{
  position: relative;
  padding: 0 20px 0 0;
}
.step:not(:last-child)::after{
  content:"";
  position: absolute;
  top: 23px;
  right: -10px;
  width: calc(100% - 26px);
  border-top: 1.5px dashed var(--border-strong);
}
.step-num{
  font-family: var(--font-mono);
  font-weight: 600;
  font-size: 13px;
  width: 46px; height: 46px;
  border-radius: 50%;
  border: 1.5px solid var(--primary);
  color: var(--primary);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 20px;
  background: #fff;
  position: relative;
  z-index: 1;
}
.step h4{ font-size: 16px; font-family: var(--font-body); font-weight: 700; }
.step p{ margin-top: 8px; font-size: 13.5px; color: var(--ink-soft); }

/* trust / security */
.trust-panel{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
  background: var(--primary);
  border-radius: 24px;
  padding: 56px;
  color: #fff;
}
.trust-panel .eyebrow{ color: var(--accent); }
.trust-panel .eyebrow::before{ background: var(--accent); }
.trust-panel h2{ color: #fff; font-size: 30px; margin-top: 14px; }
.trust-panel p{ color: rgba(255,255,255,0.78); margin-top: 14px; font-size: 15.5px; }
.trust-grid{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 22px;
}
.trust-item{
  padding: 20px;
  border: 1px solid rgba(255,255,255,0.16);
  border-radius: var(--radius-md);
  background: rgba(255,255,255,0.05);
}
.trust-item b{
  font-family: var(--font-display);
  font-size: 24px;
  color: var(--accent);
  display: block;
}
.trust-item span{ font-size: 12.5px; color: rgba(255,255,255,0.72); }

/* cta banner */
.cta-banner{
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  border: 1px solid var(--border);
  border-radius: 24px;
  padding: 48px 56px;
  background: linear-gradient(135deg, var(--bg-subtle), #fff);
}
.cta-banner h2{ font-size: 27px; }
.cta-banner p{ color: var(--ink-soft); margin-top: 10px; }

/* footer */
.site-footer{
  border-top: 1px solid var(--border);
  padding: 56px 0 28px;
}
.footer-grid{
  display: grid;
  grid-template-columns: 1.4fr 1fr 1fr 1fr;
  gap: 40px;
}
.footer-col h5{
  font-size: 12.5px;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--ink-faint);
  font-family: var(--font-mono);
  margin-bottom: 16px;
}
.footer-col ul{ display: flex; flex-direction: column; gap: 11px; }
.footer-col a{ font-size: 14px; color: var(--ink-soft); }
.footer-col a:hover{ color: var(--primary); }
.footer-desc{ color: var(--ink-soft); font-size: 14px; max-width: 34ch; margin-top: 14px; }
.footer-bottom{
  margin-top: 48px;
  padding-top: 24px;
  border-top: 1px solid var(--border);
  display: flex;
  justify-content: space-between;
  font-size: 12.5px;
  color: var(--ink-faint);
  flex-wrap: wrap;
  gap: 10px;
}

/* ============================================================
   AUTH PAGES
   ============================================================ */
.auth-body{
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.auth-main{
  flex: 1;
  display: grid;
  grid-template-columns: 0.95fr 1.05fr;
}
.auth-side{
  background: var(--bg-subtle);
  border-right: 1px solid var(--border);
  padding: 56px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
  overflow: hidden;
}
.auth-side-top .brand{ margin-bottom: 0; }
.auth-quote{
  max-width: 380px;
}
.auth-quote .eyebrow{ margin-bottom: 18px; }
.auth-quote h2{
  font-size: 26px;
  line-height: 1.25;
}
.auth-quote p{
  margin-top: 16px;
  color: var(--ink-soft);
  font-size: 14.5px;
}
.auth-side-bottom{
  display: flex;
  gap: 24px;
}
.side-metric b{
  display: block;
  font-family: var(--font-display);
  font-size: 22px;
  color: var(--primary);
}
.side-metric span{ font-size: 12px; color: var(--ink-faint); }

.auth-side .evidence-tag{
  width: 280px;
  transform: rotate(-3deg);
  margin: 0 auto;
}

.auth-panel{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 56px 32px;
}
.auth-card{ width: 100%; max-width: 400px; }
.auth-card-head{ margin-bottom: 32px; }
.auth-card-head h1{ font-size: 28px; }
.auth-card-head p{ margin-top: 10px; color: var(--ink-soft); font-size: 14.5px; }

.field{ margin-bottom: 18px; }
.field label{
  display: block;
  font-size: 13.5px;
  font-weight: 600;
  margin-bottom: 7px;
  color: var(--ink);
}
.field-hint{
  font-size: 12px;
  color: var(--ink-faint);
  margin-top: 6px;
}
.input-wrap{ position: relative; }
.input-wrap input, .input-wrap select{
  width: 100%;
  padding: 12.5px 14px;
  border: 1.5px solid var(--border-strong);
  border-radius: var(--radius-sm);
  font-size: 14.5px;
  background: #fff;
  color: var(--ink);
  transition: border-color .15s ease, box-shadow .15s ease;
}
.input-wrap input::placeholder{ color: var(--ink-faint); }
.input-wrap input:focus, .input-wrap select:focus{
  border-color: var(--primary);
  box-shadow: 0 0 0 3.5px var(--primary-100);
  outline: none;
}
.input-wrap.has-icon input{ padding-left: 42px; }
.input-icon{
  position: absolute;
  left: 13px; top: 50%;
  transform: translateY(-50%);
  color: var(--ink-faint);
  pointer-events: none;
}
.input-toggle{
  position: absolute;
  right: 12px; top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: var(--ink-faint);
  padding: 4px;
  display: flex;
}
.input-toggle:hover{ color: var(--primary); }

.field.invalid input{ border-color: var(--danger); box-shadow: 0 0 0 3.5px var(--danger-100); }
.error-text{
  display: none;
  font-size: 12.5px;
  color: var(--danger);
  margin-top: 6px;
  font-weight: 500;
}
.field.invalid .error-text{ display: block; }

.field-row{ display: flex; justify-content: space-between; align-items: center; }
.link-sm{ font-size: 13px; font-weight: 600; color: var(--primary); }
.link-sm:hover{ text-decoration: underline; }

.check-row{
  display: flex;
  align-items: flex-start;
  gap: 10px;
  margin-bottom: 22px;
}
.check-row input{ margin-top: 3px; accent-color: var(--primary); width: 16px; height: 16px; flex: none; }
.check-row label{ font-size: 13px; color: var(--ink-soft); }

.strength-meter{
  display: flex;
  gap: 4px;
  margin-top: 9px;
}
.strength-meter i{
  height: 4px;
  flex: 1;
  border-radius: 2px;
  background: var(--border);
}

.divider-row{
  display: flex;
  align-items: center;
  gap: 14px;
  margin: 26px 0;
  color: var(--ink-faint);
  font-size: 12.5px;
}
.divider-row::before, .divider-row::after{
  content: "";
  flex: 1;
  border-top: 1px solid var(--border);
}

.auth-switch{
  text-align: center;
  margin-top: 26px;
  font-size: 14px;
  color: var(--ink-soft);
}

.back-link{
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--ink-soft);
  margin-bottom: 30px;
}
.back-link:hover{ color: var(--primary); }

.alert-banner{
  display: flex;
  gap: 12px;
  padding: 13px 15px;
  border-radius: var(--radius-sm);
  background: var(--verified-100);
  border: 1px solid rgba(47,143,91,0.28);
  color: var(--verified);
  font-size: 13.5px;
  font-weight: 500;
  margin-bottom: 22px;
  align-items: flex-start;
}
.alert-banner svg{ flex: none; margin-top: 1px; }

.success-state{ text-align: center; }
.success-icon{
  width: 64px; height: 64px;
  border-radius: 50%;
  background: var(--verified-100);
  color: var(--verified);
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 22px;
}
.success-state h1{ font-size: 24px; }
.success-state p{ margin-top: 12px; color: var(--ink-soft); font-size: 14.5px; }
.success-email{
  font-family: var(--font-mono);
  font-weight: 600;
  color: var(--ink);
}
.hidden{ display: none !important; }

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 980px){
  .hero-grid, .about-grid, .trust-panel{ grid-template-columns: 1fr; }
  .feature-grid{ grid-template-columns: 1fr 1fr; }
  .steps{ grid-template-columns: 1fr 1fr; row-gap: 34px; }
  .step:not(:last-child)::after{ display: none; }
  .footer-grid{ grid-template-columns: 1fr 1fr; row-gap: 32px; }
  .auth-main{ grid-template-columns: 1fr; }
  .auth-side{ display: none; }
  .tag-wrap{ margin-top: 40px; }
}
@media (max-width: 680px){
  .container{ padding: 0 20px; }
  .nav-links{
    display: none;
    position: absolute;
    top: 76px; left: 0; right: 0;
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
    background: #fff;
    border-bottom: 1px solid var(--border);
    padding: 12px 20px 20px;
    box-shadow: var(--shadow-md);
  }
  .nav-links.nav-links-open{ display: flex; }
  .nav-links a{ width: 100%; padding: 11px 0; border-bottom: 1px solid var(--border); }
  .nav-links a:last-child{ border-bottom: none; }
  .mobile-only-link{ display: block; font-weight: 700; color: var(--primary) !important; }
  .nav-actions{ display: none; }
  .nav-toggle{ display: flex; }
  .hero h1{ font-size: 32px; }
  .feature-grid{ grid-template-columns: 1fr; }
  .steps{ grid-template-columns: 1fr; }
  .cta-banner{ flex-direction: column; align-items: flex-start; text-align: left; padding: 36px; }
  .trust-panel{ padding: 32px; }
  .trust-grid{ grid-template-columns: 1fr; }
  .footer-grid{ grid-template-columns: 1fr; }
  .footer-bottom{ flex-direction: column; }
  .evidence-tag{ width: 100%; max-width: 300px; transform: rotate(1.5deg); }
  .float-card{ display: none; }
  .tag-wrap{ padding: 0 10px; }
}

/* reveal-on-scroll */
[data-reveal]{
  opacity: 0;
  transform: translateY(16px);
  transition: opacity .6s ease, transform .6s ease;
}
[data-reveal].is-visible{ opacity: 1; transform: translateY(0); }

@media (prefers-reduced-motion: reduce){
  *{ transition: none !important; scroll-behavior: auto !important; }
  [data-reveal]{ opacity: 1; transform: none; }
}

</style>
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
          <a href="register.html" class="btn btn-primary btn-lg">Create a witness account</a>
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
          <a href="register.html" class="btn btn-primary btn-lg">Create account</a>
          <a href="login.html" class="btn btn-ghost btn-lg">I already have one</a>
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