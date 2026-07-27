@extends('Guest.cover')
@section('content')

<style>
*{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

body{
  font-family:var(--font-sans);
  background:linear-gradient(135deg,#f8fff9,#eef8ff);
}

/* PAGE */
.page{
  padding:28px 0;
}

/* PROFILE */
.profile-card{
  background:linear-gradient(135deg,#0b3d2e,#0B6D20);
  color:#fff;
  border-radius:20px;
  padding:24px;
  display:flex;
  align-items:center;
  gap:18px;
  flex-wrap:wrap;
  box-shadow:0 15px 35px rgba(11,61,46,.18);
}

.avatar{
  width:72px;
  height:72px;
  border-radius:50%;
  background:rgba(255,255,255,.18);
  border:2px solid rgba(255,255,255,.25);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:22px;
  font-weight:bold;
}

.profile-info h2{
  font-size:20px;
  margin-bottom:6px;
}

.profile-info p{
  font-size:14px;
  opacity:.9;
  margin-bottom:12px;
}

.badges{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
}

.badge{
  background:rgba(255,255,255,.12);
  border:1px solid rgba(255,255,255,.18);
  padding:6px 12px;
  border-radius:999px;
  font-size:12px;
}

/* SEARCH */
.search-wrap{
  margin:18px 0 14px;
  position:relative;
}

.search-wrap svg{
  position:absolute;
  left:14px;
  top:50%;
  transform:translateY(-50%);
  color:#0B6D20;
}

#searchInput{
  width:100%;
  padding:13px 16px 13px 42px;
  border:none;
  border-radius:999px;
  background:#fff;
  font-size:14px;
  box-shadow:0 8px 20px rgba(0,0,0,.07);
  outline:none;
}

#searchInput:focus{
  box-shadow:0 0 0 4px rgba(11,109,32,.12);
}

/* FILTER */
.filters{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
  margin-bottom:18px;
}

.filter-btn{
  border:none;
  padding:10px 16px;
  border-radius:999px;
  background:#fff;
  color:#444;
  cursor:pointer;
  font-size:13px;
  font-weight:600;
  box-shadow:0 5px 14px rgba(0,0,0,.05);
  transition:.2s;
}

.filter-btn:hover{
  transform:translateY(-2px);
}

.filter-btn.active{
  background:linear-gradient(135deg,#0b3d2e,#0B6D20);
  color:#fff;
}

/* HEADER */
.section-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:14px;
}

.count{
  font-size:14px;
  color:#555;
  font-weight:600;
}

/* GRID */
.lesson-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
  gap:15px;
}

/* CARD */
.lesson-card{
  background:#fff;
  border-radius:18px;
  padding:18px;
  box-shadow:0 10px 25px rgba(0,0,0,.06);
  transition:.2s;
}

.lesson-card:hover{
  transform:translateY(-4px);
}

.icon-wrap{
  width:48px;
  height:48px;
  border-radius:14px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:12px;
}

