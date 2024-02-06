<?php

    // Récupération de l'identifiant de la recette depuis l'URL
    $recette_id = $_GET['recette_id'];

    // Requête pour récupérer les détails de la recette
    try {
        $sql = "SELECT * FROM recette WHERE recette_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$recette_id]);
        $recette = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Vérification si la recette existe
    if (!$recette) {
        echo "La recette n'existe pas.";
    } else {
        // Affichage des détails de la recette
        echo "<h1>{$recette['name']}</h1>";

        // Vérification de l'existence de l'image
        $folder = 'img/recette/';
        if (file_exists($folder . $recette['img'])) {
            echo '<img src="' . $folder . $recette['img'] . '" class="w-5" alt=""> ';
            // echo getimagesize($folder . $recette['img'])[0];
            // echo 'X';
            // echo getimagesize($folder . $recette['img'])[1] . ' px';
        } else {
            echo '<img src="img/img_icon.png" class="w-75">';
        }

        // Récupération du type de recette
        try {
            $sql = "SELECT * FROM recette_cat WHERE recette_cat_id = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute([$recette['recette_cat']]);
            $recette_cat = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<p>Type de recette : {$recette_cat['recette_cat_name']}</p>";
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }

        // echo "<p>{$recette['descriptions']}</p>";

        // Récupération de l'identifiant de la recette depuis l'URL
        $recette_id = $_GET['recette_id'];

        // Chemin vers le fichier description.md de cette recette
        $chemin_description = "descriptions/descriptions.html";

        // Lire le contenu du fichier description.md
        $description = file_get_contents($chemin_description);

        // Afficher le contenu
        echo "<div class='description'>$description</div>";


    }

?>
