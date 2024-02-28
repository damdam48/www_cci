// Demander deux valeurs à l’utilisateurs
// Ecrire une fonction permettant de comparer deux nombres et de retourner le plus grand des deux.
// Stocker le résultat de cette fonction dans une variable, et retourner cette variable dans une alerte
function functionExo1() {
    let userValue1 = parseFloat(prompt("Entrez un premier nombre"));
    let userValue2 = parseFloat(prompt("Entrez un deuxième nombre"));

    /**
     * Fonction qui compare 2 nombres et renvoie le plus grand
     * 
     * @param {number} value1 - Le premier nombre à comparer
     * @param {number} value2 - Le deuxieme nombre à comparer
     * 
     * @returns {number | false} - renvoie le nombre le plus grand s'il n'y a pas égalité (sinon renvoie false)
     */
    function compareValues(value1, value2) {
        if (value1 > value2) {
            return value1;
        } else if (value1 < value2) {
            return value2
        } else {
            return false
        }
    }

    let higherUserNumber = compareValues(userValue1, userValue2);

    if (higherUserNumber) {
        alert(`${higherUserNumber} est le plus grand !`)
    } else {
        alert("Tu as mis les mêmes nombres, c'est une erreur 🙉 ?")
    }
}


// ---------------------------------------------------------------

// Ecrire le code JS qui génère un entier aléatoire de 0 à 100 puis demande au visiteur de le deviner.
// La fonction getRandomInt() vous permettra de générer le nombre aléatoire.
// A chacune de ses propositions, une indication « trop grand » ou « trop petit » est fournie à l’internaute.
// Une fois la valeur trouvée, un message le lui indique ainsi que le nombre d’essais
// Initier la fonction au lancement de la page

function exo2() {

    /**
     * Renvoi un entier aléatoire entre 0 et 100
     */
    function getRandomInt() {
        return Math.round(Math.random() * 100);
    }

    const randomNumber = getRandomInt();
    
    let userNumber;
    let count = 0;

    do {
        userNumber = parseInt(prompt("Ton nombre ? (et pas ton ombre)"));
        count++;
        if  (userNumber !== randomNumber && userNumber > randomNumber) {
            alert("C'est moins");
        } else if (userNumber !== randomNumber && userNumber < randomNumber) {
            alert("c'est plus");
        }
    } while (userNumber !== randomNumber);

    alert(`Tu as trouvé en ${count} tour(s) 👍`);
}






