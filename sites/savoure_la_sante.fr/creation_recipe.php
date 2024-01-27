
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

        <h1>Page recette individuelle</h1>

        <!-- <?php
            echo $_GET['recipes_id'];
        ?> -->

        <?php
        // pour ce connecter a la basse de donner
            try
            {    
                $bdd = new PDO("mysql:host=localhost;dbname=savoure_la_sante", "root", "");
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e)    {
                die($erreur_sql='Erreur connect bd: '.$e->getMessage());
            }
        ?>
        
        <?php
        print_r($_POST);
        // supprimer utilisateur
        if (isset($_POST['delete'])) {
            try { 
                $sql="DELETE FROM recipes WHERE recipes_id = ?";
                $stmt = $bdd->prepare($sql);    
                $stmt->execute( array($_GET['recipes_id']) );

            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
            // redirection
        }

        // mise a jour utilisateur
            if (isset($_POST['update'])) {
                echo 'POST<br>';
                print_r($_POST);
                try { 
                    $sql="UPDATE recipes SET name = ?, description = ?, img = ?, type_recette = ?, time_recipe= ?, online= ?";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(
                        array(
                            strip_tags($_POST['name']),
                            strip_tags($_POST['description']),
                            strip_tags($_POST['img']),
                            strip_tags($_POST['type_recette']),
                            strip_tags($_POST['time_recipe']),
                            strip_tags($_POST['online']),
                        )
                    );   
                } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
            }

        // requete SELECT dans une table
            try { 
                $sql="SELECT * FROM recipes WHERE recipes_id = ?";
                $stmt = $bdd->prepare($sql);

                $stmt->execute( array($_GET['recipes_id']) );

            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

        // construction des resultats
            $results=$stmt->fetch(PDO::FETCH_ASSOC);

        // affiche les resultats
        // pour afficher tous les résultats décommenter print_r
            print_r($results);

            if ($results == '') {
                echo '<h3>Utilisateur inconnu</h3>';
                ?> 
                <a href="index.php">Revenir a tous les recette</a>
                <?php
            }

        // formulaire mise a jour
            else { ?>
                <form method="POST" >

                    <div class="rounded margin padding">
                        <br>
                        <input type="text" name="name" value="<?php echo $results['name'];?>">
                        <br>
                        <input type="text" name="description" value="<?php echo $results['description'];?>">
                        <br>
                        <hr>
                        <input type="submit" name="update" value="Modifier" >
                        <br>

                        <hr>
                        <img src="img/<?php echo $results['img'];?>" class="rounded" style="max-width: 30%; height: auto;">

                        <p><a href="index.php">Revenir a tous les utilisateurs</a></p>
                    </div>
                </form>

                <form method="POST" >

                    <div class="rounded margin padding">
                        <br>
                        <hr>
                        <input type="submit" name="delete" value="Supprimer" >
                    </div>
                </form>





            <?php } // else $results == '' ?>


            <!-- formulaire supprimer -->


 
            

    
    <footer></footer>
</body>
</html>