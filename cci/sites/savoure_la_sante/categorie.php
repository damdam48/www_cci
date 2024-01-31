<h1>categorie</h1>

categorieid
<?php echo $_GET['categorie_id']; ?>
<hr>

<?php

if (isset($_POST['update'])) {
    // print_r($_POST);
    // echo '<br>';
    // print_r($_FILES);
    // echo '<br>';
    // echo $_FILES['avatar']['name'];
    // UPDATE
    try {
        $sql = "UPDATE categorie SET name = ?, categorie_cat = ?, dateUpdate = ? WHERE categorie_id = ? ";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(
            array(
                strip_tags($_POST['name']),
                strip_tags($_POST['categorie_cat']),
                date('Y-m-d H:i:s'),
                $_GET['categorie_id']
            )
        );
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }

    //si image envoyer
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
            $folder = 'img/categorie/';
            $newName = 'image_1';


            // if (@move_uploaded_file($_FILES['avatar']['tmp_name'] , $folder . $newName . '.' .$extension )) {
            if (@move_uploaded_file(str_replace(" ", "-", $_FILES['avatar']['tmp_name']), $folder . str_replace(" ", "-", $_FILES['avatar']['name']))) {

                // echo 'upload ok';

                // update table img
                try {
                    $sql = "UPDATE categorie SET img = ? WHERE categorie_id = ? ";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(
                        array(
                            // $newName.'.'.$extension,
                            // $_FILES['avatar']['name'],
                            str_replace(" ", "-", $_FILES['avatar']['name']),
                            $_GET['categorie_id']
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
    }

    // fin UPDATE
}


// REQUEST select
try {
    $sql = "SELECT * FROM categorie WHERE categorie_id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(
        array(
            $_GET['categorie_id']
        ));
} catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
}

// construct results
$results = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($results);
// echo '<br>';

if (empty($results)) {

    // echo 'nous n\'avons pas trouvé cet utilisateur. <br><a href="index.php?p=categories.php"> Revenir a la page utilisateurs</a>';
}



// end REQUEST select

?>



<form method="POST" enctype="multipart/form-data" class="contener border border border-primary rounded mx-5">

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label w-auto mx-auto">name</label>
        <div class="col-sm-10">
            <input type="text" name="name" value="<?php echo $results['name']; ?>" class="form-control" id="staticEmail"
                placeholder="name"></input>
        </div>
    </div>

    <div class="form-group row col-sm-2 col-form-label mx-auto ">
        <input type="file" name="avatar">

    </div>


    <?php

    // categorie_cat 
    try {
        $sql = "SELECT * FROM categorie_cat";
        $stmt_cats = $bdd->prepare($sql);
        $stmt_cats->execute();
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }

    ?>
    <select name="categorie_cat" class="form-control w-auto mx-auto text-center">
        <?php while ($categories = $stmt_cats->fetch(PDO::FETCH_ASSOC)) {
            // print_r($categories);
            echo '<option value="' . $categories['categorie_cat_id'] . '"';
            echo $categories['categorie_cat_id'] == $results['categorie_cat'] ? ' selected' : '';
            echo '>' . $categories['categorie_cat_name'] . '</option>';
        } ?>
    </select>

    <label for=""></label>
    <input type="submit" value="update" name="update" class="btn btn-primary">
    <br>

</form>