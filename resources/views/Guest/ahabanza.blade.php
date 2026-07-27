@extends('Guest.cover')
@section('content')
<!-- <link rel="stylesheet" href="{{ URL::to('/') }}/Guest/assets/style.css" />
<script src="{{ URL::to('/') }}/Guest/assets/script.js"></script>

 -->

<script>
document.addEventListener("DOMContentLoaded", function () {

    loadVisits();

    setInterval(loadVisits, 5000);

});

function loadVisits()
{
    fetch("{{ route('guest.live.visits') }}")
    .then(response => response.json())
    .then(data => {

        document.getElementById("todayVisit").innerText = data.today;
        document.getElementById("totalVisit").innerText = data.total;

    })
    .catch(error => console.log(error));
}
</script>


<!-- HERO -->
<section class="hero" id="ahabanza">
  <div class="hero-content">
    <div class="hero-arabic">تقريب السنة بين يدي الأمة</div>
    <h1>KWEGEREZA ISLAM<br><span>UMURYANGO</span></h1>
    <p>Ikaze ku rubuga rwacu rwigisha ubumenyi bw'idini ya Islamu bushingiye kuri Qur'an na Sunnah, mu buryo bworoshye, bwiza kandi bunoze.</p>
    <div class="hero-btns">
      <a href="#amasomo" class="btn-primary"><i class="fas fa-graduation-cap"></i> Tangira Kwiga</a>
      <a href="#social" class="btn-outline"><i class="fas fa-users"></i> Twiyungeho (Join us)</a>
    </div>
    <div class="System-status">
      <div class="System-status-card">
        <h4>⭐ &nbsp;Site Overview</h4>
        <hr>
        <div class="trans">System-users : 0</div>
        <!-- <div class="trans">Today's visit : {{ $todayVisit }}</div>
        <div class="trans">All-visits : {{ $totalVisit }}</div> -->
        <div class="trans">
          Today's visit :
          <span id="todayVisit">{{ $todayVisit }}</span>
        </div>

        <div class="trans">
          All-visits :
          <span id="totalVisit">{{ $totalVisit }}</span>
        </div>

      </div>
    </div> 
  </div>
</section>


<!-- ABOUT -->
<section class="section" id="abo-turi-bo" style="padding-top:60px;">
  <div class="container max-w-4xl mx-auto  px-4">
    <div class="section-title text-center mb-8">
      <div class="tag">Abo-turibo</div>
      <!-- <h2 class="text-2xl font-bold">Menya Kwegereza Islam Umuryango</h2> -->
      <h2>Menya Kwegereza Islam Umuryango</h2>

      <p class="text-gray-600">Intego n'umurongo wacu</p>
    </div>

    <div class="grid md:grid-cols-[1.2fr_0.8fr] gap-9 items-center">
      <!-- LEFT CARD (always visible) -->
      <div class="bg-white p-9 rounded-[20px] shadow-md border-l-6 border-green-700">
        <h3 class="font-playfair text-xl md:text-2xl text-brown mb-3">Murakaza neza ku rubuga rwacu</h3>
        <p class="text-gray-600 mb-2 leading-relaxed">
          Turi urubuga rushingiye kuri <strong>Qur'an na Sunnah</strong> rugamije kwegeraza umuryango ubumenyi bwa Islamu. Twigisha amasomo meza y'izewe kandi yubaka mu buryo bworoshye kandi bwumvikana kuri bose.
        </p>
        <p class="text-gray-600 leading-relaxed">
          Duhereye ku bana, urubyiruko n'abakuru, kugira ngo bunguke ubumenyi ku idini, ku muco mwiza no ku buzima bufite intego nziza.
        </p>
      </div>

      <!-- RIGHT CARD (hidden on small devices) -->
      <!-- <div class="hidden md:flex justify-center">
        <div class="w-full max-w-[300px] h-[300px] rounded-[20px] bg-gradient-to-br from-green-800 to-green-600 
                    flex items-center justify-center border-4 border-yellow-400 shadow-md text-center">
          <div class="text-white/90">
            <div class="font-amiri text-4xl text-yellow-300 mb-2">K.I.U</div>
            <div class="text-sm tracking-widest uppercase">Kwegereza Islam Umuryango</div>
          </div>
        </div>
      </div> -->
      <div class="hidden md:flex justify-center">
        <div class="logo-card">
          
          <img src="{{ URL::to('/') }}/Guest/images/logo.png" alt="K.I.U Logo"
               onerror="this.style.display='none'">

          <!-- Optional fallback text -->
          <div class="logo-fallback">
