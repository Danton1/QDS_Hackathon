let checkbox = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

// some methods to determine what gets displayed on the navbar.
function check() {
    // If the checkbox is checked, display the output text
    if (checkbox.checked == true){
        console.log('checked');
        navbar.classList.add('active');
    } else {
        navbar.classList.remove('active');
    }
}
check();
window.onscroll = () =>{
    checkbox.checked = false;
    navbar.classList.remove('active');
};