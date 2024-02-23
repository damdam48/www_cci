// "use sctrict";

// let myVariable = 1*2;
// console.log(myVariable);

// let number1 = 2; 
// let number2 = 4;
// let divisor = 6;

// let result1,
//     result2,
//     result3;


// result1 = number1 + number2;
// console.log(result1);

// result2 = number1 * divisor;
// console.log(result2);





// let myPrenom = prompt("quelle est ton prénom ?");
// console.log(myPrenom);

// let myName = prompt("quelle est ton nom ?");
// console.log(myName);

// alert(myName + ' ' + myPrenom)

// ------------------------------------------------------------------------------------------------------------

// "use strict";

// let firstname = prompt("C'est quoi ton prénom, gros ?");
// let lastname = prompt("Et ton nom ?");

// let helloUser = `Salut ${firstname} ${lastname} 👋`;
// let coucouUser = "Sinon je te dis bonjour " + firstname + " " + lastname + " en me prenant la tête avec la concaténation 😵‍💫";

// alert(helloUser);
// alert(coucouUser);



// "use strict"

// // Je demande un chiffre entre 0 et 20 à l'uilisateur
// let userNote = prompt("T'as eu combien (note entre 0 et 20)");
// // Je transforme la string retournée en number
// userNote = parseFloat(userNote); // Soit un number soit NaN
// // Si c'est pas un nombre, je l'insulte
// if (isNaN(userNote)) {
//     alert("Tu vois ce que c'est un nombre ?");
// } else {
//     // Sinon, 
//     // - Si c'est tout bon, je verifie qu'il a bien les differentes possibilités (0-7, 7-10, 10-15, 15-20)
//     if (userNote >= 0 && userNote < 7) {
//         alert("T'es mauvais");
//     } else if (userNote >= 7 && userNote < 10) {
//         alert("Presque...");
//     } else if (userNote >= 10 && userNote < 15) {
//         alert("T'as la moyenne mais bon, c'est facile quand même");
//     } else if (userNote >= 15 && userNote <= 20) {
//         alert("👍")
//     } else {
//         // - sinon je l'insulte
//         alert("Un nombre compris entre 0 et 20... tu vois ?")
//     }
// }



"use strict"

let myVariable;
let i = 1;

while (true) {
    myVariable = prompt(`entre le nom de ta soeur ou te ton fere (${i++})`);
    console.log(myVariable);

    if (myVariable == false) {
        break;
    }
}
