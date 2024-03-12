// TP : coder un gestionnaire de contact avec un objet
// • Ecrivez un gestionnaire de contact
// • Créer un objet Contact
// • Qui aura 2 propriétés : firstName et lastName
// Et une méthode qui renverra le prénom et le nom
// • Vous initialiserez la base avec deux contacts que vous rangerez dans un tableau :
// • Carole Lévisse
// Mélodie Nelsonne
// • A l'aide de Bootstrap:
// • Créer 2 champs input (pour ajouter prénom et nom)
// Deux boutons
// 1. ajouter un contact
// 2. voir les contacts

// • Pour le 1, il faudra ajouter un contact (nom + prénom) et valider (ou non) dans le DOM avec un modal
// • Pour le 2, il faudra afficher la liste des contacts (dans le DOM)


// Creation de la class Contact
class Contact {
    /**
     * 
     * @param {string} firstName - Prenon de la personne
     * @param {string} lastName - Non de la personne
     * 
     */

    constructor(firstName, lastName) {
        this.firstName = firstName;
        this.lastName = lastName;

    }
    getInfo(){
        return `La personne ce nomme ${this.firstName} ${this.lastName}.`;
    }
}

const contact1 = new Contact("Lévisse", "Carole");
const contact2 = new Contact("Nelsonne", "Mélodie");
// console.log(contact1);
// console.log(contact1.getInfo());

// tableau de Contact
const contacts = [contact1, contact2];
// console.log(contacts);


// start btn add contact
const form = document.querySelector("form");
// console.log(form);

form.addEventListener("submit", function(e) {
    e.preventDefault();
    console.log("ok-------------");
    const firstName = document.querySelector("#firstName");
    const lastName = document.querySelector("#lastName");
    // console.log(firstName);
    // console.log(lastName);

    const newContact = new Contact(firstName.value, lastName.value);
    // console.log(newContact);

    contacts.push(newContact);
    console.log(contacts);

}); // end btn add contact

// bnt voir les contacts
const btn = document.querySelector("#btnTab");

// console.log(form);
btn.addEventListener("submit", function(e) {


});







// function voirContacts() {
//     document.getElementById("lastName").value = contacts[0].lastName;
//     document.getElementById("firstName").value = contacts[0].firstName;

// }

// for (const test of contacts) {
//     console.log(document.getElementById("test").innerHTML);
// }


