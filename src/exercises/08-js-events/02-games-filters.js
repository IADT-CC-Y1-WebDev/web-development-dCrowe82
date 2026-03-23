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

function cardMatches(crd) {
    let filters = getFilters();
    return crd.dataset.title.toLowerCase().includes(filters.titleFilter);
}

function applyFilters() {
    let matches = [];

    for (let i = 0; i != cards.length; i++) {
        let card = cards[i];
        matches[i] = cardMatches(card);
    }
    console.log(matches);
}

function clearFilters() {
    console.log("clearing filters");
}
