// Demander deux valeurs à l’utilisateurs
// Ecrire une fonction permettant de comparer deux nombres et de retourner le plus grand des deux.
// Stocker le résultat de cette fonction dans une variable, et retourner cette variable dans une alerte


let valeur1 = parseInt(prompt("Entre la permiere valeur"));
let valeur2 = parseInt(prompt("Entre la deuxieme valeur"));


function comparer(val1, val2) {
    if (val1 > val2) {
        console.log(`C'est ${valeur1} qui a gagnier`);
    } else {
        console.log(`C'est ${valeur2} qui a gagnier`);
    }
}

alert(comparer);