.icon-video{background:#e7fff0;}
.icon-audio{background:#fff4df;}

.lesson-card h4{
  font-size:15px;
  color:#111;
  margin-bottom:10px;
}

.lesson-meta{
  display:flex;
  flex-wrap:wrap;
  gap:6px;
}

.type-tag{
  font-size:11px;
  padding:4px 10px;
  border-radius:999px;
  font-weight:700;
}

.tag-video{
  background:#e7fff0;
  color:#0B6D20;
}

.tag-audio{
  background:#fff4df;
  color:#ad6a00;
}

.tag-fiqh{
  background:#ffe9f1;
  color:#b13c6b;
}

.tag-tawhid{
  background:#ecebff;
  color:#5146d8;
}

.duration{
  font-size:12px;
  color:#777;
  padding-top:4px;
}

.no-result{
  display:none;
  text-align:center;
  padding:30px;
  color:#666;
  font-weight:600;
}

@media(max-width:768px){
  .profile-card{
    text-align:center;
    justify-content:center;
  }

  .badges{
    justify-content:center;
  }
}
</style>
<br>
<!-- <div class="page" > -->
<div class="page" style="max-width:80%;margin:0 auto;padding:0 16px;display:flex;flex-direction:column;gap:16px">


<div class="profile-card">
  <div class="avatar">MI</div>

  <div class="profile-info">
    <h2 id="sheikhTitle">Sheikh Munyaneza Ismail Abuu Omar</h2>
    <p>Umwarimu wa Tawhid na Fiqh</p>

    <div class="badges">
      <div class="badge">5 Inyigisho</div>
      <div class="badge">3 Videos</div>
      <div class="badge">2 Audio</div>
    </div>
  </div>
</div>

<div class="search-wrap">
<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="11" cy="11" r="8"/>
<path d="M21 21l-4.35-4.35"/>
</svg>
<input type="text" id="searchInput" placeholder="Shakisha isomo...">
</div>

<div class="filters">
<button class="filter-btn active" data-type="all">Byose</button>
<button class="filter-btn" data-type="video">Videos</button>
<button class="filter-btn" data-type="audio">Audio</button>
<button class="filter-btn" data-type="fiqh">Fiqh</button>
<button class="filter-btn" data-type="tawhid">Tawhid</button>
</div>

<div class="section-header">
<span class="count" id="countLabel">5 amasomo</span>
</div>

<div class="lesson-grid">

<div class="lesson-card lesson-item" data-type="video tawhid">
<div class="icon-wrap icon-video">▶</div>
<h4>Tawhid y'ibanze</h4>
<div class="lesson-meta">
<span class="type-tag tag-video">Video</span>
<span class="type-tag tag-tawhid">Tawhid</span>
<span class="duration">42 min</span>
</div>
</div>

<div class="lesson-card lesson-item" data-type="audio tawhid">
<div class="icon-wrap icon-audio">♪</div>
<h4>Shirk n'uburyo bwo kuyirinda</h4>
<div class="lesson-meta">
<span class="type-tag tag-audio">Audio</span>
<span class="type-tag tag-tawhid">Tawhid</span>
<span class="duration">35 min</span>
</div>
</div>

<div class="lesson-card lesson-item" data-type="video fiqh">
<div class="icon-wrap icon-video">▶</div>
<h4>Uburemere bw'Iswala</h4>
<div class="lesson-meta">
<span class="type-tag tag-video">Video</span>
<span class="type-tag tag-fiqh">Fiqh</span>
<span class="duration">28 min</span>
</div>
</div>

<div class="lesson-card lesson-item" data-type="audio fiqh">
<div class="icon-wrap icon-audio">♪</div>
<h4>Igisibo cya Ramadhan</h4>
<div class="lesson-meta">
<span class="type-tag tag-audio">Audio</span>
<span class="type-tag tag-fiqh">Fiqh</span>
<span class="duration">31 min</span>
</div>
</div>

<div class="lesson-card lesson-item" data-type="video tawhid">
<div class="icon-wrap icon-video">▶</div>
<h4>Uburemere bw'Aqida</h4>
<div class="lesson-meta">
<span class="type-tag tag-video">Video</span>
<span class="type-tag tag-tawhid">Tawhid</span>
<span class="duration">50 min</span>
</div>
</div>

</div>

<div class="no-result" id="noResult">Nta somo ribonetse</div>

</div>

<br>

<script>
document.addEventListener("DOMContentLoaded", function () {

  const filters = document.querySelectorAll(".filter-btn");
  const items = document.querySelectorAll(".lesson-item");
  const search = document.getElementById("searchInput");
  const noResult = document.getElementById("noResult");
  const countLabel = document.getElementById("countLabel");
  const sheikhTitle = document.getElementById("sheikhTitle");

  let current = "all";

  // FILTER FUNCTION
  function applyFilter() {
    const keyword = search.value.toLowerCase().trim();
    let found = 0;

    items.forEach(item => {
      const types = item.dataset.type.toLowerCase();
      const text = item.innerText.toLowerCase();

      const matchType =
        current === "all" || types.includes(current);

      const matchSearch =
        keyword === "" || text.includes(keyword);

      if (matchType && matchSearch) {
        item.style.display = "block";
        found++;
      } else {
        item.style.display = "none";
      }
    });

    countLabel.innerText = found + " amasomo";
    noResult.style.display = found > 0 ? "none" : "block";
  }

  // FILTER BUTTONS
  filters.forEach(btn => {
    btn.addEventListener("click", function () {

      document
        .querySelector(".filter-btn.active")
        ?.classList.remove("active");

      this.classList.add("active");

      current = this.dataset.type.toLowerCase();

      applyFilter();
    });
  });

  // SEARCH INPUT
  search.addEventListener("keyup", applyFilter);
  search.addEventListener("input", applyFilter);

  // LOCAL STORAGE NAME
  const savedName = localStorage.getItem("sheikh_name");
  if (savedName && sheikhTitle) {
    sheikhTitle.innerText = savedName;
  }

  // INIT
  applyFilter();

});
</script>


@endsection