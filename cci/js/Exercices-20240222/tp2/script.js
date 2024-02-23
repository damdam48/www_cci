// 1. Ecrire un script qui permet d'afficher la table de multiplication d'un nombre entier n:
// La valeur de n sera demandée à l’utilisateur via une boite de dialogue.
// En cas de saisie d'un nombre non entier le script redemande l'utilisateur de saisir une nouvelle
// valeur.
// L'affichage de résultat doit être se faire dans la console.
// Le faire en do while puis en for


// do while------------------------

// let n = parseFloat(prompt("Entrer un nombre entier :"));
// let i = 0;

// do {
//     i++;
//     console.log(n*i);
// } while (i < 10 );



// for ------------------------

// let n = parseFloat(prompt("Entrer un nombre entier :"));
// for (let i = 0; i < 10; i++) {
//     console.log(n*i);
// }


// --------------------------
// liste toutes les tables

for (let i = 0; i <= 10; i++) {
    console.log(`Voici la table (${i}) de multiplication`);

    for (let l = 0; l <= 10; l++) {
        console.log(`${i} x ${l} = ${i*l}`);
    }
console.log("---------------------------------------------");

}


    




