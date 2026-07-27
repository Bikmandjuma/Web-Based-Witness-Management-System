@extends('Guest.cover')

@section('content')

<!-- SEARCH SECTION (VISIBLE DIRECTLY, CENTERED) -->
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4" style="position: relative; margin-top: -5%;">

    <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-xl">

        <!-- Title -->
        <h3 class="text-xl font-bold text-center mb-4">
            Shakisha
        </h3>

        <!-- Search Input -->
        <div class="flex items-center border rounded-full overflow-hidden mb-4">

            <input
                type="text"
                id="searchInput"
                placeholder="Andika icyo ushaka..."
                class="flex-1 px-4 py-3 outline-none"
            >

            <i class="fa fa-search px-4 text-gray-500"></i>

        </div>

        <!-- Search Results -->
        <div id="searchResults"
             class="text-sm text-gray-700 max-h-72 overflow-y-auto">
        </div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const searchInput   = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");

    // Search data
    const data = [
        "Amasomo ya Islam",
        "Qur'an",
        "Hadith",
        "Videos za Amasomo",
        "Ibitabo by'Islam",
        "Audio Lectures",
        "Twandikire",
        "Sheikh MUNYANEZA ISMAIL ABUU OMAR",
        "Sheikh IRADUKUNDA ABOUBAKAR ABUU ABDILRAHMAN",
        "Sheikh NDAHAYO KHALID ABUU MUADH"
    ];

    // Live Search
    function liveSearch() {

        const query = searchInput.value.trim().toLowerCase();

        if (query === "") {
            searchResults.innerHTML = "";
            return;
        }

        const matches = data.filter(item =>
            item.toLowerCase().includes(query)
        );

        if (matches.length === 0) {

            searchResults.innerHTML = `
                <p class="p-3 text-red-500">
                    Nta makuru ari mububiko
                </p>
            `;

        } else {

            searchResults.innerHTML = matches.map(item => `
                <p class="p-3 border-b hover:bg-gray-100 cursor-pointer">
                    ${item}
                </p>
            `).join("");

        }
    }

    searchInput.addEventListener("input", liveSearch);

    // Click result
    searchResults.addEventListener("click", function(e){

        if(e.target.tagName === "P"){
            searchInput.value = e.target.innerText;
            searchResults.innerHTML = "";
        }

    });

});
</script>

@endsection