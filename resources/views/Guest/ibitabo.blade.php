@extends('Guest.cover')
@section('content')

<style>
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

<!-- PDF BOOKS -->
<section class="section" id="ibitabo">
  <div class="container">
    <div class="section-title">
      <h2>Ibitabo byacu</h2>
      <p>Soma cyangwa ufungure ibitabo bya PDF</p>
    </div>
    <!-- SEARCH -->
    <div class="search-boxx">
      <input type="text" id="searchInput" placeholder="Shakisha igitabo...">
    </div>
    <div class="books-grid">
      <div class="book-card card">
        <span class="book-badge">Igitabo 1</span>
        <h3>ESE BIREMEWE GUSIBA KUWA GATANDATU</h3>
        <p>Igitabo cya mbere cya PDF cyasobanura neza ibi bibazo mu Islamu.</p>
        <div class="book-actions">
          <a href="igitabo1.pdf" target="_blank" class="btn-book"><i class="fas fa-eye"></i> Soma PDF</a>
          <a href="igitabo1.pdf" download class="btn-book"><i class="fas fa-download"></i> Dawnilodinga</a>
        </div>
      </div>
      <div class="book-card card">
        <span class="book-badge">Igitabo 2</span>
        <h3>UBUREMERE BWAJE MU KWIGANA IMIGENZO Y'ABAHAKANYE</h3>
        <p>Igitabo cya kabiri cyasobanura ingaruka zo kwigana imigenzo y'abahakanye.</p>
        <div class="book-actions">
          <a href="igitabo2.pdf" target="_blank" class="btn-book"><i class="fas fa-eye"></i> Soma PDF</a>
          <a href="igitabo2.pdf" download class="btn-book"><i class="fas fa-download"></i> Dawnilodinga</a>
        </div>
      </div>
      <div class="book-card card">
        <span class="book-badge">Igitabo 3</span>
        <h3>IGIHIMBANO CYO KWIZIHIZA UMUNSI W'IVUKA RY'INTUMWA Y'IMANA</h3>
        <p>Igitabo cya gatatu kijyanye n'iyi ngingo y'idini ya Islamu.</p>
        <div class="book-actions">
          <a href="igitabo3.pdf" target="_blank" class="btn-book"><i class="fas fa-eye"></i> Soma PDF</a>
          <a href="igitabo3.pdf" download class="btn-book"><i class="fas fa-download"></i> Dawnilodinga</a>
        </div>
      </div>
    </div>
    <div class="pagination">
      <button onclick="changePage(-1)">Prev</button>
      <span id="pageNum">1</span>
      <button onclick="changePage(1)">Next</button>
    </div>
  </div>
</section>

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

// save sheikh name
document.querySelectorAll(".sheikh-link").forEach(link => {
  link.addEventListener("click", function () {
    localStorage.setItem("sheikh_name", this.getAttribute("data-name"));
  });
});

/* =========================
   SEARCH + PAGINATION
========================= */

let currentPage = 1;
const perPage = 4;

const cards = document.querySelectorAll(".card");
const searchInput = document.getElementById("searchInput");

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

// init
applyFilters();
</script>

@endsection