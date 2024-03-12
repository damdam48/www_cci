// Je récupère l'unique ul avec un getElementsByTagName
let myUl = document.getElementsByTagName('ul');
// Je récupère le li dans ce premier ul
let myItems = myUl[0].querySelectorAll('li')

// Je boucle dans le tableau qui contient tous les li
myItems.forEach(function(item, key) {
    // Je change le contenu texte
    item.textContent = `Element ${key + 1}`;
    // Je change la couleur en fonction de la position (paire/impaire)
    if (key % 2 === 0) {
        item.style.color = "red";
    } else {
        item.style.color = "green";
    }
})