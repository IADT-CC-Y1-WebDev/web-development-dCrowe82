let submitBtn = document.getElementById('submit_btn');
let commentForm = document.getElementById('comment_form');

let nameInput = document.getElementById("name");

let nameError = "name_error";

let errors = [];

submitBtn.addEventListener("click", onSubmitForm);


function addError(location, errorMsg) {
    errors[location] = errorMsg;
}

function showErrors() {
    document.getElementById(nameError).innerHTML = errors[nameError] || "";

    // Object.keys(errors).forEach((error)=> {
    //     document.getElementById(error).innerHTML = errors[error] || "";
    // })

}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = [];
    
    const name = nameInput.value.trim();
    if (!name) {
        addError(nameError, "name required");
    } 
    else if (!/^[A-Za-z ]+$/.test(name)) {
        addError(nameError, "name can only contain letters and spaces");
    }
    
    showErrors();

    if (Object.keys(errors).length == 0) {
        console.log("hooray");
    }
}