<!--             <div class="font-amiri text-3xl text-yellow-300">K.I.U</div>
            <div class="text-xs tracking-widest uppercase">Kwegereza Islam Umuryango</div> -->
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="section section-alt">
  <div class="container">
    <div class="section-title">
      <div class="tag">Ibyacu</div>
      <h2>Ibyo dukora</h2>
      <p>Serivisi n'ibikubiyemo kuri platform yacu</p>
    </div>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-top"><i class="fas fa-book-open"></i></div>
        <div class="feature-body">
          <h4>Amasomo y'ingenzi</h4>
          <p>Qur'an, Hadith, Tawhid</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="feature-top"><i class="fas fa-play-circle"></i></div>
        <div class="feature-body">
          <h4>Videos</h4>
          <p>Video z'amasomo</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="feature-top"><i class="fas fa-headphones"></i></div>
        <div class="feature-body">
          <h4>Audio</h4>
          <p>Audio z'amasoma</p>
        </div>
      </div>
      <div class="feature-card" onclick="window.location.href='pages/ibitabo.html'">
        <div class="feature-top"><i class="fas fa-file-pdf"></i></div>
        <div class="feature-body">
          <h4>Ibitabo</h4>
          <p>ibitabo byo kwigiramo</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="feature-top"><i class="fas fa-question-circle"></i></div>
        <div class="feature-body">
          <h4>Q &amp; A</h4>
          <p>Ibibazo n'ibisubizo</p>
        </div>
      </div>
      <div class="feature-card">
        <div class="feature-top"><i class="fas fa-users"></i></div>
        <div class="feature-body">
          <h4>Community</h4>
          <p>Injira mu muryango</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- COURSES -->
<section class="section" id="amasomo">
  <div class="container">
    <div class="section-title">
      <div class="tag">Amasomo</div>
      <h2>Amasomo yacu</h2>
      <p>Dore zimwe mu nyigisho ushobora gusanga kuri website yacu</p>
    </div>
    <div class="courses-grid">
      <div class="course-card">
        <div class="icon"><i class="fas fa-quran"></i></div>
        <h3>Qur'an</h3>
        <p>Kwigisha gusoma no gusobanukirwa Qur'an mu buryo bworoheje kandi bwumvikana.</p>
      </div>
      <div class="course-card">
        <div class="icon"><i class="fas fa-scroll"></i></div>
        <h3>Hadith</h3>
        <p>Kumenya amagambo, inzira n'imyitwarire y'Intumwa y'Imana mu buzima bwa buri munsi.</p>
      </div>
      <div class="course-card">
        <div class="icon"><i class="fas fa-star-and-crescent"></i></div>
        <h3>Aqida / Tawuhid</h3>
        <p>Kwigisha ukwemera nyakuri n'imizi y'imyemerere ya Islamu.</p>
      </div>
      <div class="course-card">
        <div class="icon"><i class="fas fa-balance-scale"></i></div>
        <h3>Fiqh</h3>
        <p>Kwigisha amategeko y'ibanze y'idini mu masengesho no mu mibereho.</p>
      </div>
    </div>
  </div>
</section>

<!-- JOIN COMMUNITY BANNER -->
<section class="section" id="join">
  <div class="container">
    <div class="join-banner">
      <h2>Injira mu Muryango Wacu</h2>
      <p>Kwiyandikisha no kubona inyigisho nshya buri gihe hamwe n'ibihumbi by'abanyamuryango mu Rwanda no hanze</p>
      <div class="join-form">
        <input type="email" placeholder="Andika imeyili yawe...">
        <button><i class="fas fa-paper-plane"></i> Kwiyandikisha</button>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="section" id="twandikire">
  <div class="container">
    <div class="section-title">
      <div class="tag">Twandikire</div>
      <h2>Twandikire</h2>
      <p>Ifatanye natwe ubaza ibibazo, ndetse unatanga ibitekerezo.</p>
    </div>
    <div class="contact-box">
      <div class="email"><i class="fas fa-envelope"></i> umuryangok@gmail.com</div>
      <div class="phones">
        TEL: (+250) 723061482
      </div>
    </div>
  </div>
</section>

@endsection