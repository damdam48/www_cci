<?php 
    $user_id=strip_tags($_GET['user_id']);

        // test $_GET['user_id']
        if (is_numeric($user_id)) {
            echo 'ok';
        }

        else {
            echo 'no';
        } 
?>


<!-- Affichage du titre de la page avec l'ID de l'utilisateur extrait de la chaîne de requête -->
<h1> Vous êtes sur la page de <?php echo $_GET['user_id']; ?> </h1>



    <?php
        // mise a jour utilisateur (UPDATE)
            if (isset($_POST['update'])) {               
                // echo 'POST<br>';
                // print_r($_POST);
                    try { 
                        $sql="UPDATE users SET name = ?, first_name = ?, mail = ?, categories_id = ? WHERE users_id = ? ";
                        $stmt = $bdd->prepare($sql);
                        $stmt->execute(
                            array(
                                strip_tags($_POST['name']),
                                strip_tags($_POST['first_name']),
                                strip_tags($_POST['mail']),
                                strip_tags($_POST['categories_id']),
                                $user_id
                            )
                        );   
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
            }
    ?>



    <?php
    // requete array table categories_id
            try { 
                $sql="SELECT * FROM categories";
                $stmt = $bdd->prepare($sql);
                $stmt->execute( array() );
                } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

                while ($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($results);
                    // echo $results['name']. ' ' .$results['categories_id'] ;
                    // echo '<hr>';
                    // remplissage de l'array categories
                    $categories[$results['categories_id']] = $results['name'];
                    // print_r($results);
                }
    ?>



    <?php
        try { 
            $sql="SELECT * FROM users WHERE users_id = ? ";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
                array(
                    $user_id
                )
            );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
            
            // construction des resultats
                $users=$stmt->fetch(PDO::FETCH_ASSOC);
                // print_r($users);

            
    ?>


    <!-- Fil d'Ariane (breadcrumb) indiquant la position actuelle -->
    <ol class="breadcrumb mb-4">
        <!-- <li class="breadcrumb-item active">Accueil</li> -->
        <li class="breadcrumb-item active"><a href="index.php?p=home.php">Accueil</a></li>
        <li class="breadcrumb-item"><a href="index.php?p=users.php">Users</a></li>
        <li class="breadcrumb-item"><?php echo $users['name'].' '.$users['first_name'] ?></li>
    </ol>




    <hr>
    <!-- <button class="" > Ouvir le formulaire </button> -->
    <form method="POST" class="row">
        <div class="col-12 col-md-6 col-lg-4 mx-auto" >  
            <input class="form-control text-center my-1" type="text" name="name" value="<?php echo $users['name']; ?>" autofocus >
            <input class="form-control text-center my-1" type="text" name="first_name" value="<?php echo $users['first_name']; ?>" >
            <input class="form-control text-center my-1" type="text" name="mail" value="<?php echo $users['mail']; ?>" >


            <!-- <label for="categories_id">Categories : </label> -->
                <select class="form-control text-center my-1" name="categories_id" id="categories_id" >
                    <?php foreach ($categories as $key => $value) { ?>
                    <!-- selected c'est pour la valeur part default -->
                        <option value="<?php echo $key; ?>" <?php echo ($users['categories_id'] == $key) ? 'selected' : ''; ?> > <?php echo $value; ?> </option>
                    <?php } ?>
                </select>


            <input class="form-control text-center my-3 border-danger text-danger" type="submit" name="update" value="Mettre a jour" >
        </div>
    </form>

