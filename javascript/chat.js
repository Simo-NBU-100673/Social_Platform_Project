let limit = 20; //number of messages to be displayed at a time
let form = document.querySelector(".typing-area");
let inputField = form.querySelector("input.input-field");
const chat_box = document.querySelector(".chat-area .chat-box");

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

                //This will return the scrollbar to the bottom of the chat box
                chat_box.scrollTop = chat_box.scrollHeight;
            }
        }
    }

});

//activate auto scroll when the users scroll is at the bottom of the chat box
//and deactivate auto scroll when the user scrolls up
chat_box.onscroll = () => {
    if (chat_box.scrollTop + chat_box.clientHeight >= chat_box.scrollHeight) {
        //This is when the user scrolls down to the bottom of the chat box
        chat_box.classList.remove("active");
    }else{

        //This is when the user scrolls up to the top of the chat box
        if (chat_box.scrollTop == 0) {
            limit+=10;
        }

        //This is when the user scrolls up and it is not at the bottom of the chat box
        chat_box.classList.add("active");
    }
}

//When the document is loaded then some messages will be displayed and will start interval to listen for new messages
window.onload = () => {
    //This will call the getMessages function only the first time when page loaded
    getMessages();

    //This will return the scrollbar to the bottom of the chat box
    chat_box.scrollTop = chat_box.scrollHeight;

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

    // attach the limit variable to the formData object
    formData.append("limit", limit);

    //send the GET request
    xhrObject.send(formData);

    // Response from send GET request
    xhrObject.onload = () => {
        if (xhrObject.readyState === XMLHttpRequest.DONE) {
            if (xhrObject.status === 200) {
                chat_box.innerHTML = xhrObject.response;

                //if the user scrolls up then don't scroll down to the
                //bottom of the chat box when a new message is received
                if (!chat_box.classList.contains("active")) {
                    chat_box.scrollTop = chat_box.scrollHeight;
                }
            }
        }
    }
}