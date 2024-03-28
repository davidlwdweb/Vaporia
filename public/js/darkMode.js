'use strict';

const dark_mode_button = document.getElementById('dark_mode_button');
const body = document.body;
let isDarkMode = localStorage.getItem('darkMode') === 'enabled';

function enableDarkMode() {
    body.classList.add('dark_mode');
    localStorage.setItem('darkMode', 'enabled');
    isDarkMode = true;
}

function disableDarkMode() {
    body.classList.remove('dark_mode');
    localStorage.setItem('darkMode', 'disabled');
    isDarkMode = false;
}

function toggleDarkMode() {
    if (isDarkMode) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
}

if (isDarkMode) {
    enableDarkMode();
}

dark_mode_button.addEventListener('click', toggleDarkMode);