<!DOCTYPE html>
<html lang="rw">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kwegereza Islam Umuryango – E-Learning</title>
<!-- <meta http-equiv="refresh" content="3"> -->
<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Playfair+Display:wght@600;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ URL::to('/') }}/Guest/assets/style.css" />
<style>
  .modal{
  display:none;
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.6);
  z-index:9999;
  align-items:center;
  justify-content:center;
}

.modal-content{
  background:#fff;
  width:90%;
  max-width:420px;
  padding:25px;
  border-radius:14px;
  position:relative;
}

.closeBtn{
  position:absolute;
  right:15px;
  top:10px;
  font-size:28px;
  cursor:pointer;
}

.join-btn{
  margin-top:15px;
  width:100%;
  padding:12px;
  border:none;
  border-radius:10px;
  background:#0b6d20;
  color:#fff;
  cursor:pointer;
}
</style>
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
  <div class="left">
    <span><i class="fa fa-phone"></i> (+250) 723061482</span>
    <span><i class="fa fa-envelope"></i>  umuryangok@gmail.com</span>
    <!-- <span><i class="fa fa-globe"></i> Rwandcba</span> -->
  </div>
  <div class="right">
    
    <a href="{{ route('owner.login') }}" 
       class="btn-account hidden md:inline-flex items-center gap-2">
       <i class="fas fa-user"></i> Account
    </a>

    <a href="{{ route('guest.home') }}#twandikire" 
       class="btn-account hidden md:inline-flex items-center gap-2">
       <i class="fas fa-phone"></i> Twandikire
    </a>
  </div>
</div>

<!-- NAVBAR -->
<div class="navbar">
  <div class="nav-inner">
    <div class="logo-box">
      <img src="{{ URL::to('/') }}/Guest/images/logo.png" alt="K.I.U Logo"
           onerror="this.style.background='#0B3D2E';this.src='';this.alt='KIU'">
      <div class="logo-text">
        <h2>K.I.U</h2>
        <p>Kwegereza Islam Umuryango</p>
      </div>
    </div>

    <nav class="nav-links">
      <a href="{{ route('guest.home') }}#ahabanza" class="{{Request::segment(1) == '' ? 'active' : ''}}"><i class="fas fa-home"></i> Ahabanza</a>
      <a href="{{ route('guest.home') }}#abo-turi-bo"><i class="fas fa-info-circle"></i> Abo-turibo</a>
      <!-- <a href="{{ route('guest.home') }}#abo-turi-bo"><i class="fas fa-info-circle"></i>Ibibazo</a> -->
      <div onclick="window.location.href='{{ route("guest.teachers") }}'">
        <a href="#" class="{{Request::segment(1) == 'abasheikh' ? 'active' : ''}}">
          <i class="fas fa-users"></i> Abarimu
        </a>
      </div>

      <a href="{{ route('guest.inyandiko_zabamenyi') }}" class="{{Request::segment(1) == 'inyandiko-zabamenyi' ? 'active' : ''}}">
        <i class="fas fa-pen"></i> Inyandiko z'abamenyi
      </a>

      <a href="{{ route('guest.news') }}" class="{{Request::segment(1) == 'amatangazo' ? 'active' : ''}}">
        <i class="fas fa-bullhorn"></i> Amatangazo
      </a>

      <a href="{{ route('guest.books') }}" class="{{Request::segment(1) == 'ibitabo' ? 'active' : ''}}">
        <i class="fas fa-book"></i> Ibitabo
      </a>

    </nav>

    <div class="nav-right flex">
  
      <!-- Chat Notification -->
      <span id="chatBtn" class="chat-icon">
         <i class="fa fa-microphone"></i>
      </span>

      <span id="searchBtn" onclick="window.location.href='{{ route("guest.search") }}'" class="flex" style="font-weight: bold; margin-right: 10px; color:var(--green); cursor:pointer;opacity: 0.7;">
        <p>Search</p>&nbsp;<i class="fa fa-search"></i>
      </span>

      <div class="hamburger" id="menuBtn">
        <i class="fas fa-bars"></i>
      </div>

    </div>
  </div>

  <div class="mobile-menu" id="mobileMenu">
    <a href="{{route('guest.home')}}#ahabanza" class="{{Request::segment(1) == '' ? 'active' : ''}}"><i class="fas fa-home"></i> Ahabanza</a>
    <a href="{{route('guest.home')}}#abo-turi-bo"><i class="fas fa-info-circle"></i> Abo-turibo</a>
      <div onclick="window.location.href='{{ route("guest.teachers") }}'" >
        <p style="margin-left: -1%;font-weight: bold;" class="{{Request::segment(1) == 'abasheikh' ? 'active' : ''}}"><i class="fas fa-users"></i> Abarimu</p>
      </div>

      <a href="{{ route('guest.inyandiko_zabamenyi') }}" class="{{Request::segment(1) == 'inyandiko-zabamenyi' ? 'active' : ''}}"><i class="fas fa-pencil"></i> Inyandiko z'abamenyi</a>
      <a href="{{ route('guest.news') }}" class="{{Request::segment(1) == 'amatangazo' ? 'active' : ''}}"><i class="fas fa-bullhorn"></i> Amatangazo</a>
      <a href="{{ route('guest.books') }}" class="{{Request::segment(1) == 'ibitabo' ? 'active' : ''}}"><i class="fas fa-book"></i> Ibitabo</a>
    <a href="{{ route('guest.home') }}#twandikire"><i class="fas fa-phone"></i> Twandikire</a>
    <a href="{{ route('owner.login') }}" class="btn-donate hidden sm:hidden"><i class="fas fa-user"></i>Account</a>
  </div>
