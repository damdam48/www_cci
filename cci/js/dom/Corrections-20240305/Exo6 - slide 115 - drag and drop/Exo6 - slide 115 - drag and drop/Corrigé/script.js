// je récupère les objets avec la classe .draggableBox
let boxes = document.querySelectorAll(".draggableBox"),
    storage = {};

// Je boucle les boites
boxes.forEach(function(box) {
    box.addEventListener("mousedown", function (e) {
        // Je stocke la boite ciblée en tant que propriété target de l'objet storage
        storage.target = e.target;
        // Je récupère les coordonnées de l'objet box et je les stocke dans l'objet storage en tant que propriétés x et y
        storage.x = e.clientX - e.target.offsetLeft;
        storage.y = e.clientY - e.target.offsetTop;


        // Je change la couleur au clic
        storage.target.style.backgroundColor = "green";
    });

    box.addEventListener("mouseup", function (e) {
        // Je change la couleur au clic
        storage.target.style.backgroundColor = "blue";

        // Je reset le storage => supprime les propriétés target, x et y
        storage = {};
    });
});

// J'ecoute le mousemove sur l'objet document et je mets à jour les coordonnées de la cible stockée au moment du mousedown (storage.target)
document.body.addEventListener("mousemove", function (e) {
    if (storage.target) {
        storage.target.style.left = (e.clientX - storage.x) + "px";
        storage.target.style.top = (e.clientY - storage.y) + "px";
    }
});