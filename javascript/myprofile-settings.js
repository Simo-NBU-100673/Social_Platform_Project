let img_input = document.querySelector(".image-container input#image");
let img = document.querySelector(".image-container img");

//When user adds an image it will be displayed in the image container
img_input.addEventListener("change", function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    img.style.animation = "fadeIn 0.3s";
    img.src = tmppath;
});

//Handles changes of profile information
let form = document.querySelector(".changes form");
let notificationMessage = document.querySelector(".notification-message");
let errorMessage = document.querySelector(".error-message");
let deleteBtn = document.querySelector(".delete-account");

let popup = document.querySelector(".pop-up");
let popup_confirmBtn = document.querySelector(".pop-up .confirm");
let popup_cancelBtn = document.querySelector(".pop-up .cancel");

deleteBtn.addEventListener("click", () => {
    console.log("deleteBtn clicked");
    popup.style.display = "block";
});

popup.addEventListener("click", () => {
    console.log("popup BG clicked");
    popup.style.display = "none";
});

form.addEventListener("submit", (e) => {
    // if the form gets submitted, then page doesn't refresh
    e.preventDefault();

    // Creating XML object to make a POST request to profile_change.php
    let xhrObject = new XMLHttpRequest(); // creating XML object
    xhrObject.open("POST", "php/profile_change.php", true);

    // send the form data through ajax to php
    let form = document.querySelector(".changes form");
    let formData = new FormData(form); // creating new formData object

    // Send the form data to handle.php
    xhrObject.send(formData); // sending the form data to php

    // Response from PHP back-end
    xhrObject.onload = () => {
        if (xhrObject.readyState === XMLHttpRequest.DONE) {
            if (xhrObject.status === 200) {
                let data = xhrObject.response;
                if(data === "success") {

                    notificationMessage.innerHTML = "Profile updated successfully";
                    notificationMessage.style.display = "block";
                    //after 5 seconds, the notification message will disappear
                    setTimeout(() => {
                        notificationMessage.style.display = "none";
                    }, 5000);

                } else {

                    errorMessage.innerHTML = data;
                    errorMessage.style.display = "block";
                    setTimeout(() => {
                        errorMessage.style.display = "none";
                    }, 5000);

                }
            }
        }
    }
});