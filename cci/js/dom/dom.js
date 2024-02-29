let para1 = document.querySelector('p');
let paraAll = document.querySelectorAll('p');

console.log(para1);
console.log(paraAll);

para1.innerHTML = "Hello World";
paraAll[2].textContent = "Bye World";