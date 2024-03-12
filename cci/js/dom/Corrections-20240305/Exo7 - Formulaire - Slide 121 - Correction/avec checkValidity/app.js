"use strict";

// Je récupère les tooltips et je les mets en display none
const tooltips = document.querySelectorAll(".tooltip");
for (let tooltip of tooltips) {
  tooltip.style.display = "none";
}

// Je déclare une variable pour vérifier si le formulaire est valide
let isValid = false;

// Je récupère les inputs
const inputs = document.querySelectorAll("input");

// Je boucle sur les inputs et fait un switch pour chaque input puis j'ajoute un event listener
for (let input of inputs) {
    switch (input.id) {
        case "lastName" :
        case "firstName" :
            input.minLength = 2;
            break;
        case "age" :
            input.type = "number";
            input.min = "5";
            input.max = "140";
            break;
        case "login" :
            input.minLength = 4;
            break;
        case "pwd1" :
        case "pwd2" :
            input.minLength = 6;
            break;
    }
    validateInput(input);
}

/**
 * Fonction pour valider les inputs
 * 
 * @param {HTMLInputElement} element - L'élément input à valider
 */
function validateInput(element) {
    element.addEventListener("input", function() {
        isValid = this.checkValidity();
        // Pour pwd 2 je vérifie que le mot de passe 1 et 2 sont identiques
        if (this.id === "pwd2") {
            let pwd1 = document.getElementById("pwd1");
            (this.value === pwd1.value) ? isValid = true : isValid = false;
        }
        if (!isValid) {
            this.classList.add("incorrect");
            this.nextElementSibling.style.display = "inline-block";
        } else {
            this.classList.replace("incorrect", "correct");
            this.nextElementSibling.style.display = "none";          
        }
    });
}

// Je teste au niveau du formulaire si tout est ok
document.querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault();
    if (isValid) {
        alert("Formulaire validé");
    } else {
        alert("Formulaire non valide");
    }
});