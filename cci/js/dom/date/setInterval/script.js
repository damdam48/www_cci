let intervalId; // Stocker l'identifiant de l'intervalle

function maFonction() {
    console.log("La fonction est exécutée !");
}

document.addEventListener('DOMContentLoaded', function() {
    const startButton = document.getElementById('startButton');
    const stopButton = document.getElementById('stopButton');

    startButton.addEventListener('click', function() {
        intervalId = setInterval(maFonction, 2000); // Exécuter maFonction toutes les 1000 millisecondes (1 seconde)
    });

    stopButton.addEventListener('click', function() {
        clearInterval(intervalId); // Arrêter l'exécution de maFonction à intervalles réguliers
        console.log("setInterval stoper");
    });
});





