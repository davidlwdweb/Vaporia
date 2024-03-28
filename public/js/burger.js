'use strict';

const burgerMenu = document.querySelector(".burger");
const navLinks = document.querySelector(".navbar-menu");

burgerMenu.addEventListener('click',()=>{
    navLinks.classList.toggle('mobile-menu');
})