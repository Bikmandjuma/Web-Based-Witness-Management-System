@extends('Guest.cover')
@section('content')

<!DOCTYPE html>
<html lang="rw">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kwegereza Islam Umuryango – E-Learning</title>
<!-- <meta http-equiv="refresh" content="3"> -->
<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Playfair+Display:wght@600;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" type="text/css" href="../assets/style.css">
<style>
  
/* CONTAINER */
.container{
  max-width:1100px;
  margin:auto;
  padding:30px 20px;
}

.title{
  text-align:center;
}

.title h1{
  color:#0b3d2e;
}

/* SEARCH */
.search-boxx{
  display:flex;
  justify-content:center;
  margin:15px 0;
}

.search-boxx input{
  width:100%;
  max-width:400px;
  padding:10px 15px;
  border-radius:30px;
  border:1px solid #ddd;
  outline:none;
}

/* TABS */
.tabs{
  display:flex;
  justify-content:center;
  gap:10px;
  flex-wrap:wrap;
  margin:15px 0;
}

.tab{
  padding:8px 16px;
  border-radius:999px;
  border:1px solid #0b6d20;
  background:white;
  color:#0b6d20;
  cursor:pointer;
  font-weight:600;
}

.tab.active{
  background:#0b6d20;
  color:white;
}

/* GRID */
.grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:20px;
}

/* CARD */
.card{
  background:white;
  padding:18px;
  border-radius:14px;
  box-shadow:0 4px 15px rgba(0,0,0,0.05);
  transition:0.3s;
}

.card:hover{
  transform:translateY(-5px);
}

.badge{
  display:inline-block;
  padding:4px 10px;
  border-radius:20px;
  font-size:12px;
  font-weight:700;
}

.done{ background:#eee; color:#0b6d20; }
.upcoming{ background:#eee; color:#b26a00; }
.live{ background:#eee; color:#b30000; }

h3{ margin:10px 0 6px; color:#0b3d2e; }

p{ font-size:14px; color:#555; }

.date{ font-size:12px; color:#777; margin-top:8px; }

.btn{
  display:inline-block;
  margin-top:10px;
  padding:8px 14px;
  border-radius:20px;
  background:#0b6d20;
  color:white;
  text-decoration:none;
  font-size:13px;
}

/* PAGINATION */
.pagination{
  display:flex;
  justify-content:center;
  gap:10px;
  margin:25px 0;
}

.page-btn{
  padding:8px 14px;
  border:1px solid #0b6d20;
  background:white;
  color:#0b6d20;
  border-radius:10px;
  cursor:pointer;
}

.page-btn.active{
  background:#0b6d20;
  color:white;
}

.hide{ display:none !important; }
</style>


<div class="container">

  <div class="section-title">
    <h2>Amatangazo y'amasomo</h2>
    <p>Amasomo, live, asigaye n’ayarangiye</p>
  </div>

  <!-- SEARCH -->
  <div class="search-boxx">
    <input type="text" id="searchInput" placeholder="Shakisha isomo...">
  </div>

  <!-- TABS -->
  <div class="tabs">
    <button class="tab active" onclick="setTab('all',event)">Yose</button>
    <button class="tab" onclick="setTab('live',event)">Live</button>
    <button class="tab" onclick="setTab('upcoming',event)">Asigaye</button>
    <button class="tab" onclick="setTab('done',event)">Ayarangiye</button>
  </div>

  <!-- GRID -->
  <div class="grid" id="grid">

    <div class="card live"><span class="badge live">LIVE</span><h3>Hadith</h3><p>Sheikh ABOUBAKAR</p></div>
    <div class="card upcoming"><span class="badge upcoming"> RISIGAYE</span><h3>Tawhid</h3><p>Aqida lesson</p></div>
    <div class="card upcoming"><span class="badge upcoming"> RISIGAYE</span><h3>Fiqh Salah</h3><p>Isengesho</p></div>
    <div class="card done"><span class="badge done">ryararangiye</span><h3>Qur’an</h3><p>By Sheikh Ndahayo Halid</p></div>
    <div class="card done"><span class="badge done">ryararangiye</span><h3>Shafi’i</h3><p>Fiqh class</p></div>

  </div>

  <!-- PAGINATION -->
  <div class="pagination">
    <button class="page-btn" onclick="changePage(-1)">Prev</button>
    <button class="page-btn active" id="pageNum">1</button>
    <button class="page-btn" onclick="changePage(1)">Next</button>
  </div>

</div>
<script>

const dropdown = document.querySelector(".dropdown > a");
const menu = document.querySelector(".dropdown-menu");

dropdown.addEventListener("click", (e) => {
  e.preventDefault();
  menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
});

function toggleSheikh() {
  const list = document.getElementById("sheikhList");
  list.style.display = (list.style.display === "block") ? "none" : "block";
}

// SELECT ALL SHEIKH LINKS
const sheikhLinks = document.querySelectorAll(".sheikh-link");

// LOOP THROUGH THEM
sheikhLinks.forEach(link => {
  link.addEventListener("click", function () {

    const name = this.getAttribute("data-name");

    // SAVE TO LOCAL STORAGE
    localStorage.setItem("sheikh_name", name);

  });
});

let currentTab = "all";
let currentPage = 1;
const perPage = 4;

const cards = document.querySelectorAll(".card");
const searchInput = document.getElementById("searchInput");

function applyFilters(){
  let search = searchInput.value.toLowerCase();

  let filtered = [...cards].filter(card=>{
    let matchTab = currentTab === "all" || card.classList.contains(currentTab);
    let matchSearch = card.innerText.toLowerCase().includes(search);
    return matchTab && matchSearch;
  });

  // pagination
  let start = (currentPage-1)*perPage;
  let end = start + perPage;

  cards.forEach(c=>c.classList.add("hide"));

  filtered.slice(start,end).forEach(c=>c.classList.remove("hide"));
}

function setTab(tab, e){
  currentTab = tab;
  currentPage = 1;

  document.querySelectorAll(".tab").forEach(t=>t.classList.remove("active"));
  e.target.classList.add("active");

  applyFilters();
}

searchInput.addEventListener("input", ()=>{
  currentPage = 1;
  applyFilters();
});

function changePage(dir){
  let visible = [...cards].filter(card=>{
    let matchTab = currentTab === "all" || card.classList.contains(currentTab);
    let matchSearch = card.innerText.toLowerCase().includes(searchInput.value.toLowerCase());
    return matchTab && matchSearch;
  });

  let maxPage = Math.ceil(visible.length / perPage);

  currentPage += dir;
  if(currentPage < 1) currentPage = 1;
  if(currentPage > maxPage) currentPage = maxPage;

  document.getElementById("pageNum").innerText = currentPage;

  applyFilters();
}

applyFilters();

</script>

@endsection