let applyBtn = document.getElementById("apply_filters");
let clearBtn = document.getElementById("clear_filters");

let form = document.getElementById("filters");

let cards = document.querySelectorAll(".card");


applyBtn.addEventListener("click", (e) => {
    e.preventDefault();
    applyFilters();
});

clearBtn.addEventListener("click", (e) => {
    e.preventDefault();
    clearFilters();
});


function getFilters() {
    const titleEl = form.elements["title_filter"];
    const genreEl = form.elements["genre_filter"];
    const platformEl = form.elements["platform_filter"];
    const sortEl = form.elements["sort_by"];

    let titleFilter = (titleEl.value || "").trim().toLowerCase();
    let genreFilter = (genreEl.value || "");
    let platformFilter = (platformEl.value || "");
    let sortBy = (sortEl.value || "title_asc");

    return {
        "titleFilter" : titleFilter,
        "genreFilter" : genreFilter,
        "platformFilter" : platformFilter,
        "sortBy" : sortBy,
    };
}

function cardMatches(card, filters) {
    let title = card.dataset.title.toLowerCase();
    let genre = card.dataset.genre;
    let platform = card.dataset.platform;

    let matchTitle = title.includes(filters.titleFilter) || filters.titleFilter === "";
    let matchGenre = genre === filters.genreFilter || filters.genreFilter === "";
    let matchPlatforms = platform.includes(filters.platformFilter) || filters.platformFilter === "";

    return matchTitle && matchGenre && matchPlatforms;
}

function sortCards(cards, sortBy) {
    const list = cards.slice();
    
    list.sort((a, b) => {
        let titleA = a.dataset.title.toLowerCase();
        let titleB = b.dataset.title.toLowerCase();
        let yearA = Number(a.dataset.year);
        let yearB = Number(b.dataset.year);

        if (sortBy === "year_desc") return yearB - yearA;
        if (sortBy === "year_asc") return yearA - yearB;
        
        return titleA.localeCompare(titleB);
    });

    return list;
}

function applyFilters() {
    let filters = getFilters();

    for (let i = 0; i != cards.length; i++) {
        let card = cards[i];
        card.classList.toggle("hidden", !cardMatches(card, filters));
    }

    let cardsArray = Array.from(cards);
    const sorted = sortCards(cardsArray, filters.sortBy);

    console.log(sorted);

}

function clearFilters() {
    console.log("clearing filters");
}
