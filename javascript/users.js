const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const usersList = document.querySelector(".users .users-list");

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    if (searchTerm !== "") {
        searchBar.classList.add("active");
    }else {
        searchBar.classList.remove("active");
    }

    let xhrObject = new XMLHttpRequest();
    xhrObject.open("POST", "php/search.php", true);

    //send the GET request
    xhrObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrObject.send("searchTerm=" + searchTerm);

    // Response from send GET request
    xhrObject.onload = () => {
        if (xhrObject.readyState === XMLHttpRequest.DONE) {
            if (xhrObject.status === 200) {
                usersList.innerHTML = xhrObject.response;
            }
        }
    }
}

//When the document is loaded then the getAllUsers function is called the first time
window.onload = () => {
    //This will call the getAllUsers function only the first time when page loaded
    getAllUsers();

    //every second refresh the users list after the page loaded
    setInterval(getAllUsers, 1000);
}

function getAllUsers() {
    // Creating XML object to make a GET request to users.php
    let xhrObject = new XMLHttpRequest();
    //TODO - change to get_users.php
    xhrObject.open("GET", "php/users.php", true);

    //send the GET request
    xhrObject.send();

    // Response from send GET request
    xhrObject.onload = () => {
        if (xhrObject.readyState === XMLHttpRequest.DONE) {
            if (xhrObject.status === 200) {
                if (!searchBar.classList.contains("active")) {
                    usersList.innerHTML = xhrObject.response;
                }
            }
        }
    }
}