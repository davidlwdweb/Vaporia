'use strict';

// Sélectionner mes éléments
let select = document.getElementById("categorie");
let power = document.getElementById("power");
let capacity = document.getElementById("capacity");
let battery = document.getElementById("battery");

let selectValue = select.value; // Récupérer la valeur du select ( 2; 3; 4 )

// Paramètrage par défaut des éléments en disabled
power.disabled = false;
battery.disabled = false;
capacity.disabled = false;
    
if (selectValue === "2" || selectValue === "4") {
    power.disabled = true;
    battery.disabled = true;
} else if (selectValue === "3") {
    battery.disabled = true;
    capacity.disabled = true;
}


// Ecoute d'évènement sur le select, lorsqu'il change
select.addEventListener("change", function () {
    let selectValue = select.value;

    if (selectValue === "2" || selectValue === "4") {
        
        power.disabled = true;
        battery.disabled = true;
        capacity.disabled = false;
    } else if (selectValue === "3") {
        
        capacity.disabled = true;
        battery.disabled = true;
        power.disabled = false;
    } else {
        
        power.disabled = false;
        capacity.disabled = false;
        battery.disabled = false;
    }
});
