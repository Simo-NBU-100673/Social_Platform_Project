console.log("login.js loaded");

// let submitBtn = document.querySelector("form .button input");
let form = document.querySelector(".login form");
let errorMessage = document.querySelector(".error-message");

form.addEventListener("submit", (e) => {
    // if the form gets submitted, then page doesn't refresh
    e.preventDefault();

    // Creating XML object to make a POST request to signup.php
    let xhrObject = new XMLHttpRequest(); // creating XML object
    xhrObject.open("POST", "php/login.php", true);

    // send the form data through ajax to php
    let form = document.querySelector(".login form");
    let formData = new FormData(form); // creating new formData object

    // Send the form data to handle.php
    xhrObject.send(formData); // sending the form data to php

    // Response from PHP back-end
    xhrObject.onload = () => {
        if (xhrObject.readyState === XMLHttpRequest.DONE) {
            if (xhrObject.status === 200) {
                let data = xhrObject.response;
                if(data === "success") {
                    location.href = "users_search/users.php";
                } else {
                    errorMessage.innerHTML = data;
                    errorMessage.style.display = "block";
                }
            }
        }
    }

});