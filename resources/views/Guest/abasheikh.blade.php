@extends('Guest.cover')
@section('content')


<style>
*{box-sizing:border-box;margin:0;padding:0}
.page{padding:24px 0;background:var(--color-background-tertiary)}
.section-label{font-size:12px;font-weight:500;color:#0b3d2e;text-transform:uppercase;letter-spacing:.08em;margin-bottom:4px}
/*input[type=text]{width:100%;padding:11px 16px;border-radius:999px;box-shadow:0 1px blue rgba(0, 0, 0, 1.0); font-size:14px}*/

input[type=text]{
  width:100%;
  padding:12px 18px;
  border-radius:999px;
  border:1px solid #ddd;
  outline:none;
  font-size:14px;
  background:#fff;
  box-shadow:0 4px 14px rgba(0,0,0,0.07);
  transition:all .2s ease;
}

input[type=text]:focus{
  border-color:#0B6D20;
  box-shadow:0 0 0 4px rgba(11,109,32,0.12);
}

.filter-btn{border:0.5px solid var(--color-border-secondary);background:var(--color-background-primary);padding:7px 16px;border-radius:999px;cursor:pointer;font-size:13px;font-weight:500;color:var(--color-text-secondary);transition:all .15s}
.filter-btn:hover{background:var(--color-background-secondary)}
.filter-btn.active{background:#0b3d2e;color:#fff;border-color:#0b3d2e}
.teacher-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px}
.teacher-card{background-color:white;box-shadow: 0 4px 18px rgba(0,0,0,0.07);border-radius:5%;padding:18px;display:flex;flex-direction:column;gap:12px;transition:border-color .15s;cursor:pointer}
.teacher-card:hover{border-color:#0b3d2e}
.teacher-card.hide{display:none}
.avatar{width:52px;height:52px;border-radius:50%;background:#0B6D20;color:#fff;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:500;flex-shrink:0}
.spec-badge{display:inline-block;background:#E1F5EE;color:#0b3d2e;border-radius:999px;font-size:11px;font-weight:500;padding:3px 10px;width:fit-content}
.stat-row{display:flex;gap:8px;flex-wrap:wrap}
.stat{font-size:12px;color:var(--color-text-secondary);background:var(--color-background-secondary);border-radius:999px;padding:4px 10px}
.btn-view{display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:500;padding:7px 14px;border-radius:999px;text-decoration:none;background:#0B6D20;color:#fff;border:none;cursor:pointer;transition:opacity .15s;width:fit-content}
.btn-view:hover{opacity:.85}
.pager{display:flex;justify-content:center;align-items:center;gap:10px;margin-top:24px}
.pager button{background:#0B6D20;color:#fff;border:none;border-radius:999px;padding:7px 18px;font-size:13px;font-weight:500;cursor:pointer;transition:opacity .15s}
.pager button:hover{opacity:.8}
.no-result{text-align:center;padding:40px 0;font-size:14px;color:var(--color-text-tertiary);display:none}
</style>

<div class="page">
<div style="max-width:80%;margin:0 auto;padding:0 16px;display:flex;flex-direction:column;gap:16px">

  <div>
    <div class="section-label">Amasomo</div>
    <h2 style="font-size:20px;font-weight:500;color:var(--color-text-primary);margin-bottom:4px">Abarimu bacu</h2>
    <p style="font-size:13px;color:var(--color-text-secondary)">Hitamo umwarimu kugira ngo urebe amasomo ye</p>
  </div>

  <input type="text" id="searchInput" placeholder="Shakisha umwarimu...">

  <div style="display:flex;flex-wrap:wrap;gap:8px">
    <button class="filter-btn active" data-spec="all">Bose</button>
    <button class="filter-btn" data-spec="tawhid">Tawhid</button>
    <button class="filter-btn" data-spec="fiqh">Fiqh</button>
    <button class="filter-btn" data-spec="hadith">Hadith</button>
    <button class="filter-btn" data-spec="arabic">Arabic</button>
  </div>

  <div class="teacher-grid" id="teacherGrid">

    <div class="teacher-card" data-spec="tawhid fiqh" data-name="Sheikh MUNYANEZA ISMAIL ABUU OMAR">
      <div style="display:flex;align-items:center;gap:12px">
        <div class="avatar">MI</div>
        <div>
          <h3 style="font-size:15px;font-weight:500;color:var(--color-text-primary);margin-bottom:3px">Sheikh MUNYANEZA ISMAIL ABUU OMAR</h3>
          <span class="spec-badge">Tawhid · Fiqh</span>
        </div>
      </div>
      <div class="stat-row">
        <span class="stat">5 Inyigisho</span>
        <span class="stat">3 Videos</span>
        <span class="stat">2 Audio</span>
      </div>
      <a href="{{ route('guest.teacher-darsa') }}" class="btn-view" data-name="Sheikh MUNYANEZA ISMAIL ABUU OMAR">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6.5" stroke="#fff" stroke-width="1.5"/><circle cx="8" cy="8" r="2.5" fill="#fff"/></svg>
        Reba amasomo
      </a>
    </div>

    <div class="teacher-card" data-spec="hadith fiqh" data-name="Sheikh IRADUKUNDA ABOUBAKAR ABUU ABDILRAHMAN">
      <div style="display:flex;align-items:center;gap:12px">
        <div class="avatar">IA</div>
        <div>
          <h3 style="font-size:15px;font-weight:500;color:var(--color-text-primary);margin-bottom:3px">Sheikh IRADUKUNDA ABOUBAKAR ABUU ABDILRAHMAN</h3>
          <span class="spec-badge">Hadith · Fiqh</span>
        </div>
      </div>
      <div class="stat-row">
        <span class="stat">8 Inyigisho</span>
        <span class="stat">5 Videos</span>
        <span class="stat">3 Audio</span>
      </div>
      <a href="{{ route('guest.teacher-darsa') }}" class="btn-view" data-name="Sheikh IRADUKUNDA ABOUBAKAR ABUU ABDILRAHMAN">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6.5" stroke="#fff" stroke-width="1.5"/><circle cx="8" cy="8" r="2.5" fill="#fff"/></svg>
        Reba amasomo
      </a>
    </div>

    <div class="teacher-card" data-spec="tawhid arabic" data-name="Sheikh NDAHAYO KHALID ABUU MUADH">
      <div style="display:flex;align-items:center;gap:12px">
        <div class="avatar">NK</div>
        <div>
          <h3 style="font-size:15px;font-weight:500;color:var(--color-text-primary);margin-bottom:3px">Sheikh NDAHAYO KHALID ABUU MUADH</h3>
          <span class="spec-badge">Tawhid · Arabic</span>
        </div>
      </div>
      <div class="stat-row">
        <span class="stat">6 Inyigisho</span>
        <span class="stat">4 Videos</span>
        <span class="stat">2 Audio</span>
      </div>
      <a href="{{ route('guest.teacher-darsa') }}" class="btn-view" data-name="Sheikh NDAHAYO KHALID ABUU MUADH">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6.5" stroke="#fff" stroke-width="1.5"/><circle cx="8" cy="8" r="2.5" fill="#fff"/></svg>
        Reba amasomo
      </a>
    </div>
   </div>


  <div class="no-result" id="noResult">Nta mwarimu ubonetse</div>

  <div class="pager">
    <button onclick="changePage(-1)">← Prev</button>
    <span style="font-size:14px;font-weight:500;color:var(--color-text-secondary)">Urupapuro <strong id="pageNum">1</strong></span>
    <button onclick="changePage(1)">Next →</button>
  </div>

</div>
</div>

<script>
let currentPage=1;
const perPage=4;
const cards=document.querySelectorAll(".teacher-card");
const searchInput=document.getElementById("searchInput");
const noResult=document.getElementById("noResult");
let currentSpec="all";

function getFiltered(){
  const kw=searchInput.value.toLowerCase();
  return[...cards].filter(c=>{
    const matchSpec=currentSpec==="all"||c.dataset.spec.includes(currentSpec);
    const matchSearch=c.dataset.name.includes(kw)||c.innerText.toLowerCase().includes(kw);
    return matchSpec&&matchSearch;
  });
}

function applyFilters(){
  const filtered=getFiltered();
  const start=(currentPage-1)*perPage;
  const end=start+perPage;
  cards.forEach(c=>c.classList.add("hide"));
  filtered.slice(start,end).forEach(c=>c.classList.remove("hide"));
  document.getElementById("pageNum").innerText=currentPage;
  noResult.style.display=filtered.length?"none":"block";
}

document.querySelectorAll(".filter-btn").forEach(btn=>{
  btn.addEventListener("click",function(){
    document.querySelector(".filter-btn.active")?.classList.remove("active");
    this.classList.add("active");
    currentSpec=this.dataset.spec;
    currentPage=1;
    applyFilters();
  });
});

searchInput.addEventListener("input",()=>{currentPage=1;applyFilters();});

function changePage(dir){
  const max=Math.ceil(getFiltered().length/perPage)||1;
  currentPage=Math.min(Math.max(currentPage+dir,1),max);
  applyFilters();
}

applyFilters();

document.querySelectorAll(".btn-view").forEach(link => {
    link.addEventListener("click", function () {
        localStorage.setItem(
            "sheikh_name",
            this.getAttribute("data-name")
        );
    });
});

</script>

@endsection