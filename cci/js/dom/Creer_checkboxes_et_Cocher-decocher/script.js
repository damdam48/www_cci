document.addEventListener("DOMContentLoaded", function() {

"use strict";

// Je récupère le bouton qui lancera l'action
const button = document.querySelector("#create-checkboxes");

button.addEventListener("click", getQuantity );

// Le lance aussi la fonction au clic sur la touche "Entrée"
document.addEventListener("keydown", function(e) {
	if (e.key === "Enter") getQuantity();
});


/**
 * Récupère la valeur entrée par l'utilisateur et lance la fonction qui créera les checkbox ou affiche un message d'erreur
 * 
 * @returns {void}
 */
function getQuantity() {
	// Je récupère l'input qui contient le nombre de checkbox à créer
	const input = document.querySelector("input[type=number]");

	// Si l'utilisateur à entré autre chose qu'un nombre, je lui affiche un message d'erreur
	if (!parseInt(input.value)) {
		const errorSpan = document.querySelector("#error-msg");
		errorSpan.textContent = "Veuillez entrer un nombre";
		// return false;
	} else {
		// Je lance la fonction qui créera les checkbox
		createCheckboxes(parseInt(input.value));
	}
}

/**
 * Créer des checkbox et les insère dans le DOM
 * 
 * @param {number} quantity - Le nombre de checkbox à créer 
 * 
 * @returns {void}
 */
function createCheckboxes(quantity) {
	// je créer les éléments qui ne se répètent pas
	const main = document.createElement("div");
	const mockup = document.createElement("div");
	const containerFlex = document.createElement("div");
	const subContainerFlex = document.createElement("div");
	const form = document.createElement("div");
	const button = document.createElement("button");

	// je leur attribue des classes
	main.classList.add("container", "mx-auto");
	mockup.classList.add("mockup-window", "border", "bg-base-300");
	containerFlex.classList.add("flex", "justify-center", "px-4", "py-16", "bg-base-200");
	subContainerFlex.classList.add("flex", "flex-col", "items-center");
	form.classList.add("form-control", "w-52");
	button.classList.add("btn", "btn-primary", "m-2");

	// Je boucle pour créer les checkbox
	for (let i=0; i < quantity; i++) {
		const label = document.createElement("label");
		const span = document.createElement("span");
		const input = document.createElement("input");

		// Je leur attribue des classes
		label.classList.add("label", "cursor-pointer");
		span.classList.add("label-text");
		input.classList.add("toggle", "toggle-primary");
		input.type = "checkbox";
		label.htmlFor = input.id = `checkbox-${i}`;

		// Je rajoute du text au span
		span.textContent = `Checkbox ${i+1}`;

		// Je les insere entre eux
		label.append(span, input);
		form.append(label);
	}

	// Je rajoute du text au bouton
	button.textContent = "Tout cocher";
	button.addEventListener("click", toggleCheckboxes);

	// Je les insere entre eux
	subContainerFlex.appendChild(form);
	containerFlex.appendChild(subContainerFlex);
	mockup.append(containerFlex, button);
	main.appendChild(mockup);

	// Je les insere dans le DOM
	document.body.appendChild(main);

	// Je scroll jusqu'au bouton
	button.scrollIntoView({behavior: "smooth"});
}

/**
 * Coche ou décoche toutes les checkbox
 * 
 * @returns {void}
 *
 */
function toggleCheckboxes() {
	// console.log(this);
	const checkboxes = document.querySelectorAll("input[type=checkbox]");
	if (this.textContent === "Tout cocher") {
		for (let checkbox of checkboxes) {
			checkbox.checked = true;
		}
		this.textContent = "Tout décocher";
	} else {
		for (let checkbox of checkboxes) {
			checkbox.checked = false;
		}
		this.textContent = "Tout cocher";
	}
}

});


