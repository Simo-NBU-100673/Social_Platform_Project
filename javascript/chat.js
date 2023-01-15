let form = document.querySelector(".typing-area");
let inputField = form.querySelector("input.input-field");
let chat_box = document.querySelector(".chat-area .chat-box");

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

//TODO somehow when a user receives a new message to scroll down to the bottom of the chat box
//TODO somehow to make the chat box scroll down to the bottom when the user sends a message
//TODO show only 20 messages and in the user scrolls up then load more messages

//When the document is loaded then some messages will be displayed and will start interval to listen for new messages
window.onload = () => {
    //This will call the getMessages function only the first time when page loaded
    getMessages();

    //every 0.2s refresh the messages that are displayed after loading the page
    setInterval(getMessages, 400);
}

function getMessages() {
    // Creating XML object to make a GET request to users.php
    let xhrObject = new XMLHttpRequest();
    xhrObject.open("POST", "php/get-chat.php", true);

    // send the form data through ajax to php
    let form_current_state = document.querySelector("form.typing-area");
    let formData = new FormData(form_current_state); // creating new formData object

    //send the GET request
    xhrObject.send(formData);

    // Response from send GET request
    xhrObject.onload = () => {
        if (xhrObject.readyState === XMLHttpRequest.DONE) {
            if (xhrObject.status === 200) {
                chat_box.innerHTML = xhrObject.response;
            }
        }
    }
}