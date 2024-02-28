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