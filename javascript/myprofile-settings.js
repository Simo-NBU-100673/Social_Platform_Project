let img_input = document.querySelector(".image-container input#image");
let img = document.querySelector(".image-container img");

//When user adds an image it will be displayed in the image container
img_input.addEventListener("change", function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    img.style.animation = "fadeIn 0.3s";
    img.src = tmppath;
});