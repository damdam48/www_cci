<!-- pour ce connecter a la basse de donner -->
<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=savourer_la_sante_alpha", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die($erreur_sql = 'Erreur connect bd: ' . $e->getMessage());
}

// control si ya erreur a la connection de la base
if (isset($erreur_sql)) {
    echo $erreur_sql;
}
?>


<?php
    try {
        // SELECT table_1.colonne, table_2.colonne
        // from (depuis) table_1
        // JOIN (joindre) table_2
        // WHERE (la ou) table_1.colonne_commune = table.colonne_commune
        $sql = "
            SELECT recettes.name, comments.comment
            FROM recettes
            INNER JOIN comments
            ON recettes.recette_id = comments.recette_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(
            array(

            ));
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }
    // construct results
    while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($results);
        echo '<hr>';

    }


?>