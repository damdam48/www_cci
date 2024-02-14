<h1 id="sideBar-recettes">Page de mise a jour de la recette</h1>
    
    <!-- recette_id
    <?php echo $_GET['recette_id']; ?> -->
    <hr>
    
    <?php
    // Vérifie si le formulaire de mise à jour a été soumis
    if (isset($_POST['update'])) {
        // UPDATE la recette dans la base de données
        try {
            $sql = "UPDATE recette SET name = ?, descriptions = ? WHERE recette_id = ? ";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
                array(
                    strip_tags($_POST['name']),
                    strip_tags($_POST['descriptions']),
                    $_GET['recette_id']
                )
            );
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }
    }
    
    // Vérifie si une image a été envoyée
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $uploadImgOk = true;
        // Récupère les informations sur l'image
        $sizeKo = $_FILES['avatar']['size'];
        $sizeMo = $sizeKo / 1000000;
        $sizeMaxMo = 3;
    
        // Vérifie la taille de l'image
        if ($sizeMo > $sizeMaxMo) {
            echo 'Le fichier est trop volumineux.<br>';
            $uploadImgOk = false;
        }
    
        // Vérifie l'extension de l'image
        $extension = $_FILES['avatar']['type'];
        $array = explode('/', $extension);
        $extension = $array[1];
        $extensionAllowed = ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'webp', 'pdf'];
        if (!in_array($extension, $extensionAllowed)) {
            echo 'extension NO<br>';
            $uploadImgOk = false;
        }
    
        if ($uploadImgOk == true) {
            $folder = 'img/recette/';
            $newName = 'recette_' . $_GET['recette_id'] . '.' . $extension;
    
            if (@move_uploaded_file($_FILES['avatar']['tmp_name'], $folder . $newName)) {
                // Met à jour le champ "img" dans la table "recette"
                try {
                    $sql = "UPDATE recette SET img = ? WHERE recette_id = ? ";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(
                        array(
                            $newName,
                            $_GET['recette_id']
                        )
                    );
                } catch (Exception $e) {
                    print "Erreur ! " . $e->getMessage() . "<br/>";
                }
            } else {
                echo 'upload NO';
            }
        } else {
            echo 'L\'image n\'a pas pu être envoyée';
        }
    }
    
    
    // REQUEST select
    try {
        $sql = "SELECT * FROM recette WHERE recette_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(
            array(
                $_GET['recette_id']
            )
        );
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }
    
    // Récupère les résultats de la requête SELECT
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérifie si aucun résultat n'a été trouvé
    if (empty($results)) {
        echo 'Nous n\'avons pas trouvé cet recette. <br><a href="index.php?p=recettes.php"> Revenir a la page des recettes</a>';
    }
    
    
    // Vérifie si le bouton de suppression a été cliqué
    if (isset($_POST['deleteBtn'])) {

            echo "Le bouton de suppression a été cliqué."; // Message de débogage

        // Supprime l'entrée de la recette dans la base de données
        try {
            $sql = "DELETE FROM recette WHERE recette_id = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(array($_GET['recette_id']));
    
            // // Redirection après suppression
            // header("Location: index.php?p=recettes.php");
            // exit(); // Assure que le script s'arrête après la redirection
        } catch (Exception $e) {
            print "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage() . "<br/>";
        }
    }
    ?>

    
    <form method="POST" enctype="multipart/form-data" class="contener border border border-primary rounded mx-5">
        <!-- Champ pour name -->
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label w-auto mx-auto">Nom</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="<?php echo $results['name']; ?>" class="form-control" id="staticEmail"
                    placeholder="Nom"></input>
            </div>
        </div>
    
        <!-- Champ pour l'image -->
        <div class="form-group row">
            <label for="avatar" class="col-sm-2 col-form-label w-auto mx-auto">Image</label>
            <div class="col-sm-10">
                <input type="file" name="avatar" class="form-control-file">
            </div>
        </div>
    
        <!-- Afficher l'image actuelle -->
        <div class="form-group row">
            <label for="current_image" class="col-sm-2 col-form-label w-auto mx-auto">Image actuelle</label>
            <div class="col-sm-10">
                <img src="<?php echo 'img/recette/' . $results['img']; ?>" class="img-thumbnail"
                    alt="Image actuelle de la recette">
            </div>
        </div>
    
        <!-- Champ pour la description -->
        <div class="form-group row">
            <label for="descriptions" class="col-sm-2 col-form-label w-auto mx-auto">Descriptions</label>
            <div class="col-sm-10">
                <textarea name="descriptions" class="form-control"
                    rows="5"><?php echo $results['descriptions']; ?></textarea>
            </div>
        </div>
    
        <!-- Menu déroulant pour la recette_cat -->
        <div class="form-group row">
            <label for="recette_cat" class="col-sm-2 col-form-label w-auto mx-auto">Catégorie de recette</label>
            <div class="col-sm-10">
                <select name="recette_cat" class="form-control">
                    <?php
                    // Récupération des catégories de recettes depuis la base de données
                    try {
                        $sql = "SELECT * FROM recette_cat";
                        $stmt = $bdd->prepare($sql);
                        $stmt->execute();
                        // Parcourir les résultats et afficher les options dans le menu déroulant
                        while ($recette_cat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option value="<?php echo $recette_cat['recette_cat_id']; ?>" <?php echo ($results['recette_cat'] == $recette_cat['recette_cat_id']) ? 'selected' : ''; ?>>
                                <?php echo $recette_cat['recette_cat_name']; ?>
                            </option>
                            <?php
                        }
                    } catch (Exception $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
        </div>
    
    
    
        <!-- Bouton de mise à jour et suppression -->
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <input type="submit" value="Mettre à jour" name="update" class="btn btn-primary mt-3">
            </div>
        </div>
    
    </form>
    
    <!-- modal  -->
    
    <!-- Button trigger modal -->
    <button type="button" class="form-control  w-auto mx-auto article btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Supprimer
    </button>
    
    <!-- Premier Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sûr de vouloir supprimer cette recette ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Oui</a>
                </div>
            </div>
        </div>
    </div>

<!-- Deuxième Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Recette supprimée</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    La recette a été supprimée avec succès.
                    <br>
                    Souhaitez-vous être redirigé vers la page Recettes ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                    <a href="index.php?p=recettes.php" class="btn btn-primary">Oui</a>
                </div>
            </div>
        </div>
    </div>


