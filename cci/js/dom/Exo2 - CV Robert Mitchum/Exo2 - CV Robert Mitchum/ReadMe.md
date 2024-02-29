CV Robert Mitchum


## CV Robert Mitchum

Sur le CV, faire en pur Javascript (ne pas toucher au html, sauf pour lier le script) : 

1. Changer le contenu du bouton contactez-moi en : "Changer le titre"
2. Créer une fonction ```changeJumbotronTitle()``` qui : 
- changera le Titre du Jumbotron en : "Youhou"
- remettra le texte initial du bouton
3. A l'aide de ```onclick = changeJumbotronTitle```, faites en sorte que le titre se change au clic sur le bouton nouvellement nommé "Changer le titre"
4. Faire une autre fonction nommée changeCompetence() qui :
- Changera le contenu des paragraphes de la section compétence avec le contenu de ce tableau : 
```js
    [
        "L'HyperText Markup Language, généralement abrégé HTML, est le langage de balisage conçu pour représenter les pages web.",
        "Les feuilles de style en cascade, généralement appelées CSS de l'anglais Cascading Style Sheets, forment un langage informatique qui décrit la présentation des documents HTML et XML. Les standards définissant CSS sont publiés par le World Wide Web Consortium.",
        "JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives mais aussi pour les serveurs avec l'utilisation de Node.js.",
        "AngularJS est un framework JavaScript libre et open source développé par Google. Il permet de développer des pages web"
    ]
```
- Changera les images génériques par le contenu du dossier logos (sous-dossier de img).
- Faites en sorte que le contenu se change au clic sur le titre content grace à ```onclick```