"use strict";


//Nombre de cases du carré
let squaresSize = 3;
//Déclaration de la variable permettant de connaitre le tour
let count = 0;
// Une variable qui va créer la condtion du test
let condition;

//Déclaration de la constante recupérant les cases sous forme de "tableau"
let squares = document.querySelectorAll(".square"),
  squaresLength = squares.length;

/**
 * Vide la grille
 */
const resetGrid = function() {
  count = 0;
  for (let i = 0; i < squaresLength; i++) {
    squares[i].innerHTML = "";
  }
}


/**
 * Affiche le vainqueur
 * 
 * @param {string} value 
 * @param {boolean} condition 
 */
const showWinner = function(value, condition) {
  // la condition sera utiliser que si on teste avec des boucles (ligne 70)
  if (condition) {
    // TODO : faire une mise en forme plus glamour !
    alert("Le joueur " + value + " a gagné !");
    resetGrid();
  }
}


/**
 * Gestion des victoires horizontales (il faut tester pour les cases 0, 3 et 6)
 * 
 * @param {number} index 
 */
const horizontalCheck = function(index) {
  if (index % 3 === 0) {
    condition = "squares[" + index + "].innerHTML !== '' ";
    for (let i = 1; i < squaresSize; i++) {
      condition += " && squares[" + index + "].innerHTML === squares[" + (index + i) + "].innerHTML ";
    }
    showWinner(squares[index].innerHTML, eval(condition));
  }
}


/**
 * Gestion des victoires verticales (il faut tester pour les cases 0, 1 et 2)
 * 
 * @param {number} index 
 */
const verticalCheck = function(index) {
  if (index < squaresSize) {
    condition = "squares[" + index + "].innerHTML !== '' ";
    for (let i = 1; i < squaresSize; i++) {
      condition += " && squares[" + index + "].innerHTML === squares[" + (index + i * squaresSize) + "].innerHTML ";
    }
    showWinner(squares[index].innerHTML, eval(condition));

  }
}

/**
 * Gestion des diagonales
 * 
 * @param {number} index 
 */
const diagonalCheck = function(index) {
  // Gestion des diagonales descendantes 
  switch (index) {
    case 0:
      condition = "squares[" + index + "].innerHTML !== '' ";
      for (let i = 1; i < squaresSize; i++) {
        condition += " && squares[" + index + "].innerHTML === squares[" + (index + i * (squaresSize + 1)) + "].innerHTML ";
      }
      break;

    case (squaresSize - 1):
      condition = "squares[" + index + "].innerHTML !== '' ";
      for (let i = 1; i < squaresSize; i++) {
        condition += " && squares[" + index + "].innerHTML === squares[" + (index + i * (squaresSize - 1)) + "].innerHTML ";
      }
      break;
  }
  // La fonction eval va permettre d'utiliser le contenu de condition (si on met juste condition, il testera son existence)
  showWinner(squares[index].innerHTML, eval(condition));
}

/**
 * Lance les tests
 */
const win = function() {
  for (let i = 0; i < squaresLength; i++) {
    horizontalCheck(i);
    verticalCheck(i);
    diagonalCheck(i);   
  }
   /* 
      //==============================
      //ON PEUT TESTER AUSSI TOUTES LES CONDITIONS !

             //En ligne : 
             if (squares[0].innerHTML !== "" && squares[0].innerHTML === squares[1].innerHTML && squares[1].innerHTML === squares[2].innerHTML) {
                 showWinner(squares[0].innerHTML);
             } else if (squares[3].innerHTML !== "" && squares[3].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[5].innerHTML) {
                 showWinner(squares[3].innerHTML);
             } else if (squares[6].innerHTML !== "" && squares[6].innerHTML === squares[7].innerHTML && squares[7].innerHTML === squares[8].innerHTML) {
                 showWinner(squares[6].innerHTML);
             }

              //En colonne : 
              if (squares[0].innerHTML !== "" && squares[0].innerHTML === squares[3].innerHTML && squares[3].innerHTML === squares[6].innerHTML) {
                  showWinner(squares[0].innerHTML);
              } else if (squares[1].innerHTML !== "" && squares[1].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[7].innerHTML) {
                  showWinner(squares[1].innerHTML);
              } else if (squares[2].innerHTML !== "" && squares[2].innerHTML === squares[5].innerHTML && squares[5].innerHTML === squares[8].innerHTML) {
                  showWinner(squares[2].innerHTML);
              }

              //En diagonale : 
              if (squares[0].innerHTML !== "" && squares[0].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[8].innerHTML) {
                  showWinner(squares[0].innerHTML);
              } else if (squares[6].innerHTML !== "" && squares[6].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[2].innerHTML) {
                  showWinner(squares[6].innerHTML);
              }
           */
}

/**
 * Ajoute la croix ou le rond uniquement si la case est vide 
 * puis test s'il y a victoire ou non
 */
function play() {
  // Si CETTE (this) case est vide 
  if (!this.innerHTML) {
    // J'augmente le compteur de un     
    count++;

    // Puis je calcule à qui le tour (nombre pair : O et nombre impair X)
    if (count % 2 === 0) {
      this.innerHTML = "O";
    } else {
      this.innerHTML = "X";
    }

    // J'arrete le jeu si le compteur est égal à 9
    if (count === 9) {
      // puis je lance une alerte et je vide la grille
      alert("Match nul !");
      resetGrid();
    } else {
      win(); // Lance la fonction win
    }
  }
}

// Au démarrage, on boucle sur toutes les cases puis lance la fonction play au click
squares.forEach(function (e) {
  e.addEventListener("click", play);
});
//Le même code avec une autre une fonction fléchée 
//squares.forEach(element => element.addEventListener("click", play));