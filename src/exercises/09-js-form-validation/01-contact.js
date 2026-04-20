let submitBtn = document.getElementById('submit_btn');
let commentForm = document.getElementById('comment_form');

let nameInput = document.getElementById("name");
let categoryInput = document.getElementById('category');
let experienceInput = document.getElementsByName('experience');
let languagesInput = document.getElementsByName('languages[]');

let nameError = document.getElementById('name_error');
let categoryError = document.getElementById('category_error');
let experienceError = document.getElementById('experience_error');
let languagesError = document.getElementById('languages_error');

let errors = [];

submitBtn.addEventListener("click", onSubmitForm);


function addError(location, errorMsg) {
    errors[location] = errorMsg;
}

function showErrors() {
    nameError.innerHTML = errors["name_error"] || "";
    categoryError.innerHTML = errors["category_error"] || "";
    experienceError.innerHTML = errors["experience_error"] || "";
    languagesError.innerHTML = errors["languages_error"] || "";

}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = [];
    
    const name = nameInput.value.trim();
    if (!name) {addError("name_error", "Name is required")} 
    else if (!/^[A-Za-z ]+$/.test(name)) {addError("name_error", "name can only contain letters and spaces")}

    if (categoryInput.value == "") {addError("category_error", "Category is required");}

    let expSelected = false;
    for (let i = 0; i !== experienceInput.length; i++) {
        if (experienceInput[i].checked) {
            expSelected = true;
            break;
        }
    }
    if (!expSelected) {addError("experience_error", "Experience is required")}
    
    let langSelected = false;
    for (let i = 0; i !== languagesInput.length; i++) {
        if (languagesInput[i].checked) {
            langSelected = true;
            break;
        }
    }
    if (!langSelected) {addError("languages_error", "Language is required")}

    showErrors();

    if (Object.keys(errors).length == 0) {
        console.log("hooray");
    }
}