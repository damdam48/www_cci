// --- 1.Changer le contenu du bouton contactez-moi en : "Changer le titre" ---

// Je récupère le bouton et je lui change le titre
let theButton = document.querySelector("section#welcome .btn");
let theButtonInitialText = theButton.textContent;
theButton.textContent = "Changer le titre";

// -----------------------

//--- 2. Créer une fonction changeJumbotronTitle() qui :
// 2.1 changera le Titre du Jumbotron en : "Youhou"
// 2.2 remettra le texte initial du bouton

/**
 * Change le titre du Jumbotron et remet le texte du bouton
 */
const changeJumbotronTitle = function() {
    // Je récupère le titre du Jumbo
    let jumbotronTitle = document.querySelector("section#welcome h1");
    // Je lui change son contenu texte
    jumbotronTitle.textContent = "Youhou";
    // Je remet le texte initial du bouton theButton
    theButton.textContent = theButtonInitialText;
}

// -----------------------

//--- 3. A l'aide de onclick = changeJumbotronTitle, faites en sorte que le titre se change au clic sur le bouton nouvellement nommé "Changer le titre"

// Je change le href du bouton pour eviter qu'il m'ouvre la page contact.html
theButton.href = "#welcome";
theButton.onclick = changeJumbotronTitle;

// -----------------------

//--- 4. Faire une autre fonction nommée changeCompetence() qui :

/**
 * Change les textcontent des paragraphes et les src des images de la section compétence
 */
const changeCompetence = function() {
    const t0 = new Date();
    // Je stoque le tableau contenant les nouveaux textes des paragraphes et je crée un tableau contenant les nouvelles sources des images de la section
    let paragraphsNewTexts = [
        "L'HyperText Markup Language, généralement abrégé HTML, est le langage de balisage conçu pour représenter les pages web.",
        "Les feuilles de style en cascade, généralement appelées CSS de l'anglais Cascading Style Sheets, forment un langage informatique qui décrit la présentation des documents HTML et XML. Les standards définissant CSS sont publiés par le World Wide Web Consortium.",
        "JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives mais aussi pour les serveurs avec l'utilisation de Node.js.",
        "AngularJS est un framework JavaScript libre et open source développé par Google. Il permet de développer des pages web"
    ];
    let imagesNewSources = [
        'html',
        'css',
        'js',
        'angular'
    ]
    // Le récupère les paragraphes et les images de la section compétence
    let paragraphs = document.querySelectorAll("section#competence p");
    let images = document.querySelectorAll("section#competence img");

    // Je vérife que j'ai autant de paragaphe de de newText
    if (paragraphs.length === paragraphsNewTexts.length  && images.length === imagesNewSources.length && paragraphs.length === images.length) {
        // Je boucle
        for (let i=0; i<paragraphs.length; i++) {
            paragraphs[i].textContent = paragraphsNewTexts[i];
            images[i].src = `img/logos/${imagesNewSources[i]}.png`;
        }
    } else {
        console.error("Il n'y a pas le même nombre de paragraphe, d'image, de texte et de src");
    }
    const t1 = new Date();
    // console.log(t0.getTime());
    // console.log(t1.getTime());

    console.log(t1 - t0);


}

// Je lance la fonction précédente au clique sur le titre h1 de la section compétence
document.querySelector("section#competence h1").onclick = changeCompetence;