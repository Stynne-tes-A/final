const getId = (id) => document.getElementById(id); 
const getsl = (selector) => document.querySelector(selector);
const BASE_URL = "http://localhost/presentation/core/ajax/";

const globalHeader = getsl(".global-header");
const modal = getsl(".menu-container");
const profileButton = getsl(".profile--container");
 const imageElement = getsl(".heroImg");
let slideIndex = 0;

const IMAGE_DATA = [
    "https://localhost/presentation/public/assets/images/1.jpg",
    "https://localhost/presentation/public/assets/images/2.jpg",
    "https://localhost/presentation/public/assets/images/3.jpg",
    "https://localhost/presentation/public/assets/images/4.jpg",
];

const password = getId("password"); // Corrected ID (removed `#`)
const show_hide_password = getsl("#show_hide_password"); // Ensure proper selector

// Toggle password visibility
if (password && show_hide_password) {
    show_hide_password.addEventListener("click", function () {
        if (password.type === "password") {
            password.type = "text";
            show_hide_password.innerText = "Hide"; // Corrected to "Hide"
        } else {
            password.type = "password";
            show_hide_password.innerText = "Show"; // Corrected to "Show"
        }
    });
}

// Slideshow functionality
function showSlides() {
    const slider = () => {
        slideIndex++;
        if (slideIndex > IMAGE_DATA.length - 1) {
            slideIndex = 0;
        }
        imageElement.style.backgroundImage = `url(${IMAGE_DATA[slideIndex]})`;
    };
    slider(); // Display the first slide immediately
    setInterval(slider, 3000); // Repeat every 3 seconds
}

// Start slideshow if imageElement exists
if (imageElement) {
    showSlides();
}

 //Handle profile button click

    
    if (globalHeader) {

        
        profileButton.addEventListener("click", () => {
            console.log("Profile button clicked");
            modal.style.display = modal.style.display === "none" ? "block" : "none";
        });

        $(function(){
            $("#main-search").keyup(function(event){
                const searchValue = $(this).val().trim();
                const resultContainer = $(".search-result");
                $.post(
                    BASE_URL + "search.php",
                    {search: searchValue},
                    function(data){
                        resultContainer.html(data);
                        if (searchValue === "") {
                            resultContainer.html("");
                        }
                    }
                )
        });
    }
    )}
    







