"use strict";
// Mon code Javascript
console.log("OK : script lié");


/*###########################################################

EXERCICE : TOGGLE IMG

Ajouter en pur js :
- un 4eme paragraphe avec la class « okPourLePrem » et un contenu Lorem ipsum
- Ajouter une div a la suite de la premiere avec id=‘myDiv2’ qui contient elle-même 
    - un titre h2 : Quelle belle image !
    - un bouton un onclick qui lancera une fonction : toggleImg avec comme contenu «  Clique pour supprimer l'image »
    - l’image qui se trouve dans le dossier.
- Créer la fonction togleImg :
    - qui supprime l’image puis change le bouton en « remettre l’image »
    - puis fait l’inverse


###########################################################*/


// Création d'un 4eme paragraphe :
//  => Lui mettre son id
//  => Lui mettre son contenu texte
//  => l'inserer dans la div précédemment récupérées

// Déclaration et instanciation des variables
let myDiv = document.querySelector("#myDiv");
let newPara = document.createElement('p');

// Gestion des attributs
// newPara.className = "okPourLePrem";
newPara.classList.add("okPourLePrem");

// Gère le texte
newPara.textContent = "lorem ipsum";

// Je l'insere en tant qu'enfant de myDiv
myDiv.appendChild(newPara);


/* ###########################################################*/

// Ajouter une div après la div#myDiv :
// => Creation des éléments
//      ==> la div
//      ==> le h2
//      ==> le bouton
//      ==> l'image
// => Ajout des attributs
//      ==> un id myDiv2 sur la nouvelle div
//      ==> rien sur le h2
//      ==> onclick avec comme valeur toggleImg() sur le bouton
//      ==> le src et alt de l'image
// => Ajout du texte
//      ==> Quelle belle image pour le h2

// -- Je déclare mes variables --
let newDiv,
    newH2,
    newBtn,
    newImg;


// -- je crée les éléments HTML ---
newDiv = document.createElement('div');
newH2 = document.createElement('h2');
newBtn = document.createElement('button');
newImg = document.createElement('img');

// -- Les attributs --
newDiv.id = "myDiv2";
newImg.src = "img.jpg";

//  -- Le texte --
newH2.textContent = "Quelle belle image !";
newBtn.textContent = "Supprimer l'image";

// -- J'insere les enfants de la newDiv --
newDiv.append(newH2, newBtn, newImg);

// -- J'insère la div dans la DOM --
myDiv.parentElement.appendChild(newDiv);


/**
 * Fait un toggle sur l 'image jsdoc => https://jsdoc.app/
 * 
 */
const toggleImg = function() {
    if ( newBtn.textContent === "Supprimer l'image" ) {
        newDiv.removeChild(newImg);
        newBtn.textContent = "Afficher l'image"
    } else {
        newDiv.appendChild(newImg);
        newBtn.textContent = "Supprimer l'image"
    }
}


// Je lance la fonction toggleImg au clic sur le bouton
// newBtn.addEventListener('click', toggleImg)
// newBtn.addEventListener('click', function() {
//     alert('aie');
// })

newBtn.onclick = toggleImg;
