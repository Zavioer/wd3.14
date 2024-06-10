// based on: https://dev.to/ljcdev/easy-hamburger-menu-with-js-2do0

const menuButton = document.querySelector('.hamburger-menu-btn');
const menu = document.querySelector('nav');

function toggleMenu() {
    if (menu.classList.contains('show-nav')) {
       menu.classList.remove('show-nav'); 
    } else {
       menu.classList.add('show-nav'); 
    }
}

menuButton.addEventListener('click', toggleMenu);
