<h1 id="sideBar-articles" >Page des articles</h1>

<div class="card">
    <h6 class="card-header" >Liste des articles</H6>
    <div class="row">


        <?php
        // create
        if (isset($_POST['create'])) {
            // print_r($_POST);
            // echo '<hr>';

            try {
                $sql = "INSERT INTO article SET name = ?, article_cat = ? ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        strip_tags($_POST['name']),
                        strip_tags($_POST['article_cat']),
                    )
                );
            } catch (Exception $e) {
                print "Erreur ! " . $e->getMessage() . "<br/>";
            }

            $lastId = $bdd->lastInsertId();
            echo '<p>You have insert the user id :' . $lastId . '</p>';

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
                    $folder = 'img/article/';
                    $newName = 'article_'.$lastId;


                    // if (@move_uploaded_file($_FILES['avatar']['tmp_name'] , $folder . $newName . '.' .$extension )) {
                    if (@move_uploaded_file($_FILES['avatar']['tmp_name'], $folder . $newName. '.' .$extension)) {

                        // echo 'upload ok';
            
                        // update table img
                        try {
                            $sql = "UPDATE article SET img = ? WHERE article_id = ? ";
                            $stmt = $bdd->prepare($sql);
                            $stmt->execute(
                                array(
                                    $newName,
                                    $_GET['article_id']
                                )
                            );
                        } catch (Exception $e) {
                            print "Erreur ! " . $e->getMessage() . "<br/>";
                        }
                    } else {
                        echo 'upload NO';
                        echo '<hr>';
                    }
                } else {
                    echo 'L\'image n\'a pas pu être envoyé';
                }
            }
            //end de image envoyer

        }
        // fin create
        ?>

        <?php

        // array_cats
        try {$sql = "SELECT * FROM article_cat";
            $stmt_cats = $bdd->prepare($sql);
            $stmt_cats->execute();
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }

        while ($categories = $stmt_cats->fetch(PDO::FETCH_ASSOC)) {
            // print_r($categories); echo '<hr>';
        
            // $categoriesArray [id de la catégori ] = nom de la catégorie
        
            $categoriesArray[$categories['article_cat_id']] = $categories['article_cat_name'];
        }

        // echo '<hr>';
        // echo $categoriesArray[1];
        
        try {$sql = "SELECT * FROM article";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
                array(

                )
            );
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }
        
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
                            <?php echo $categoriesArray[$results['article_cat']]; ?>
                            <?php
                            // img si existe
                            // echo $results['img'];
                            $folder = 'img/article/';
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
                        <a href="index.php?p=article.php&article_id=<?php echo $results['article_id']; ?>">Aller a la page</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<hr>

<!-- test du modal  -->

    <!-- Button trigger modal -->
    <button type="button" class="form-control  w-auto mx-auto article btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create article
    </button>

<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            
            <form method="POST" enctype="multipart/form-data" class="modal-content bg-dark text-light">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Création d'un nouvelle article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="card-title text-dark " type="text" name="name" placeholder="name" >
                <p>
                    <label for="">Choisi une image</label>
                    <br>
                    <input class="card-text" type="file" name="avatar">
                </p>
                <select name="article_cat" id="">
                        <?php foreach ($categoriesArray as $key => $value) { ?>
                            <option value="<?php echo $key; ?>">
                                <?php echo $value; ?>
                            </option>
                        <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" value="create" name="create" class="btn btn-secondary article btn btn-primary">Oui</button>

                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
            </div>

        </form>

        </div>
    </div>
<!-- end du test modal  -->