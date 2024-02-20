<?php date_default_timezone_set('Europe/paris'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo date("d/m/Y");
    echo '<hr>';
    echo date("d/m/Y H:i");
    echo '<hr>';
    echo date("F j, Y, g:i a");
    echo '<hr>';
    echo date('w'). '<hr>';

    $arrayDays = array(1 => 'lundi', 2 => 'mardi', 3 => 'mercredi', 4 => 'jeudi', 5 => 'vendredi', 6 => 'samedi', 7 => 'dimanche', );
        print_r($arrayDays); echo '<br>';
        echo 'Nous somme un ' . $arrayDays[3] . '<hr>';
        echo 'Nous somme le ' . $arrayDays[3] .' '. date("d/m/Y"). '<hr>';

echo date('n'). '<hr>';
$array_months = array(1 => 'janvier', 2 => 'février', 3 => 'avril' , 4 => 'mai' , 5 => 'juin', 6 => 'juillet' , 7 => 'août' , 8 => 'octobre' , 9 => 'novembre', 10 => 'décembre');

echo 'Posté le ' . $array_months[date('n')] .' '. date('d') . '<hr>';

echo 'Nous somme le ' . $array_months[1] .' '. date("d/m/Y"). '<hr>';

echo '<p>Function</p>';

function ma_fonction($valeur_1, $valeur_2 ){
return $valeur_1 * $valeur_2;

}

echo ma_fonction(100, 10);

echo '<hr>';

function day_franch($arrayDays, $array_months ){
    return 'Nous sommes '$array_months[$day];
    
    }
    
    echo ma_fonction( date());








function monthFrench($val_1,){
    $array_months = array(1 => 'janvier', 2 => 'février', 3 => 'avril' , 4 => 'mai' , 5 => 'juin', 6 => 'juillet' , 7 => 'août' , 8 => 'octobre' , 9 => 'novembre', 10 => 'décembre');
    $mois = $array_months[$month];
    return $mois;
    
    }
    
    echo monthFrench(date('n'));

    echo '<hr>';

    echo dayFrench();
























    ?>


<?php
// Définition de la locale en français
setlocale(LC_TIME, 'fr_FR.utf8','fra');

// Initialisation du tableau contenant les noms des mois
$array_months = array();

// Remplissage du tableau avec les noms des mois en français
for ($mois = 1; $mois <= 12; $mois++) {
    $nom_mois = strftime("%B", mktime(0, 0, 0, $mois, 1));
    $array_months[] = $nom_mois;
}

// Affichage du tableau des noms des mois
print_r($array_months);
?>


</body>
</html>