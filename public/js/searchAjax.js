'use strict';

const search = document.querySelector("#search");

search.addEventListener("keyup", ()=> {
    
    let textFind = document.querySelector("#search").value;
    // console.log(textFind);
    
    let myRequest = new Request("?page=itemsBySearch", {
        
        method  : 'POST',
        body    : JSON.stringify({ textToFind : textFind }) 
        
    });
    
    
    fetch(myRequest)
    
    // Récupérer les données 
    .then(res => res.text())
    
    // Exploiter les données
    .then(res => {
        if(document.getElementById("target") != null){
            document.getElementById("target").innerHTML = res;
        }
    });
});

