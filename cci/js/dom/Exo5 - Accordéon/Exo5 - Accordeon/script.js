// => je récupère les elements avec la classes accordionItemHeading
// => je le rajouter un addEventlistener pour chacun des elements si dessus   :
//      ==> Récupèrera la class parente
//      ==> Fermera les parents
//      ==> mettra la classe open si elle était close sur le parent de accordionItemHeading
//      ==> ou la classe close si elle était  open

// Je recupère mes titres


// const accordionItemHeadings = document.querySelectorAll(".accordionItemHeading");
// // console.log(accordionItemHeadings);

// // const accordionItemsOpen = document.querySelector(".open");
// // console.log(accordionItemsOpen);

// // const accordionItemsClose = document.querySelector(".close");
// // console.log(accordionItemsClose);

//     for (let i = 0; i < accordionItemHeadings.length; i++) {
//         accordionItemHeadings[i].addEventListener("click", function () {
//             const isOpen = this.parentNode.classList.contains("open")

//             if (isOpen) {
//                 console.log("sa marche");
//                 this.parentNode.classList.replace('open', 'close')

//             } else {
//                 console.log("sa marche pas");
//                 this.parentNode.classList.replace('close', 'open')
                
//             }
//         })
//         // console.log(accordionItemHeadings[i]);
//     }
    


    // la correction 

    "use strict"

// => je récupère les elements avec la classe accordionItemHeading
// => je rajoute un addEventlistener pour chacun des elements ci-dessus   :
//      ==> Récupèrera la class parente
//      ==> Fermera les parents
//      ==> mettra la classe open si elle était close sur le parent de accordionItemHeading
//      ==> ou la classe close si elle était open sur le parent de accordionItemHeading

const titles = document.querySelectorAll('.accordionItemHeading');

for (const title of titles) {
    title.addEventListener('click', function() {
        // Je vérifie si l'élément cliqué était fermé ou non
        let isClose = this.parentElement.classList.contains('close');
        // Je boucle sur tous les elements pour les fermer
        for (const title of titles) {
            title.parentElement.classList.replace('open', 'close');
        }
        // J'ouvre l'élément cliqué s'il était fermé
        if (isClose) this.parentElement.classList.replace('close', 'open');
    });
}

