<!-- fusio horaire -->
<?php date_default_timezone_set('Europe/Paris');?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>savouré la santé</title>
        <link rel="stylesheet" href="style.css">
    </head>
   
    <body>

            <!-- pour ce connecter a la basse de donner -->
        <?php
            try
            {    
            $bdd = new PDO("mysql:host=localhost;dbname=savoure_la_sante", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e) {
            die($erreur_sql='Erreur connect bd: '.$e->getMessage());
            }
        ?>

        <!-- Requête d'insertion dans la table -->
        <?php
            if(isset($_POST['insert'] )) {
                try { 
                    $sql="INSERT INTO recipes SET name = ?, description = ?, img = ?, type_recette = ?, time_recipe= ?, online= ?";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(
                        array(
                            strip_tags($_POST['name']),
                            strip_tags($_POST['description']),
                            strip_tags($_POST['img']),
                            strip_tags($_POST['type_recette']),
                            strip_tags($_POST['time_recipe']),
                            strip_tags($_POST['online'])
                        )
                    );
    
                } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                echo '<script type="text/javascript">document.location=("index.php");</script>';
            } // if(isset($_POST['insert'] ))
        ?>



    <!-- Créer un nouvelle recipe -->
        <form method="POST" >

            <div class="rounded margin padding" >

                <br>
                <input type="text" name="name" placeholder="Nom de la recette">
                <br>
                <input type="text" name="description" placeholder="Description de la recette">
                <br>
                <input type="text" name="img" placeholder="Image">
                <br>
                <input type="text" name="time_recipe" placeholder="Temps de cuisson de la recette">
                <br>
                <input type="text" name="online" placeholder="si afficher ou pas">
                <br>
                <input type="submit" name="insert" value="Créer">

                <hr>

            </div>
        </form>

        <?php
            // requete SELECT dans une table
            try { 
                $sql="SELECT * FROM recipes ORDER BY recipes_id DESC ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute();
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

            // boucle while, qui permet de boucler les resultats
            // boucle 1
            // while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                // // print_r($results);
                // echo $results ['name']. ' ' .$results['first_name'];
                // // echo '<p>' .$results['mail'] . '</p>';
                // echo '<br>' .$results['mail'];
                // echo '<br><a href="mail: '.$results['mail'].' "> Envoyer un mail a ==> '.$results['mail']. '</a>';
                // // echo '<a href="mail:xxxx "> Envoyer un mail </a>';

                // echo '<hr>';


        // boucle while page des recette
            while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                // print_r($results);

                ?>
                <div class="rounded margin box-shadow padding";>

                    <img src="img/<?php echo $results['img'];?>" class="rounded box-shadow" style="max-width: 30%; height: auto; box-shadow: 10px 10px 30px;">
                    <h1><?php echo $results['name'] ?></h1>
                    <h3><?php echo $results['description'] ?></h3>                   
            
                <!-- page recette individuelle -->
                    <p>
                        <a href="creation_recipe.php?recipes_id=<?php echo $results['recipes_id'];?>">
                            aller a la page de <b><?php echo $results['name'];?></b>
                        </a>
                    </p>



                    <hr color="white" >
                </div>           
            <?php } ?>


            <footer>
                <a href="mail:xxx"> Envoyer un mail</a>

              <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="http">cuissine</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="http://localhost/sites/test/">damien</a> is licensed under <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1"></a></p>  
            </footer>

    </body>
</html>