
//1.
// Je récupère le bouton
const heroButton = document.querySelector('#welcome .btn.blue');
const orginalBtnText = heroButton.textContent;
heroButton.textContent = "Changer le titre";


//2.
function changeJumbotronTitle(e) {
	console.log(e);
	e.preventDefault();
	// Je récupère le titre
	const jumbotronTitle = document.querySelector('#welcome h2');
	// Je change le titre
	jumbotronTitle.textContent = "Youhou !";
	heroButton.textContent = orginalBtnText;
}

// 3.
// heroButton.onclick = changeJumbotronTitle;
heroButton.addEventListener('click', changeJumbotronTitle);

//4.

function changeCompetence() {
	const newParagraphTexts =  [
		"L'HyperText Markup Language, généralement abrégé HTML, est le langage de balisage conçu pour représenter les pages web.",
		"Les feuilles de style en cascade, généralement appelées CSS de l'anglais Cascading Style Sheets, forment un langage informatique qui décrit la présentation des documents HTML et XML. Les standards définissant CSS sont publiés par le World Wide Web Consortium.",
		"JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives mais aussi pour les serveurs avec l'utilisation de Node.js.",
		"AngularJS est un framework JavaScript libre et open source développé par Google. Il permet de développer des pages web"
];
	const newImgSources = ['html', 'css', 'js', 'angular'];
	const competenceParagraphs = document.querySelectorAll('#competence p');
	const competenceImages = document.querySelectorAll('#competence img');

	if (competenceParagraphs.length === newParagraphTexts.length && competenceImages.length === newImgSources.length) {
		for (let i=0; i<competenceParagraphs.length; i++) {
			competenceParagraphs[i].textContent = newParagraphTexts[i];
			competenceImages[i].src = `img/logos/${newImgSources[i]}.png`;
		}
	}
}
const titleCompetence = document.querySelector("#competence h2");
console.log(titleCompetence);
titleCompetence.addEventListener('click', changeCompetence);
