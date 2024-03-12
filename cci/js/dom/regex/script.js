const myString = "lapin";

const oneLettreMag = (myString[0].toUpperCase());
// console.log(oneLettreMag); // l

const allLettreMin = (myString.slice(1));
// console.log(allLettreMin); // apin


console.log(`${oneLettreMag}${allLettreMin}`);

console.log("------------------------");
// -----------------------------------------------
const myComposedString = "lapin";
const myComposedStringPremon = "blanc";

const one = (myComposedString[0].toUpperCase());
// console.log(one); // l

const all = (myComposedString.slice(1));
// console.log(all); // apin

const oneP = (myComposedStringPremon[0].toUpperCase());
// console.log(oneP); // B

const allP = (myComposedStringPremon.slice(1));
// console.log(allP); // blanc

console.log(`${one}${all} ${oneP}${allP}`);
console.log("------------------------");

// -----------------------------------------------

const composed = "lapin super relou-blue";
const regex = /[\s-]/;

// tester si ya un tiret ou espace

if (regex.test(composed)) {
    console.log(true);

    console.log(composed.split(" "));

    const composedMag = (composed[0].toUpperCase());

    const composedMin = (composed.slice(1));

    console.log(`${composedMag}${composedMin}`);

    
} else {
    console.log(false);
}




// const composedD = composed.split(" ")
// // console.log(ComposedD);
// console.log(composedD.join(""));

// const oneC = (composedD[0].toUpperCase());
// console.log(oneC); // l

// const allC = (composedD.slice(1));
// // console.log(all); // apin

// console.log(`${oneC} ${allC}`);

console.log("------------------------");



// -----------------------------------------------
// const mySecondComposedString = "eer-dftghjkl";
// const myArray = ["eer", "dftghjkl"];

// console.log(myString.toUpperCase()); // EERDFTGHJKL
// console.log(myComposedString.split(" ")); // ["eer", "dftghjkl"]
// console.log(mySecondComposedString.split("-")); // ["eer", "dftghjkl"]

// console.log(myArray.join(" ")); // eer dftghjkl
// console.log(myArray.join("-")); // eer-dftghjkl