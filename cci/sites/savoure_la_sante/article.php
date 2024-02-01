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
                $sql = "UPDATE article SET name = ?, article_cat = ? WHERE article_id = ? ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        strip_tags($_POST['name']),
                        strip_tags($_POST['article_cat']),
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
        Image
</div>
    <div id="imgDropTxt" class="text-center contener border">Déposer votre image ici</div>

        <input type="file" style="height: 101px;opacity:0.5;" name="avatar" id="imgDrop" class="form-control">

    </div>

    <label for=""></label>
    <input type="submit" id="updateBtn" value="update" name="update" class="btn btn-primary">
    <br>




    <?php

        // article_cat 
            try { 
                $sql="SELECT * FROM article_cat";
                $stmt_cats = $bdd->prepare($sql);
                $stmt_cats->execute();
                } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

            ?>
            <select name="article_cat" class="form-control w-auto mx-auto text-center">
                <?php while ($categories=$stmt_cats->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($categories);
                    echo '<option value="'.$categories['article_cat_id'].'"'; 
                    echo $categories['article_cat_id']==$results['article_cat']?' selected':'';
                    echo '>' . $categories['article_cat_name'].'</option>';
                } ?>
            </select>        
</form>





<script>
    $(document).ready(function () {
        $('#imgDrop').change(function () {
            console.log('imgDrop changed')
            console.log($(this))

            uploadOk = true

            file = this.files[0]
                console.log(file)

            size = file.size
                console.log('Taille: ' + size)

            sizeMo = size / 1000000
                console.log('Taille Mo : ' + sizeMo)
            
            sizeMomax = 1.2

            if (sizeMo > sizeMomax) {
                console.log('tros lourd')
                sizeMsg = 'Vote image est trop lourde'
                sizeMsgColor = 'text-warning'
                uploadOk = false
            }
            else {
                console.log('weigth ok')
                sizeMsg = 'le poids de l\'image est'
                sizeMsgColor = 'text-success'
            }
            

            type = file.type
                console.log('Type : ' + type)


            name = file.name
                console.log('name : ' + name)

            typeArray = type.split('/')
                console.log(typeArray)
                console.log(typeArray[0])
            
            if (typeArray[0] == 'image') {
                    console.log('image') 
                    typeMsg = 'c\'est le bon format'
                    typeMsgColor = 'text-success'
            }
            else {
                console.log('weigth ok')
                typeMsg = 'Le format est pas bon'
                typeMsgColor = 'text-warning'
                uploadOk = false
            }

            

            
            msg = 'Vous allez télécharger le fichier : <br>' + name + '</b>'
            msg =  msg + '<div class="'+ sizeMsgColor + '" >' + sizeMsg + '(' + sizeMo.toFixed(2) + ' Mo  ): 1.5 Mo max autoriser </div>'
            msg =  msg + '<div class="'+ typeMsgColor + '" >' + typeMsg + '(' + typeArray[0] + ' )</div>'
            

            $('#imgDropTxt').html(msg)

            console.log('uploadOk : ' + uploadOk)

            if (uploadOk) {
                $('#updateBtn').fadeIn()
            }
            else {
                $('#updateBtn').fadeOut(1000)
            }

            
        })

        // numbers_decimales.js
            number = 1.111
                decimales = number.toFixed(2)
                console.log(decimales)

        
    })
</script>




