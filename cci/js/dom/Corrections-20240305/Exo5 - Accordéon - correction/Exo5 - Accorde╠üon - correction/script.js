"use strict"

// => je récupère les elements avec la classe accordionItemHeading
// => je rajoute un addEventlistener pour chacun des elements ci-dessus   :
//      ==> Récupèrera la class parente
//      ==> Fermera les parents
//      ==> mettra la classe open si elle était close sur le parent de accordionItemHeading
//      ==> ou la classe close si elle était  open

// Je récupère les h2 avec la class accordionItemHeading
let accordionTitles = document.querySelectorAll(".accordionItemHeading");

for (let i=0; i<accordionTitles.length; i++) {
    accordionTitles[i].addEventListener('click', function() {
        let isClose = this.parentNode.classList.contains('close');
        // Je boucle sur tous les parents et je les ferme
        accordionTitles.forEach(function(accordionTitle) {
            accordionTitle.parentNode.classList.replace('open', 'close');
        })
        if (isClose) {
            this.parentNode.classList.replace('close', 'open');
        }
    })
}