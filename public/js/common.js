const getId = (id) => {
    return document.getElementById(id); // Add return statement
}

const getsl = (selector) => {
    return document.querySelector(selector); // Add return statement
}
const imageElement = getSl(".heroImg");
let slideIndex = 0;
const IMAGE_DATA=[
    "https://localhost/presentation/public/assets/images/1.jpg",
    "https://localhost/presentation/public/assets/images/2.jpg",    
    "https://localhost/presentation/public/assets/images/3.jpg",
    "https://localhost/presentation/public/assets/images/4.jpg",    
];

const password = getId("password");
const show_hide_password = getsl("#show_hide_password"); // Ensure to use the correct selector

if (password && show_hide_password) { // Check if both elements exist
    show_hide_password.addEventListener("click", function() {
        if (password.type === "password") {
            password.type = "text";
            show_hide_password.innerText = "Hide"; // Corrected to "Hide"
        } else {
            password.type = "password";
            show_hide_password.innerText = "Show"; // Corrected to "Show"
        }
    });

    function showSlides(){
      const slider = () =>{
            slideIndex++;
            imageElement.style.backgroundImage = `url(${IMAGE_DATA[slideIndex]})`;
            if(slideIndex > IMAGE_DATA.length - 1){
                slideIndex = 0;
            }
            let timer =setInterval(slider, 3000);
      }  
    }
}