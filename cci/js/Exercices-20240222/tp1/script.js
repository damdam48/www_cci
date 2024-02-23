// 2. Créer un fichier html de base
// Lier le script https://files.desplaces.net/dwwm/dwwm_names.js
// Créer votre propre script et retrouver le type de la variable avec votre prenom et votre nom en
// camel case.
// Afficher dans la console le type de la variable, son nom et sa valeur. Le tout concaténée dans une
// phrase, du type :
// La variable [nom de la variable] est de type [type de la variable] et sa valeur
// est [valeur de la variable]



// let prenom = "le creput",
//     firstName = "roberto";

//     console.log(prenom + firstName);

// alert(`Voici ce que les variables retournent, ${prenom} ${firstName}. De type ${typeof maVariable} `);



// ------------------------------------------------------
// 3. Déterminer si une année est bissextile (utiliser l’opérateur modulo)
// Pour rappel, une année est bissextile si elle est divisible par 4 sans être divisible par 100 ou si elle
// est divisible par 400 (cf. Wikipedia).


// corriger

// "use strict"

// // Un année est bissexitle si elle est divisible par 4, sauf si elle est divisible par 100, sauf si elle est divisible par 400.

// let msg = "Entrez une année";
// let year;

// do {
//     year = prompt(msg);
//   if (isNaN(year)) {
//         alert("Abruti");
//         msg = "Ecris vraiment une année"
//     } 
// } while(isNaN(year));

// if ((year % 4 == 0 && year % 100 != 0 ) || (year % 400 == 0)) {
//     alert(`${year} est bissextile !`);
// } else {
//     alert(`${year} n'est pas bissextile !`);
// }

// // Ou en verison ternaire
// ((year % 4 == 0 && year % 100 != 0 ) || (year % 400 == 0)) ? alert(`${year} est bissextile !`) : alert(`${year} n'est pas bissextile !`);






// -------------------------------------------------------
// 4. Déclarer une variable de type number. Ecrivez une condition pour savoir si le contenu de cette
// variable est supérieur à 10. Si tel est le cas, affichez une fenêtre alert() pour en informer
// l'utilisateur.



// let number = prompt(`ecrit un chiffre entre 0 et 20`)

// if (number >= 10) {
//     alert(`Super bien jour`);

// } else {
//     alert(`Tes une chèvre`);
// }



// --------------------------------------------------------
// 5. Ecrire le code qui permet de demander trois notes à l’utilisateur (Note1, Note2, Note3) puis calcule
// et affiche la moyenne dans une alerte.

// let note1 = parseFloat (prompt("Entrez la première note :"));
// let note2 = parseFloat (prompt("Entrez la deuxieme note :"));
// let note3 = parseFloat (prompt("Entrez la troisieme note :"));

// let total = (note1 + note2 + note3);
// // alert(total);

// let moyenne = (total) / 3;
// alert(`La moyenne est de : ${moyenne}`);



// --------------------------------------------------------
// 6. Écrivez une boucle while qui se répète 10 fois. Il est vrai qu'une boucle for serait plus adaptée,
// mais le but est de vous familiariser avec whilel.


// let count =(0);

// while (count < 10) {
//     alert(`Voici le tour (${count +1}) de la boucle.`)
//     count++
// }



// --------------------------------------------------------
// 7. Grace à une boucle do ... while, faire un script qui permet de demander ses notes à l’utilisateur tant
// que celui-ci entre un nombre*.
// Si l'utilisateur entre une mauvaise valeur (note non comprise entre 0 et 20 ou chaîne de caractères)
// lui demander de recommencer.
// Une fois qu’il entre n'entre plus rien, le script calcule et affiche la moyenne.


let nomber;

do {
    nomber = parseFloat(prompt(`Entre une note :`));

    if (isNaN(nomber)) {
        alert("Tu doit rentrer des CHIFFRES");
    } else if (nomber >= 21 || nomber < 0) {
        alert("Entre un chiffre en 0 et 20");
    }

} while (nomber >= 21 || nomber < 0 || isNaN(nomber));

alert(`Ta note est de (${nomber})`);

