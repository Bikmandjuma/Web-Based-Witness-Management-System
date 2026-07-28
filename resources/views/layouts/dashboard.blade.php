<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard') — Umutekano</title>
<link rel="stylesheet" href="{{ asset('Guest/assets/styles.css') }}">
<link rel="stylesheet" href="{{ asset('Guest/assets/dashboard.css') }}">
</head>
<body>

<header class="nav dash-header">
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

    <nav class="dash-nav" style="display:flex; align-items:center;">
      @auth
        @if(auth()->user()->isWitness())
          <a href="{{ route('witness.dashboard') }}">My Reports</a>
          <a href="{{ route('witness.reports.create') }}">Report a Crime</a>
        @elseif(auth()->user()->isInvestigator())
          <a href="{{ route('investigator.dashboard') }}">Assigned Cases</a>
        @elseif(auth()->user()->isAdmin())
          <a href="{{ route('admin.dashboard') }}">Overview</a>
          <a href="{{ route('admin.users.index') }}">Users</a>
          <a href="{{ route('admin.reports.assign') }}">Assign Reports</a>
        @endif

        <span class="dash-user">{{ auth()->user()->full_name ?? auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" class="dash-logout">
          @csrf
          <button type="submit">Log out</button>
        </form>
      @endauth
    </nav>
  </div>
</header>

<main class="dash-main">
  @if (session('status'))
    <div class="dash-flash">{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div class="dash-flash-error">
      <ul style="margin:0; padding-left:18px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @yield('content')
</main>

</body>
</html>
