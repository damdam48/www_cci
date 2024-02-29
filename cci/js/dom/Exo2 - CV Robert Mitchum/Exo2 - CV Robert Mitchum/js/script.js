
// change titre et btn
function changeJumbotronTitle() {
    // change le name du btn contactez moi en Changer le titre
    const btnContact = document.querySelector('.btn')
    // console.log(btnContact.firstChild);
    btnContact.innerHTML = ('Changer le titre');


    // change le titre Développeur web en Youhou
    const titre = document.querySelector('.display-1');
    titre.innerHTML = ('Youhou');

    // log
    // console.log(titre.firstChild);

}
// changeJumbotronTitle()


// version 1
// function changeCompetence(){
//     // change paragraphe 

//     const sectionCompetence = document.querySelectorAll('#competence p')
//     // log
//     // console.log(sectionCompetence);

//     sectionCompetence[0].innerHTML = "L'HyperText Markup Language, généralement abrégé HTML, est le langage de balisage conçu pour représenter les pages web.",

//     sectionCompetence[1].innerHTML = "Les feuilles de style en cascade, généralement appelées CSS de l'anglais Cascading Style Sheets, forment un langage informatique qui décrit la présentation des documents HTML et XML. Les standards définissant CSS sont publiés par le World Wide Web Consortium.",
    
//     sectionCompetence[2].innerHTML = "JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives mais aussi pour les serveurs avec l'utilisation de Node.js.",
    
//     sectionCompetence[3].innerHTML = "AngularJS est un framework JavaScript libre et open source développé par Google. Il permet de développer des pages web";



//     // change logo paragraphe
//     const sectionCompetenceLogo = document.querySelectorAll('#competence img');
//     // log
//     console.log(sectionCompetenceLogo);
//     sectionCompetenceLogo[0].src = "img/logos/html.png";
//     sectionCompetenceLogo[1].src = "img/logos/css.png";
//     sectionCompetenceLogo[2].src = "img/logos/js.png";
//     sectionCompetenceLogo[3].src = "img/logos/angular.png";


// }

// changeCompetence()



// version 2
function changeCompetence(){
    // change paragraphe 

    const sectionCompetence = document.querySelectorAll('#competence p')
    // log
    // console.log(sectionCompetence);

    const paragrapheTexte = [
        "L'HyperText Markup Language, généralement abrégé HTML, est le langage de balisage conçu pour représenter les pages web.", 
        "Les feuilles de style en cascade, généralement appelées CSS de l'anglais Cascading Style Sheets, forment un langage informatique qui décrit la présentation des documents HTML et XML. Les standards définissant CSS sont publiés par le World Wide Web Consortium.",
        "JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives mais aussi pour les serveurs avec l'utilisation de Node.js.",
        "AngularJS est un framework JavaScript libre et open source développé par Google. Il permet de développer des pages web"
    ]

for (let i = 0; i < sectionCompetence.length; i++) {
    sectionCompetence[i].innerHTML = paragrapheTexte[i]
    // log
    // console.log(sectionCompetence[i])
    
}
const images = document.querySelectorAll('#competence img');
    // log
    console.log(images)


}

changeCompetence()