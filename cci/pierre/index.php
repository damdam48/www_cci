<h1>Hello World</h1>
<h2>coucou</h2>

<!-- <?= 'coucou' ;?> -->

<?php

// $name = "damien";

// echo "Bonjour $name, comment va tu ?";

// // phpinfo();

// $numero = 10 + 10;

// echo $numero;

// $numer = 10;

// echo $numer += 10;


// $age = "20";

// if ($age == 20) {
//     echo "ok";
// }

// $age = "14";

// if ($age >= 18) {
//     echo "vous etre majeur";
// } else {
//     echo "vous etes mineur";
// }

// $users = ['pierre', 'paul', 'jacque'];

// echo $user[1];

// foreach ($users as $user) {
//     echo $user;
// }


$user = [
    'prenom' => 'pierre',
    'nom' => 'bertrans',
    'age' => 26,
];

// echo $user['age'];

// foreach ($user as $info) {
//     echo $info;
//     echo '<br>';   
// }


if (array_key_exists('prenom', $user)) {
    echo $user['prenom'];
}

?>

