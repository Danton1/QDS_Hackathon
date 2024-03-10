// Variables for the hamburger menu
let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

/**
 * Checks if the hamburger menu is checked or not.
 * And determines what gets displayed on the navbar.
 */ 
function check() {
    // If the checkbox is checked, activate the navbar
    if (menu.checked == true){
        navbar.classList.add('active');
    } else {
        navbar.classList.remove('active');
    }
}

// Call the check function when the checkbox is clicked
if(menu){
    menu.addEventListener('click', check);
}

// Deactivate navbar if the user scrolls
window.onscroll = () =>{
    menu.checked = false;
    navbar.classList.remove('active');
};


let errorClose = document.querySelector('.error_close');
let error = document.querySelector('.error');

if(error){
    errorClose.addEventListener('click', () => {
        document.querySelector('.error').style.display = 'none';
    });
}