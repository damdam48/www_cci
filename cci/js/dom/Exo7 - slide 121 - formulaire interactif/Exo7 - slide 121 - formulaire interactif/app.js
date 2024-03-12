const lastName = document.getElementById("lastName");
const firstName = document.getElementById("firstName");
const age = document.getElementById("age");
const login = document.getElementById("login");
const pwd1 = document.getElementById("pwd1");
const pwd2 = document.getElementById("pwd2");

const test = document.querySelectorAll('input');
console.log(test);

const spanOff = document.querySelectorAll('.tooltip');

lastName.minLength = 2;
firstName.minLength = 2;
age.minLength = 5;
age.maxLength = 140;
login.minLength = 4;
pwd1.minLength = 6;


for (let i = 0; i < spanOff.length; i++) {
    spanOff[i].style.display = 'none';  
    // console.log(spanOff[i]);

}

lastName.addEventListener('input', function(){
    // console.log(lastName.value);
    // console.log(lastName.nextElementSibling);
    console.log(lastName.checkValidity());

    if (!lastName.checkValidity()) {
        lastName.nextElementSibling.style.display = ""; 
        // console.log("Suis le lapin blanc");
    } else {
        lastName.nextElementSibling.style.display = "none";
    }

})

// for (let i = 0; i < array.length; i++) {
//     const element = array[i];
    
// }







document.querySelector('#myForm').addEventListener('submit', function (e) {
    e.preventDefault();

})

