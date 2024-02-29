// 4. Ranger un tableau !
// Réalisez la fonction sortNumbers qui permettra de séparer un tableau envoyé en paramètre (ou
// argument) en 2 tableaux :
// arrayInf, avec les nombre inférieurs à 10
// arraySup avec les autres (supérieurs à 10)
// Retourner les deux tableaux dans un objet avec pour propriétés inf et sup
// Lancer la fonction sortNumber avec un tableau contenant plusieurs valeurs, comme celui-ci :[40, 1,
// 5, 20, 8, 83, 9]
// Afficher dans la console :
// l’objet contenant les deux tableaux, puis
// le tableau des valeurs inférieures à 10 dans la console, puis
// Le tableau des valeurs supérieures à 10

/**
    * Fonction qui sépare un tableau en deux tableaux, un avec les valeurs inférieures à 10 et l'autre avec les valeurs supérieures à 10 
    *
    * @param {numbers[]} numbers - Le tableau de nombres à séparer
    *
    * @returns {object} - Un objet contenant deux propriétés inf et sup qui contiennent les tableaux des valeurs inférieures et supérieures à 10
    */
const sortNumbers = function(numbers) {
    let arrayInf = [];
    let arraySup = [];

    for (let value of numbers) {
        if (value < 10) {
            arrayInf.push(value);
        } else {    
            arraySup.push(value);
        }
    }

    return {
        inf: arrayInf,
        sup: arraySup
    }

}

const myArrayToSort = [40, 1, 5, 20, 8, 83, 9];
const sortedArray = sortNumbers(myArrayToSort);
console.log(sortedArray);
console.log(sortedArray.inf);
console.log(sortedArray.sup);