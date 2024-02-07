<h1 id="sideBar-recettes">Page de mise a jour de la recette</h1>

recette_id
<?php echo $_GET['recette_id']; ?>
<hr>

<?php
if (isset($_POST['update'])) {
    // print_r($_POST);
    // print_r($_FILES);
    // echo $_FILES['avatar']['name'];
    // UPDATE
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

//si image envoyée
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
    $uploadImgOk = true;
    // print_r($_FILES);

    // retrieve image info
    //size Ko sizeMo, sizeMax
    $sizeKo = $_FILES['avatar']['size'];
    // echo ' sizeKo ' . $sizeKo . '<br>';

    $sizeMo = $sizeKo / 1000000;
    // echo ' sizeMo ' . $sizeMo . '<br>';

    $sizeMaxMo = 3;
    // echo 'Votre image pèse ' . $sizeMo . ' Mo<br>';

    if ($sizeMo > $sizeMaxMo) {
        echo 'Le fichier est trop volumineux.<br>';
        $uploadImgOk = false;
    } else {
        // echo 'OK';
    }

    $extension = $_FILES['avatar']['type'];
    // Séparer les termes
    $array = explode('/', $extension);
    // print_r($array);

    $extension = $array[1];
    // echo '<br>extension ' . $extension . '<br>';

    $extensionAllowed = ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'webp', 'pdf'];
    // print_r($extensionAllowed);

    // test extension dans les extensions autorisées
    if (in_array($extension, $extensionAllowed)) {
        // echo 'extension OK<br>';
    } else {
        echo 'extension NO<br>';
        $uploadImgOk = false;
    }

    if ($uploadImgOk == true) {
        $folder = 'img/recette/';
        $newName = 'recette_' . $_GET['recette_id']. '.' .$extension;


        if (@move_uploaded_file($_FILES['avatar']['tmp_name'] , $folder . $newName)) {
            // echo 'upload ok';

            // update table img
            try {
                $sql = "UPDATE recette SET img = ? WHERE recette_id = ? ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        // $newName.'.'.$extension,
                        // $_FILES['avatar']['name'],
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
        echo 'L\'image n\'a pas pu être envoyé';
    }
    // fin UPDATE
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

// construct results
$results = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($results);
// echo '<br>';

if (empty($results)) {

    echo 'nous n\'avons pas trouvé cet utilisateur. <br><a href="index.php?p=recettes.php"> Revenir a la page des recettes</a>';
}

// end REQUEST select


// Vérifiez si le bouton de suppression a été cliqué
if (isset($_POST['deleteBtn'])) {
    // Supprimez l'utilisateur de la base de données
    try {
        $sql = "DELETE FROM recette WHERE recette_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array($_GET['recette_id']));
    } catch (Exception $e) {
        print "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage() . "<br/>";
    }

    // Supprimez l'image de l'utilisateur du serveur si elle existe
    $folder = 'img/recette/';
    $userImage = $folder . $results['img']; // Chemin complet de l'image de l'utilisateur
    if (file_exists($userImage)) {
        unlink($userImage); // Supprimez l'image du serveur
    }

    // Redirigez l'utilisateur vers une page appropriée après la suppression
    header("Location: index.php?p=recettes.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}

?>

<form method="POST" enctype="multipart/form-data" class="contener border border border-primary rounded mx-5">
    <!-- Champ pour name -->
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label w-auto mx-auto">name</label>
        <div class="col-sm-10">
            <input type="text" name="name" value="<?php echo $results['name']; ?>" class="form-control" id="staticEmail"
                placeholder="name"></input>
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
            <textarea id="descriptions" name="descriptions" class="form-control"
                rows="5"><?php echo $results['descriptions']; ?></textarea>
        </div>
    </div>

    <!-- Menu déroulant pour la recette_cat -->
    <div class="form-group row">
        <label for="recette_cat" class="col-sm-2 col-form-label w-auto mx-auto">Catégorie de recette</label>
        <div class="col-sm-10">
            <select id="recette_cat" name="recette_cat" class="form-control">
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
            <input type="submit" value="Mettre à jour" name="update" class="btn btn-primary">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <button type="button" class="btn btn-secandary mt-3" form-bs-toggle="collapse"
                data-bs-target="#deleteDiv">Supprimer</button>
            <div id="deleteDiv" class="collapse">
                <button type="submit" name="deleteBtn" class="btn btn-warning">Confirmer la suppression</button>
            </div>
        </div>
    </div>
</form>