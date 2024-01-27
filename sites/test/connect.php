<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connect.php</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>connect</h1>
    <?php
        // connection a la base de donner
            try
            {    
            $bdd = new PDO("mysql:host=localhost;dbname=dwmm_test", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            // En cas d'erreur lors de la connexion, afficher un message d'erreur et arrêter le script
            catch(Exception $e) {die($erreur_sql='Erreur connect bd: '.$e->getMessage());}


            // Vérifier si des données ont été soumises via la méthode POST
            if (!empty($_POST))
            {
                // Si le bouton de connexion a été pressé
                if (isset($_POST['connect'])) {
                    // Message indiquant que le bouton de connexion a été pressé
                    // echo 'ok, button connect';

                    // Requête select SQL pour sélectionner un utilisateur par son adresse e-mail
                    try { 
                        $sql="SELECT * FROM users WHERE mail = ? ";
                        $stmt = $bdd->prepare($sql);
                        $stmt->execute(
                            array(
                                strip_tags( $_POST['mail'] )

                            ));
                    } catch (Exception $e) {
                        // En cas d'erreur lors de l'exécution de la requête, afficher un message d'erreur
                        print "Erreur ! " . $e->getMessage() . "<br/>";}

                    // Récupère les résultats de la requête
                    $resulta=$stmt->fetch(PDO::FETCH_ASSOC);
                    // Afficher les résultats (peut être utilisé à des fins de débogage)
                    // print_r($resulta);

                    // Vérifier s'il n'y a pas d'utilisateur avec l'e-mail spécifié
                    if (empty($resulta)) {
                        echo 'mail pas bon';
                    }
                    else {
                        // echo 'mail ok <br>';
                        // test pass $results['pass'] / $_POST['pass']
                            // Vérifier si le mot de passe correspond
                            if ($resulta['pass'] == $_POST['pass']) {
                                // echo 'Pass ok <br>';
                                // Si le mot de passe est correct, initialiser la session utilisateur
                                $_SESSION['user'] = 1;
                            }
                            else {
                                echo 'Mauvais mot de pass <br>';
                            }
                    }
                } // fin (isset($_POST['connect']))



                // Si le bouton de déconnexion a été pressé
                else if (isset($_POST['deconnecter'])) {
                    // Supprimer la session 'user'
                    unset($_SESSION['user']);
                    // Éventuellement, détruire la session complètement
                    // session_destroy();
                    
                }

            } // if (!empty($_POST))

    ?>

    <!-- Vérifier si l'utilisateur n'est pas connecté (la variable de session 'user' n'est pas définie) -->
    <?php if (!isset($_SESSION['user'])) { ?>

        <!-- Formulaire de connexion -->
        <form method="POST">
            <input type="text" name="mail" value="1@mail.fr" autofocus id=""><br>  
            <input type="text" name="pass" value="123456" id=""><br>
            <input type="submit" name="connect" value="Se connecter" id="">    
        </form>
    
    <?php }

    else { ?>
        <!-- Formulaire de déconnexion -->
        <form method="POST">
            <!-- Bouton de soumission du formulaire pour la déconnexion avec le focus automatique -->
            <input type="submit" name="deconnecter" value="Se deconnecter" autofocus>
        </form>

    <?php }?>
    
</body>
</html>