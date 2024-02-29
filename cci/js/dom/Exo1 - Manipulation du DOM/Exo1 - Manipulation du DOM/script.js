const element = document.getElementsByTagName('ul')[0];
console.log(element);

const puce = document.querySelectorAll('ul li');
// console.log(puce);

for (let i = 0; i < puce.length; i++) {
    puce[i].innerHTML = `Element ${i}` ;

    if (i % 2 === 0) {
        puce[i].style.color = 'red';
    } else {
        puce[i].style.color = 'blue';
    }
}
