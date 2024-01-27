<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>

            <!-- pour ce connecter a la basse de donner -->
        <?php


// $word = 'd d d d d';
// $word = str_replace('','',$word);
// echo '|'.$word.'|';
// echo '<hr>';

            try
            {    
            $bdd = new PDO("mysql:host=localhost;dbname=dwmm_test", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e) {
            die($erreur_sql='Erreur connect bd: '.$e->getMessage());
            }
            // if (isset($erreur_sql)) {
            //     echo $erreur_sql;
            // }

            // else {
            //     echo 'connection DB ok' ;
            // }
            
        ?>



<?php 
    // if conectBtn exite
    if (isset($_POST['connectBtn'])) {
        // var_dump($_POST);

        // clean post
            $mail = strip_tags(str_replace('','', $_POST['mail']));
            $pass = strip_tags(str_replace('','', $_POST['pass']));
            

        // test mail
            // mail ok
            if (filter_var($mail,FILTER_VALIDATE_EMAIL)) {
                echo 'mail valid';
                $mailValid = 1;
            }
            // mail no
            else {
                echo 'mail NO valid';
                $mailValid = 0;
            }

            // if mailValid
            if ($mailValid) {
                // search in table
                try { 
                    $sql="SELECT * FROM users WHERE mail = ?";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute( array(

                        $mail,

                    ) );
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                
                // construct results
                    $results=$stmt->fetch(PDO::FETCH_ASSOC);
                    print_r($results); 
                    
            }

            // if results id damien
            if (!empty($results)) {
                echo '<br> user found ';

                // test du pass
                if ($pass == $results['pass']) {
                    echo 'pass ok';
                    $_SESSION['user']=$results;
                }
                else {
                    echo 'pass pas bon';
                }
            }

            // else
            else {
                echo ' user unknown';
            }
        // fin if mailValid

    } // fin de if conectBtn exite

    // DeconnectBtn
    elseif (isset($_POST['DeconnectBtn'])) {
    unset($_SESSION['user']);
    }

    elseif (isset($_POST['sincrire'])) {
        echo 'Bienvenue sur la page de créeration de compte';
        }

		// // print_r($_SERVER)
        // foreach ($_SERVER as $key => $value) {
        //     echo $key . ' > ' .$value . '<br>';
        // }
        
        // echo ' <br> IP = '.$_SERVER['REMOTE_ADDR'] . '<br>';
        // echo ' <br> apache = '.$_SERVER['SERVER_SIGNATURE'] . '<br>';


        foreach ($_SERVER as $key => $value) { ?>

            <p style="<?php if ($key == 'REMOTE_ADDR') { echo 'color: green';} ?>" >
                <?php echo $key .' '. $value;?>
            </p>

        <?php }
        

    
        

?>

<?php if (!isset($_SESSION['user']) ) {  ?>

<form method="POST">
    
    <p>
    connection
    </p>
    <div>
        <label id="mail" class="connection" for="mail"></label>
        <input type="text" name="mail" id="mail" placeholder="mail" autofocus >
    </div>

    <div>
        <label id="pass" class="connection" for="password"></label>
        <input type="password" name="pass" id="pass" placeholder="password" >
    </div>

    <input class="submit" name="connectBtn" type="submit" value="envoyer">

    <input type="submit" value="Créer un compte" name="sincrire" value="sincrire">

</form>


    
    <?php }
    else { ?>

        <form method="POST">
            <input id="DeconnectBtn" type="submit" name="DeconnectBtn" value="Deconnect">
        </form>

    <?php } ?>





    <select name="" id="server">

        <?php foreach ($_SERVER as $key => $value) { ?>

            <option value="<?php echo $key ;?>" <?php if ($key == 'REMOTE_ADDR') { echo 'selected';} ?> >
                <?php echo $key . ' :--->  '. $value ; ?>
            </option>

        <?php } ?>

        
        

    </select>

</body>
</html>