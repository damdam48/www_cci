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

// Fonction pour calculer la différence entre deux dates et générer un compte à rebours
function countdown($startDate, $endDate){
    // Convertir les dates en timestamps
    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate);
    
    // Calcul de la différence entre les dates
    $difference = $endTimestamp - $startTimestamp;

    // Calcul des jours restants
    $days = floor($difference / (60 * 60 * 24));
    $difference = $difference - ($days * 60 * 60 * 24);
    
    // Calcul des heures restantes
    $hours = floor($difference / (60 * 60));
    $difference = $difference - ($hours * 60 * 60);
    
    // Calcul des minutes restantes
    $minutes = floor($difference / 60);
    $difference = $difference - ($minutes * 60);
    
    // Calcul des secondes restantes
    $seconds = $difference;
    
    // Retourne un tableau contenant les valeurs du compte à rebours
    return array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds);
}

// Date de début du compte à rebours
$startDate = "2024-03-01 00:00:00";

// Date de fin du compte à rebours (date cible)
$endDate = "2024-03-01 12:00:12";

// Appel de la fonction countdown avec les dates de début et de fin
$countdownValues = countdown($startDate, $endDate);

// Affichage des valeurs du compte à rebours
echo 'il reste '. $countdownValues['days'] .' Jours ' . $countdownValues['hours'] . ' Heures ' . $countdownValues['minutes'] . ' minutes ' . ' et ' . $countdownValues['seconds'] . ' Secondes ' . 'a votre abonnement .' . "<br/>";






// function day_franch($arrayDays, $array_months ){
//     return 'Nous sommes '$array_months[$day];
    
//     }
    
//     echo ma_fonction( date());








// function monthFrench($val_1,){
//     $array_months = array(1 => 'janvier', 2 => 'février', 3 => 'avril' , 4 => 'mai' , 5 => 'juin', 6 => 'juillet' , 7 => 'août' , 8 => 'octobre' , 9 => 'novembre', 10 => 'décembre');
//     $mois = $array_months[$month];
//     return $mois;
    
//     }
    
//     echo monthFrench(date('n'));

//     echo '<hr>';

//     echo dayFrench();


    ?>




</body>
</html>