</div>


<!-- DAILY AYAH + HADITH -->
<div class="daily-strip container" style="padding-top:40px;">
  <div class="daily-card">
    <h4><i class="fas fa-users"></i>,<i class="fas fa-eye"></i> &nbsp;System status</h4>
    <div class="trans">System-users : 0</div>
    <div class="trans">Today's visit : 0</div>
    <div class="trans">All-visits : 0</div>    
  </div>

</div>


<!-- Modal -->
<div id="classModal" class="modal">
  <div class="modal-content">

    <span class="closeBtn" style="margin-top:-3px;color: red;">&times;</span>

    <h2 >📚 Mwinjire twige</h2>
    <hr>
    <p>
      Isomo turibwige uyumunsi ni Hadith , turi bugezweho na <b>Sheikh IRADUKUNDA ABOUBAKAR ABUU ABDILRAHMAN</b>
    </p>

    <button class="join-btn">Ni mukanya</button>

  </div>
</div>

  @yield('content')

<!-- FOOTER -->
<div class="footer-gold"></div>
<footer>
  <div class="footer-inner">
    <div>
      <h4>Twandikire</h4>
      <p><i class="fa fa-phone"></i> (+250) 723061482</p>
      <p><i class="fa fa-envelope"></i> umuryangok@gmail.com</p>
      <p><i class="fa fa-location-dot"></i> Rwanda</p>
    </div>
    <div>
      <h4>Aho tugana</h4>
      <a href="#ahabanza"><i class="fas fa-home"></i> Ahabanza</a>
      <!-- <a href="#abo-turi-bo"><i class="fas fa-info-circle"></i> Abo-turibo</a> -->
      <a href="#amasomo"><i class="fas fa-graduation-cap"></i> Amasomo</a>
      <a href="#ibitabo"><i class="fas fa-book"></i> Ibitabo</a>
    </div>
    <div>
      <h4>Imbuga nkoranya mbaga</h4>
      <a href="https://t.me/kwegereza" target="_blank"><i class="fab fa-telegram"></i> Telegram</a>
      <a href="https://www.facebook.com/groups/171182813976386/" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
      <a href="https://chat.whatsapp.com/G87ZLng06dJJA4rqV7DQsS" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a>
      <a href="https://youtube.com/@kwegereza" target="_blank"><i class="fab fa-youtube"></i> YouTube</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p><strong>KWEGEREZA ISLAM UMURYANGO</strong> &nbsp;|&nbsp; تقريب السنة بين يدي الأمة</p>
    <p style="margin-top:6px;">&copy; 2026 K.I.U </p>
  </div>
</footer>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const chatBtn  = document.getElementById("chatBtn");
    const modal    = document.getElementById("classModal");
    const closeBtn = document.querySelector(".closeBtn");

    // open modal
    if(chatBtn && modal){
        chatBtn.addEventListener("click", function () {
            modal.style.display = "flex";
        });
    }

    // close button
    if(closeBtn){
        closeBtn.addEventListener("click", function () {
            modal.style.display = "none";
        });
    }

    // click outside
    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

});
</script>
<!-- <script src="assets/script.js"></script> -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ URL::to('/') }}/Guest/assets/script.js"></script>

</body>
</html>
