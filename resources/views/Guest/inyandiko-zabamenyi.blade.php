@extends('Guest.cover')
@section('content')

<style>

/* CONTENT */
.container{
  max-width:1100px;
  margin:auto;
  padding:40px 20px;
}

.title{
  text-align:center;
  margin-bottom:30px;
}
.title h1{
  color:#0b3d2e;
  font-weight: bold;
  font-family: sans-serif;
  font-size: 20px;
}

.grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
  gap:20px;
}

.card{
  background:white;
  padding:20px;
  border-radius:15px;
  box-shadow:0 4px 15px rgba(0,0,0,0.05);
  transition:0.3s;
}
.card:hover{
  transform:translateY(-5px);
}
.card h3{
  color:#0b3d2e;
  margin-bottom:10px;
}
.card p{
  font-size:14px;
  color:#555;
}
.card a{
  display:inline-block;
  margin-top:10px;
  color:#0b6d20;
  font-weight:700;
  text-decoration:none;
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

.hide{ display:none !important; }

.pagination{
  display:flex;
  justify-content:center;
  align-items:center;
  gap:10px;
  margin-top:25px;
}

.pagination button{
  padding:6px 12px;
  border:none;
  border-radius:6px;
  background:#0b6d20;
  color:white;
  cursor:pointer;
}

.pagination span{
  font-weight:bold;
}
</style>


<!-- CONTENT -->
<div class="container">

  <div class="title">
    <h1>Inyandiko z’Abamenyi</h1>
    <p>Abamenyi b’ingenzi muri Islamu n’inyigisho zabo</p>
  </div>

  <div class="search-boxx">
    <input type="text" id="searchMain" placeholder="Shakisha inyandiko z'abamenyi ......">
  </div>


  <div class="grid">

    <div class="card">
      <h3>Imam Shafi’i</h3>
      <p>
        Imam wamenyekanye cyane mu fiqh ya Shafi’i, ufite inyigisho zikomeye ku mategeko ya Islam.
      </p>
      <a href="#">Soma inyandiko</a>
    </div>

    <div class="card">
      <h3>Imam Malik ibn Anas</h3>
      <p>
        Umushinze madhhab ya Maliki, azwi ku bumenyi bwe mu Hadith no mu mategeko.
      </p>
      <a href="#">Soma inyandiko</a>
    </div>

    <div class="card">
      <h3>Imam Ahmad ibn Hanbal</h3>
      <p>
        Umuyobozi wa madhhab ya Hanbali, uzwi ku kwishingikiriza cyane kuri Hadith.
      </p>
      <a href="#">Soma inyandiko</a>
    </div>

    <div class="card">
      <h3>Sheikh Ibn Baaz</h3>
      <p>
        Sheikh w’ibihe bya vuba, uzwi cyane ku fatwa n’inyigisho za Tawhid.
      </p>
      <a href="#">Soma inyandiko</a>
    </div>

    <div class="card">
      <h3>Ibn al-Qayyim</h3>
      <p>
        Umunyeshuri wa Ibn Taymiyyah, uzwi ku bitabo byimbitse ku Iman na Fiqh.
      </p>
      <a href="#">Soma inyandiko</a>
    </div>

  </div>

  <div class="pagination">
    <button onclick="changePage(-1)">Prev</button>
    <span id="pageNum">1</span>
    <button onclick="changePage(1)">Next</button>
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


let currentPage = 1;
const perPage = 4;

const cards = document.querySelectorAll(".card");
const searchInput = document.getElementById("searchMain");

function getFilteredCards(){
  let search = searchInput.value.toLowerCase();

  return [...cards].filter(card =>
    card.innerText.toLowerCase().includes(search)
  );
}

function applyFilters(){
  let filtered = getFilteredCards();

  let start = (currentPage - 1) * perPage;
  let end = start + perPage;

  cards.forEach(c => c.classList.add("hide"));

  filtered.slice(start, end).forEach(c => {
    c.classList.remove("hide");
  });

  // update page number
  document.getElementById("pageNum").innerText = currentPage;
}

searchInput.addEventListener("input", () => {
  currentPage = 1;
  applyFilters();
});

function changePage(dir){
  let filtered = getFilteredCards();
  let maxPage = Math.ceil(filtered.length / perPage);

  currentPage += dir;

  if(currentPage < 1) currentPage = 1;
  if(currentPage > maxPage) currentPage = maxPage;

  applyFilters();
}

// INITIAL LOAD
applyFilters();
</script>

@endsection