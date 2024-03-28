'use strict';

let number = 1;

setInterval(function(){
    if(number == 1){
        document.getElementById('slide-1').classList.remove('afficher1');
        document.getElementById('slide-2').classList.add('afficher2');
        document.getElementById('slide-3').classList.remove('afficher3');
    }else if(number == 2){
        document.getElementById('slide-1').classList.remove('afficher1');
        document.getElementById('slide-3').classList.add('afficher3');
    }else{
        document.getElementById('slide-1').classList.add('afficher1');
        document.getElementById('slide-2').classList.remove('afficher2');
        document.getElementById('slide-3').classList.remove('afficher3');
    }
    number++;
    if(number > 3){
        number = 1;
    }
}, 5000);