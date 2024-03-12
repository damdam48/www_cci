// Fonction de désactivation de l'affichage des "tooltips"
function deactivateTooltips() {

    let tooltips = document.querySelectorAll('.tooltip');

    for (let i = 0; i < tooltips.length; i++) {
        tooltips[i].style.display = 'none';
    }

}

// La fonction ci-dessous permet de récupérer la "tooltip" qui correspond à notre input

const getTooltip = function (input) {
  console.log(input);
    let nextElement = input.nextElementSibling;

    while (nextElement.className !== "tooltip") {
        nextElement = nextElement.nextElementSibling;
    }

    return nextElement;
}



// Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok

let check = {}; // On met toutes nos fonctions dans un objet littéral

/* Toutes les fonctions ci-dessous font quasi la même chose :
    - Elle récupère le champ de formulaire
    - Elle récupère le style du tooltip pour pouvoir le modifier ensuite, pour cela elle utilise la fonction getTooltip qui retourne le tooltip correspondant au champ du formulaire selectionné
    - Elle verifie par la condition adequat si le champ est bien rempli
        - Si c'est le cas :
            - Elle ajoute la classe "correct" qui met le champ en vert
            - Elle supprime le tooltip, 
            - Puis elle renvoie true (qui permettra ensuite d'envoyer le form complet si tout est egal à true)
        - Sinon : 
            - Elle ajoute une classe "incorrect" qui met le champ en rouge,
            - Elle affiche le tooltip,
            - Retourne false
*/
check.sex = function (sex = document.getElementsByName('sex')) {

    let tooltipStyle = getTooltip(sex[1].parentNode).style;

    if (sex[0].checked || sex[1].checked) {
        tooltipStyle.display = 'none';
        return true;
    } else {
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check.lastName = function (id) {

    let name = document.getElementById(id),
        tooltipStyle = getTooltip(name).style;

    if (name.value.length >= 2) {
        name.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        name.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check.firstName = check.lastName; // La fonction pour le prénom est la même que celle du nom

check.age = function (age = document.getElementById('age')) {
    let tooltipStyle = getTooltip(age).style,
        ageValue = parseInt(age.value);
    //console.log("ageValue");

    if (!isNaN(ageValue) && ageValue >= 5 && ageValue <= 140) {
        age.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        age.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check.login = function (login = document.getElementById('login')) {

    let tooltipStyle = getTooltip(login).style;

    if (login.value.length >= 4) {
        login.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        login.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check.pwd1 = function (pwd1 = document.getElementById('pwd1')) {

    let tooltipStyle = getTooltip(pwd1).style;

    if (pwd1.value.length >= 6) {
        pwd1.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pwd1.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check.pwd2 = function (pwd2 = document.getElementById('pwd2')) {

    let pwd1 = document.getElementById('pwd1'),
        tooltipStyle = getTooltip(pwd2).style;

    if (pwd1.value == pwd2.value && pwd2.value != '') {
        pwd2.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pwd2.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check.country = function (country = document.getElementById('country')) {

    let tooltipStyle = getTooltip(country).style;

    if (country.options[country.selectedIndex].value != 'none') {
        tooltipStyle.display = 'none';
        return true;
    } else {
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

// dans l'objet check, on récupère tout le return des fonctions, s'il sont tous true, le result est true aussi et on lance le formulaire


// Mise en place des événements

(function () { // Utilisation d'une IIFE : (Immediately Invoked Function Expression) pour éviter les variables globales.

    let myForm = document.getElementById('myForm'),
        inputs = document.querySelectorAll('input[type=text], input[type=password]'),
        inputsLength = inputs.length;

    // On boucle pour tester chaque champ via la fonction stoquée dans l'objet littéral check qui prend en argument l'id du champ
    for (let i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('input', function () {
            check[this.id](this.id); // "this" représente l'input actuellement modifié => check[this.id] correspond à check[lastName] soit check.lastName pour le champ Nom
        });
    }

    // A la soumission du formulaire, on teste si tout les champs check.sex, check.lastName, check.firstName... sont égal à true
    myForm.addEventListener('submit', function (e) {

        let result;

        console.log(check);

        // dans l'objet check, on récupère tout le return des fonctions, s'il sont tous true, le result est true aussi et on lance le formulaire
        for (let input in check) {
            result = check[input](input);
        }

        if (result) {

            // On lance une alerte, mais normalement, on devrai justre laisser le formulaire s'envoyer (en php)
            alert('Le formulaire est bien rempli.');
        } else {
            // Sinon on annule l'action qui enverrait le formulaire
            e.preventDefault();
        }

    });

    myForm.addEventListener('reset', function () {

        // Enlève les classe spéciales des inputs : vert/rouge : le input de type reset vide par defaut le formulaire en html
        for (let i = 0; i < inputsLength; i++) {
            inputs[i].className = '';
        }

        // Et désactive tous les tooltips
        deactivateTooltips();

    });

})();




// Maintenant que tout est initialisé, on peut désactiver les "tooltips"

deactivateTooltips();