<h1>user</h1>

page user_id <?php echo $_GET['user_id'];?><hr>

<?php

        if (isset($_POST['update'])) {
            // print_r($_POST);
     // UPDATE
            try {
                $sql = "UPDATE users SET name = ?, first_name = ?, mail = ?, pass = ?, img = ? WHERE user_id = ? ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        strip_tags($_POST['name']),
                        strip_tags($_POST['first_name']),
                        strip_tags($_POST['mail']),
                        strip_tags($_POST['pass']),
                        strip_tags($_POST['img']),
                        $_GET['user_id']
                    )
                );
            } catch (Exception $e) {
                print "Erreur ! " . $e->getMessage() . "<br/>";
            }

            //si image envoyer
            if ($_FILES['avatar']['error'] == 0 ) {
                $moveFiles = true;

                    // retrieve image info
                        //size Ko sizeMo, sizeMax
                        $sizeKo = $_FILES['avatar']['size'];
                        echo ' sizeKo ' . $sizeKo . '<br>';

                        $sizeMo = $sizeKo / 1000000;
                        echo ' sizeMo ' . $sizeMo . '<br>';

                        $sizeMaxMo = 3;

                        echo 'Votre image pèse ' . $sizeMo . ' Mo<br>';

                        if ($sizeMo > $sizeMaxMo) {
                        echo 'Le fichier est trop volumineux.<br>';
                        $uploadImgOk = false;
                        } else {
                            echo 'OK';
                        }


                        $extension = $_FILES['avatar']['type'];
                        // Séparer les termes
                        $array = explode('/', $extension);
                        print_r($array);
                        $extension = $array[1];
                        echo '<br>extension ' . $extension . '<br>';
                    
                        $extensionAllowed = ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'webp','pdf'];
                        print_r($extensionAllowed);
                    
                        // test extension dans les extensions autorisées
                        if (in_array($extension, $extensionAllowed)) {
                            echo 'extension OK<br>';
                        }
                        else {
                            echo 'extension NO<br>';
                            $uploadImgOk = false;
                        }
                    
                        if ($uploadImgOk == true) {
                            $folder = 'img/users/';
                            $newName = 'image_1';
                    
                            if (@move_uploaded_file($_FILES['avatar']['tmp_name'] , $folder . $newName . '.' .$extension )) {
                                echo 'upload ok';
                            }
                            else {
                                echo 'upload NO';
                            }
                        }
                        else {
                            echo 'L\'image n\'a pas pu être envoyé';
                        }



                        // extension

                    // test size
                        // si no good
                            // $moveFile = false;

                    // test extension
                        //si no good
                            // $moveFile = false;

                    // si $moveFile == true
                        // move_uploaded_file(filename, destination)


            }
            // 

     // fin UPDATE
        }


    // REQUEST select
        try { 
            $sql="SELECT * FROM users WHERE user_id = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(
                $_GET['user_id']
            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
        // construct results
        $results=$stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($results);
            // echo '<br>';

        if (empty($results)) {

            echo 'nous n\'avons pas trouvé cet utilisateur. <br><a href="index.php?p=users.php"> Revenir a la page utilisateurs</a>';
        }
        // else {
        //     echo 'OK trouvé';
        // }
    // end REQUEST select
        
?>

<form method="POST" class="contener border border border-primary rounded mx-5">

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label w-auto mx-auto">name</label>
        <div class="col-sm-10">
            <input  type="text" name="name" value="<?php echo $results['name']; ?>" readonly class="form-control" id="staticEmail" placeholder="name"></input>
        </div>
    </div>

    <div class="form-group row">
        <label for="first_name" class="col-sm-2 col-form-label w-auto mx-auto">first_name</label>
        <div class="col-sm-10">
            <input type="text" name="first_name" value="<?php echo $results['first_name'] ?>" class="form-control" placeholder="first_name"></input>
    </div>
    </div>

    <div class="form-group row">
        <label for="mail" class="col-sm-2 col-form-label w-auto mx-auto">mail</label>
        <div class="col-sm-10">
            <input type="mail" name="mail" value="<?php echo $results['mail']; ?>" class="form-control" placeholder="mail"></input>
        </div>
    </div>

    <div class="form-group row">
        <label for="pass" class="col-sm-2 col-form-label w-auto mx-auto">password</label>
        <div class="col-sm-10">
            <input type="password" name="pass" value="<?php echo $results['pass']; ?>" class="form-control" placeholder="password"></input>
        </div>
    </div>

    <label for=""></label>
    <input type="submit" value="update" name="update" class="btn btn-primary">
    <br>
    <input type="file" name="avatar">
    <input type="submit" name="upload">


</form>


<!-- <h2>Changer votre avatar</h2>

<?php
if (isset($_POST['upload']) && $_FILES['avatar']['error'] == 0) {

    $uploadImgOk = true;

    // modifier taille max des fichiers uploadés
        // Icone wamp > Clic gauche
            // Php.ini
                // Chercher "upload_max_filesize"
                    // Modifier taille
                        // Redemarrer wamp
    print_r($_POST);
    echo '<hr>';
    print_r($_FILES);
    echo '<hr>';
    // Montrer taille image
    echo 'poids de l\'image : ' . $_FILES['avatar']['size'] . '<br>';
    // Montrer type image
    echo 'type de l\'image : ' . $_FILES['avatar']['type'] . '<br>';
    echo '<br>';


    // Test image size
    $sizeKo = $_FILES['avatar']['size'];
    echo ' sizeKo ' . $sizeKo . '<br>';

    $sizeMo = $sizeKo / 1000000;
    echo ' sizeMo ' . $sizeMo . '<br>';

    $sizeMaxMo = 3;

    echo 'Votre image pèse ' . $sizeMo . ' Mo<br>';

    if ($sizeMo > $sizeMaxMo) {
        echo 'Le fichier est trop volumineux.<br>';
        $uploadImgOk = false;
    } else {
        echo 'OK';
    }
    // Separer le type de l'image pour récuperer seulement le jpeg sur image/jpeg par exemple
    // Extention
    $extension = $_FILES['avatar']['type'];
    // Séparer les termes
    $array = explode('/', $extension);
    print_r($array);
    $extension = $array[1];
    echo '<br>extension ' . $extension . '<br>';

    $extensionAllowed = ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'webp','pdf'];
    print_r($extensionAllowed);

    // test extension dans les extensions autorisées
    if (in_array($extension, $extensionAllowed)) {
        echo 'extension OK<br>';
    }
    else {
        echo 'extension NO<br>';
        $uploadImgOk = false;
    }

    if ($uploadImgOk == true) {
        $folder = 'img/users/';
        $newName = 'image_1';

        if (@move_uploaded_file($_FILES['avatar']['tmp_name'] , $folder . $newName . '.' .$extension )) {
            echo 'upload ok';
        }
        else {
            echo 'upload NO';
        }
    }
    else {
        echo 'L\'image n\'a pas pu être envoyé';
    }
}

?> -->

<!-- <form method="post" enctype="multipart/form-data">
    <input type="file" name="avatar">
    <input type="submit" name="upload">
</form> -->