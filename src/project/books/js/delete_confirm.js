const modal = document.getElementById("modal");

function openDelete(id) {
    modal.classList.toggle("hidden");
    document.getElementById("whatBook").innerHTML = "Are you sure you would like to delete book with ID " + id;
    document.getElementById("confirm").setAttribute("href", "book_delete.php?id=" + id);
}

function cancelDelete() {
    modal.classList.toggle("hidden");
}

