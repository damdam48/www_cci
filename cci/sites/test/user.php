<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page user </title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <header></header>

        <!-- <?php
            echo $_GET['users_id'];
        ?> -->

        <?php

        // pour ce connecter a la basse de donner
            try
            {    
                $bdd = new PDO("mysql:host=localhost;dbname=dwmm_test", "root", "");
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e)    {
                die($erreur_sql='Erreur connect bd: '.$e->getMessage());
            }
        ?>




        <?php
        // supprimer utilisateur
        if (isset($_POST['delete'])) {
            try { 
                $sql="DELETE FROM users WHERE users_id = ?";
                $stmt = $bdd->prepare($sql);    
                $stmt->execute( array($_GET['users_id']) );

            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
            // redirection
        }



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
                                strip_tags($_GET['users_id'])
                            )
                        );   
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
            }



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

            }
                // affiche las boites array categories
                // echo $categories[3];
                // echo '<hr>';
            



        // requete users dans une table
            try { 
                $sql="SELECT * FROM users WHERE users_id = ?";
                $stmt = $bdd->prepare($sql);

                $stmt->execute( array($_GET['users_id']) );

            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

        // construction des resultats
            $users=$stmt->fetch(PDO::FETCH_ASSOC);

        // affiche les resultats
        // pour afficher tous les résultats décommenter print_r
            // print_r($results);



            if ($users == '') {
                echo '<h3>Utilisateur inconnu</h3>';
                ?> 
                <a href="index.php">Revenir a tous les utilisateurs</a>
                <?php
            }



        // formulaire
            else { ?>
                <form method="POST" >

                    <br>
                    <div class="rounded margin padding" style=" background-color: <?php $users['color'];?>" >


                    <h1 class="Modification_utilisateur">Modification utilisateur</h1>


                    <h3> categories : <?php echo $categories[$users['categories_id']]; ?> </h3>

                    <?php 
                    // print_r($categories).'<br>';

                    // boucler la valeur foreach
                    foreach ($categories as $key => $value) {
                    //         // echo $key.' '.$value.' '.'<br>'; 
                    ?>
                    <!-- bouton input -->
                             <!-- <label class="cursor good <?php echo $users['categories_id'] == $key ? 'good'  : 'no_good';?>" >
                                     <input type="radio" name="categories_id" <?php echo $users['categories_id'] == $key ? 'checked'  : '';?>  value="<?php echo $key; ?>" > <?php echo $value ?> 
                             </label> -->

                        
                    <?php } ?>
                        <br>

                        <!-- bouton select -->
                        <label for="categories_id">Categories : </label>
                        <select name="categories_id" id="categories_id" >
                            <?php foreach ($categories as $key => $value) { ?>
                            <!-- selected c'est pour la valeur part default -->
                            <!-- <option <?php echo $value == $key ? 'selected'  : '';?> > <?php echo $value; ?> </option> -->
                            <option value="<?php echo $key; ?>" <?php echo ($users['categories_id'] == $key) ? 'selected' : ''; ?> > <?php echo $value; ?> </option>

                        <?php } ?>

                        </select>


                        <br> <br>
                        <input type="text" name="first_name" value="<?php echo $users['first_name'];?>" autofocus>
                        <br>
                        <input type="text" name="name" value="<?php echo $users['name'];?>">
                        <br>
                        <input type="text" name="mail" value="<?php echo $users['mail'];?>">
                        <br>




                        <input type="submit" name="update" value="Modifier" >
                        <br>
                        <input type="submit" name="delete" value="Supprimer" >

                        <hr>
                        <h1><?php echo $users['first_name']. ' ' .$users['name'];?></h1>
                        <img src="img/<?php echo $users['img'];?>" class="rounded" style="max-width: 30%; height: auto;">

                        <h3>mail : <?php $users['mail']; ?></h3>

                        <p><a href="index.php">Revenir a tous les utilisateurs</a></p>
                    </div>
                </form>
             <?php } // else $results == '' ?>


                <hr color="red" >
                <br>

            <?php

                $myMonth = 3;

                $months [0]='select une valeur'; 
                $months [1]='Janvier'; 
                $months [2]='fevrier'; 
                $months [3]='mars'; 
                $months [4]='avril'; 
                $months [5]='mai'; 
                        // print_r($months);
                // echo $months[5];


            foreach ($months as $key => $value) {
                // echo $key.' '.$value.'<br>';
            ?>
                <label>
                    <input type="radio" name="month" <?php echo $myMonth == $key ? 'checked'  : '';?> > <?php echo $value;?>

                </label>

            <?php } ?>

            <hr>

            <select name="month"> 
                <?php foreach ($months as $key => $value) { ?>
                    <!-- selected c'est pour la valeur part default -->
                 <option <?php echo $myMonth == $key ? 'selected'  : '';?> > <?php echo $value; ?> </option>

                <?php } ?>

            </select>




    
    <footer></footer>
</body>
</html>