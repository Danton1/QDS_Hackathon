let checkbox = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

// some methods to determine what gets displayed on the navbar.
function check() {
    // If the checkbox is checked, display the output text
    if (checkbox.checked == true){
        // console.log('checked');
        navbar.classList.add('active');
    } else {
        // console.log('unchecked');
        navbar.classList.remove('active');
    }
}
checkbox.addEventListener('click', check);
window.onscroll = () =>{
    checkbox.checked = false;
    navbar.classList.remove('active');
};