"use strict";

const inputs = document.querySelectorAll("input[type=text], input[type=password]");
let isFormValid = false;

// Boucle sur les inputs et fait un switch pour chaque input puis lance la fonction validateInput
for (let input of inputs) {
	input.nextElementSibling.style.display = "none";
	console.log(input.name)
	switch (input.name) {
		case "lastName":
		case "firstName":
			input.minLength = 2;
			break;
		case "age":
			input.type = "number";
			input.min = "5";
			input.max = "140";
			break;
		case "login":
			input.minLength = 4;
			break;
		case "pwd1":
		case "pwd2":
			input.minLength = 6;
			break;
	}
	validateInput(input);
}

/**
 * Ajoute un event listener sur l'input pour valider les inputs
 * 
 * @param {HTMLInputElement} element 
 */
function validateInput(element) {
	element.addEventListener("input", function() {
		this.classList.add("incorrect");
		// Pour tous les inputs sauf pwd2
		(this.checkValidity()) ? displayTooltip(this, true) : displayTooltip(this, false)

		// Pour pwd2 je vérifie que le mot de passe 1 et 2 sont identiques
		if (this.name === "pwd2") {
			const pwd1 = document.querySelector("input[name=pwd1]");
			(this.value === pwd1.value) ? displayTooltip(this, true) : displayTooltip(this, false);
		}
	})
}

/**
 * Affiche ou cache le tooltip en fonction de la validité de l'input
 * et change la couleur de l'input en fonction de sa validité
 * 
 * @param {HTMLInputElement} element - L'élément input à valider
 * @param {boolean} inputIsOK - Si l'input est valide ou non
 */
function displayTooltip(element, inputIsOK) {
	if (inputIsOK) {
		isFormValid = true;
		element.classList.replace("incorrect", "correct");
		element.nextElementSibling.style.display = "none";
	} else {	
		isFormValid = false;
		element.classList.replace("correct", "incorrect");
		element.nextElementSibling.style.display = "inline-block";
	}
}

/**
 * Ajoute un event listener sur le formulaire pour empêcher l'envoi du formulaire
 */
document.querySelector("form").addEventListener("submit", function(event) {
	if (!isFormValid) {
		event.preventDefault();
	}
})