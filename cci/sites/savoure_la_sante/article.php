<h1>article</h1>
        
article_id <?php echo $_GET['article_id'];?><hr>

<?php

        if (isset($_POST['update'])) {
            // print_r($_POST);
            // echo '<br>';
            // print_r($_FILES);
            // echo '<br>';
            // echo $_FILES['avatar']['name'];
     // UPDATE
            try {
                $sql = "UPDATE article SET name = ? WHERE article_id = ? ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        strip_tags($_POST['name']),
                        $_GET['article_id']
                    )
                );
            } catch (Exception $e) {
                print "Erreur ! " . $e->getMessage() . "<br/>";
            }

            //si image envoyer
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0 ) {
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
                    
                        $extensionAllowed = ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'webp','pdf'];
                            // print_r($extensionAllowed);
                    
                        // test extension dans les extensions autorisées
                        if (in_array($extension, $extensionAllowed)) {
                                // echo 'extension OK<br>';
                        }
                        else {
                            echo 'extension NO<br>';
                            $uploadImgOk = false;
                        }
                    
                        if ($uploadImgOk == true) {
                            $folder = 'img/article/';
                            $newName = 'image_1';
                    

                            // if (@move_uploaded_file($_FILES['avatar']['tmp_name'] , $folder . $newName . '.' .$extension )) {
                                if (@move_uploaded_file(str_replace(" ", "-", $_FILES['avatar']['tmp_name']) , $folder . str_replace(" ", "-", $_FILES['avatar']['name']))) {
                                
                                    // echo 'upload ok';

                                // update table img
                                try {
                                    $sql = "UPDATE article SET img = ? WHERE article_id = ? ";
                                    $stmt = $bdd->prepare($sql);
                                    $stmt->execute(
                                        array(
                                            // $newName.'.'.$extension,
                                            // $_FILES['avatar']['name'],
                                            str_replace(" ", "-", $_FILES['avatar']['name']),
                                            $_GET['article_id']
                                        )
                                    );
                                } catch (Exception $e) {
                                    print "Erreur ! " . $e->getMessage() . "<br/>";
                                }
                            }
                            else {
                                echo 'upload NO';
                            }
                        }
                        else {
                            echo 'L\'image n\'a pas pu être envoyé';
                        }
            }

     // fin UPDATE
        }


    // REQUEST select
        try { 
            $sql="SELECT * FROM article WHERE article_id = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(
                $_GET['article_id']
            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
        // construct results
        $results=$stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($results);
            // echo '<br>';

        if (empty($results)) {

            echo 'nous n\'avons pas trouvé cet utilisateur. <br><a href="index.php?p=articles.php"> Revenir a la page utilisateurs</a>';
        }

    // end REQUEST select
        
?>

<form method="POST" enctype="multipart/form-data" class="contener border border border-primary rounded mx-5">

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label w-auto mx-auto">name</label>
        <div class="col-sm-10">
            <input  type="text" name="name" value="<?php echo $results['name']; ?>" class="form-control" id="staticEmail" placeholder="name"></input>
        </div>
    </div>

    <!-- <div class="form-group row">
        <label for="first_name" class="col-sm-2 col-form-label w-auto mx-auto">first_name</label>
        <div class="col-sm-10">
            <input type="text" name="first_name" value="<?php echo $results['first_name'] ?>" class="form-control" placeholder="first_name"></input>
    </div>
    </div> -->

    <!-- <div class="form-group row">
        <label for="mail" class="col-sm-2 col-form-label w-auto mx-auto">mail</label>
        <div class="col-sm-10">
            <input type="mail" name="mail" value="<?php echo $results['mail']; ?>" class="form-control" placeholder="mail"></input>
        </div>
    </div> -->

    <!-- <div class="form-group row">
        <label for="pass" class="col-sm-2 col-form-label w-auto mx-auto">password</label>
        <div class="col-sm-10">
            <input type="password" name="pass" value="<?php echo $results['pass']; ?>" class="form-control" placeholder="password"></input>
        </div>
    </div> -->

    <div class="form-group row col-sm-2 col-form-label mx-auto ">
        <input type="file" name="avatar">
        <!-- <input type="submit" name="upload"> -->



    </div>

    <label for=""></label>
    <input type="submit" value="update" name="update" class="btn btn-primary">
    <br>

</form>


