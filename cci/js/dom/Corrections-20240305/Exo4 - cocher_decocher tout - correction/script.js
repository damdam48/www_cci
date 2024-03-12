// Je recupère le bouton
let button = document.querySelector("button");

button.addEventListener("click", function () {
    // let nbCkeckBoxes = parseInt(prompt("Combien de cases ?"));
    let inputCheckboxes = document.querySelector("input[type='number'");
    let nbCkeckBoxes = inputCheckboxes.value;


    // Je vérifie que l'user à bien mis un nombre au moins egal à 1
    if (!isNaN(nbCkeckBoxes) && (nbCkeckBoxes > 0)) {

        // Si le container existe déjà je le supprime
        const container = document.querySelector("#checkboxes");
        if (container) container.remove();


        let newContainer = document.createElement("div"),
            newButton = document.createElement("button"),
            div, checkbox, label;

        // Je mets mes classes bootstrap pour le container et le bouton
        newContainer.id = "checkboxes"
        newContainer.classList.add("container", "mt-3", "p-3", "border", "border-secondary", "rounded");  
        newButton.classList.add("btn", "btn-primary", "mt-3");
        newButton.textContent = "Cocher tout";

        // Je boucle pour créer le nombre demandé de checkbox
        for (let i = 0; i < nbCkeckBoxes; i++) {
            // Je cree mes élements
            
            div = document.createElement("div");
            checkbox = document.createElement("input");
            label = document.createElement("label");

            // Leurs attributs et le textcontent
            div.classList.add("form-check", "form-switch");
            checkbox.type = "checkbox";
            checkbox.classList.add("form-check-input");
            label.classList.add("form-check-label");
            checkbox.id = label.HtmlFor = "id" + (i + 1);
            label.textContent = "Checkbox n°" + (i + 1);

            // Je fais mes appendChild
            div.append(checkbox, label);
            newContainer.append(div);
        }



        // J'insere les élements dans le DOM
        newContainer.append(newButton);
        document.body.append(newContainer);

        // Je vide l'input qui demande le nombre de checkbox
        inputCheckboxes.value = "";

        newButton.addEventListener("click", toggleCheckboxes);


    } else {
        alert("Tu n'as pas un nombre correct !");
    }
});

/**
 * coche et décoche les cases
 */
const toggleCheckboxes = function () {
    let ckeckBoxes = document.querySelectorAll(".container div input[type='checkbox']");
    console.log(this); // Le this dans ce cas correspond au bouton qui à lancé cette fonction => celui qui a pour texteContent = cocher tout et son nom de variavle est new button précedemment

    // Je boucle sur le input pour les cocher ou les decocher en fonction de textContent du bouton (de this dans ce cas là)
    if (this.textContent === "Cocher tout") {
        for (let i = 0; i < ckeckBoxes.length; i++) {
            ckeckBoxes[i].checked = true;
        }
        this.textContent = "Décocher tout";
    } else {
        for (let i = 0; i < ckeckBoxes.length; i++) {
            ckeckBoxes[i].checked = false;
        }
        this.textContent = "Cocher tout";
    }

}