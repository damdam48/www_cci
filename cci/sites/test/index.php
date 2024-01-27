<!-- pour avoir le fusio horaire -->
<?php date_default_timezone_set('Europe/Paris');?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>tire de la page</title>
        <link rel="stylesheet" href="style.css">
    </head>
   
    <body>

        <!-- pour ce connecter a la basse de donner -->
        <?php
            try
            {    
            $bdd = new PDO("mysql:host=localhost;dbname=dwmm_test", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e) {
            die($erreur_sql='Erreur connect bd: '.$e->getMessage());
            }
        ?>



        <!-- Requête d'insertion dans la table (bouton modifier) -->
        <?php
            if(isset($_POST['insert'] )) {
                try { 
                    $sql="INSERT INTO users SET name = ?, first_name = ?, mail = ?, color = ?";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(
                        array(
                            strip_tags($_POST['name']),
                            strip_tags($_POST['first_name']),
                            strip_tags($_POST['mail']),
                            strip_tags($_POST['color']),
                        )
                    );
                } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                echo '<script type="text/javascript">document.location=("index.php");</script>';
            } // fin de if(isset($_POST['insert'] ))
        ?>



    <!-- Tableau pour créer un nouvelle utilisateur -->
        <form method="POST" >
            <div class="rounded margin padding" >

                <br>
                <input type="text" name="first_name" placeholder="Votre Nom" autofocus>
                <br>
                <input type="text" name="name" placeholder="Votre prénom">
                <br>
                <input type="text" name="mail" placeholder="Mail">
                <br>
                <input type="color" name="color" placeholder="color">
                <br>
                <input type="submit" name="insert" value="Créer">
                <hr>
            </div>
        </form>

        <?php
            // requete SELECT dans une table
            try { 
                $sql="SELECT * FROM users ORDER BY users_id DESC ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute();
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

            // boucle while de la pages de tous les utilisateurs
            while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                // print_r($results);

                ?>
                <div class="rounded margin box-shadow padding";>
                    <h1><?php echo $results['first_name']. ' ' .$results['name'];?></h1>

                    <p>
                        <a href="user.php?users_id=<?php echo $results['users_id'];?>">
                            aller a la page de <b><?php echo $results['name'];?></b>
                        </a>
                    </p>

                
                    <img src="img/<?php echo $results['img'];?>" class="rounded box-shadow" style="max-width: 30%; height: auto; box-shadow: 10px 10px 30px <?php echo $results['color']; ?>;">

                    <br>
                    <br>

                    <a href="mail:xxx"> Envoyer un mail</a>

                    <hr color="white" >
            </div>
            <?php } ?>


        <hr>
            <footer>
              <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="http">cuissine</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="http://localhost/sites/test/">damien</a> is licensed under <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1"></a></p>  
            </footer>

    </body>
</html>