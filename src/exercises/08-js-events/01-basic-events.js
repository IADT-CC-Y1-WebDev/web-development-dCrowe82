let box = document.getElementById("box");
let toggleBoxBtn = document.getElementById("toggle_box_btn");
let preview = document.getElementById("preview");
let previewInput = document.getElementById("preview_input");

toggleBoxBtn.addEventListener("click", () => {toggleBoxVisibility(box)});

function toggleBoxVisibility(box) {
    box.classList.toggle("hidden");
}

previewInput.addEventListener("change", (e) => {updatePreview(preview, e.target.value);});

function updatePreview(previewElement, text) {
    
    let trimmed = text.trim();

    if (trimmed === "") {
        previewElement.textContent = "(nothing yet)";
        previewElement.classList.add("empty");
    } else {
        previewElement.textContent = text;
        previewElement.classList.remove("empty");
    }

}