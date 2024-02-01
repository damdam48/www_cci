<h1 class="text-center">Recettes</h1>
<br>


<?php
// create
if (isset($_POST['create'])) {
    // print_r($_POST);
    // echo '<hr>';

    try {
        $sql = "INSERT INTO recette SET name = ?, recette_cat = ?, dateCreate = ?, img = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(
            array(
                strip_tags($_POST['name']),
                strip_tags($_POST['recette_cat']),
                date('Y-m-d H:i:s'),
                str_replace(" ", "-", $_FILES['avatar']['name']),
                
            )
        );
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }
    $last_id = $bdd->lastInsertId();
    // echo 'nous avons inséré l\'ID n : ' . $last_id;
    // $newName = 'recette_' . $last_id;
    // echo '<br>';
    // echo 'l\'image s\'appelera ' . $newName;
}
// fin create


?>






<?php
// $lastId = $bdd->lastInsertId();
// echo '<p>You have insert the user id :' . $lastId . '</p>';

//si image envoyer
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
    $uploadImgOk = true;
    echo '<br>';
    print_r($_FILES);

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
        $newName = 'image_1';


        // if (@move_uploaded_file($_FILES['avatar']['tmp_name'] , $folder . $newName . '.' .$extension )) {
        if (@move_uploaded_file(str_replace(" ", "-", $_FILES['avatar']['tmp_name']), $folder . str_replace(" ", "-", $_FILES['avatar']['name']))) {

            // echo 'upload ok';

            // update table img
            // try {
            //     $sql = "INSERT INTO recette SET img = ? WHERE recette_id = ? ";
            //     $stmt = $bdd->prepare($sql);
            //     $stmt->execute(
            //         array(
            //             // $newName.'.'.$extension,
            //             // $_FILES['avatar']['name'],
            //             str_replace(" ", "-", $_FILES['avatar']['name']),
            //             // $_GET['v_id']
            //         )
            //     );
            // } catch (Exception $e) {
            //     print "Erreur ! " . $e->getMessage() . "<br/>";
            // }
        } else {
            echo 'upload NO';
        }
    } else {
        echo 'L\'image n\'a pas pu être envoyé';
    }
}









// array_cats
try {
    $sql = "SELECT * FROM recette_cat";
    $stmt_cats = $bdd->prepare($sql);
    $stmt_cats->execute();
} catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
}

while ($recette = $stmt_cats->fetch(PDO::FETCH_ASSOC)) {
    // print_r($recette); echo '<hr>';

    // $recetteArray [id de la catégori ] = nom de la catégorie

    $recetteArray[$recette['recette_cat_id']] = $recette['recette_cat_name'];
}


try {
    $sql = "SELECT * FROM recette";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(
        array(

        )
    );
} catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
}
?>
<div class="row">
    <?php
    // construct results
    while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // print_r($results);
        // echo '<br>'; ?>

        <div class="col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2 border rounded mx-auto ">
            <div class="card">
                <div class="card-header">
                    <?php echo $results['name']; ?>
                </div>
                <div class="card-body my-auto">
                    <div>
                        <!-- <?php echo $recetteArray[$results['recette_cat']]; ?> -->
                        <?php
                        // img si existe
                        // echo $results['img'];
                        $folder = 'img/recette/';
                        // print_r(getimagesize($folder . $results['img']));
                    
                        if (@is_array(getimagesize($folder . $results['img']))) {
                            // echo 'image OK';
                            echo '<img src="' . $folder . $results['img'] . '" class="w-75" alt=""> ';
                            echo getimagesize($folder . $results['img'])[0];
                            echo 'X';
                            echo getimagesize($folder . $results['img'])[0] . ' px';
                        } else {
                            // echo 'no image';
                            echo '<img src="img/img_icon.png" class="w-75">';
                        }
                        ?>
                    </div>

                </div>
                <div class="card-footer">
                    <a href="index.php?p=recette.php&recette_id=<?php echo $results['recette_id']; ?>">Aller a la
                    recette</a>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
<hr>

<!-- imput cration d'recette -->
<div class="row">
    <div class="cal-12 cal-sm-6 cal-md-4 cal-xxl-2 my-1 mb-5 mx-auto ">
        <div class="card border-5">
            <form method="POST" enctype="multipart/form-data">
                <h1>Creation de nouvelle recette</h1>
                <input class="recette" type="text" name="name" value="" placeholder="name"></input>
                <br>
                <br>
                <div>
                    <input type="file" name="avatar">
                </div>
                <br>
                <select name="recette_cat" id="">
                    <?php foreach ($recetteArray as $key => $value) { ?>
                        <option value="<?php echo $key; ?>">
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
                <br><br>
                <div class="card-footer">
                <input class="recette" type="submit" value="create" name="create">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end imput cration d'recette -->
</div>