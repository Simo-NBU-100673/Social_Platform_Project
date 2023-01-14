let form = document.querySelector(".typing-area");
let inputField = form.querySelector("input.input-field");

form.addEventListener("submit", (e) => {
    // if the form gets submitted, then page doesn't refresh
    e.preventDefault();

    // Creating XML object to make a POST request to chat.php
    let xhrObject = new XMLHttpRequest(); // creating XML object
    xhrObject.open("POST", "php/insert_chat.php", true);

    // send the form data through ajax to php
    let form_current_state = document.querySelector("form.typing-area");
    let formData = new FormData(form_current_state); // creating new formData object

    // Send the form data to handle.php
    xhrObject.send(formData); // sending the form data to php

    // Response from PHP back-end
    xhrObject.onload = () => {
        if (xhrObject.readyState === XMLHttpRequest.DONE) {
            if (xhrObject.status === 200) {
                inputField.value = "";
            }
        }
    }

});