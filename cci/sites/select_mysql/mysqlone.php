<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>aller_a_la_page</title>
</head>

<body>
    <!-- pour ce connecter a la basse de donner -->
    <?php
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=dwmm_test", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die($erreur_sql = 'Erreur connect bd: ' . $e->getMessage());
    }

    // control si ya erreur a la connection de la base
    if (isset($erreur_sql)) {
        echo $erreur_sql;
    }
    ?>



    <?php
    $id = strip_tags($_GET['id']);

    if (isset($_POST['update'])) {
 // UPDATE
        try {
            $sql = "UPDATE users SET name = ?, first_name = ?, mail = ? WHERE users_id = ? ";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
                array(
                    strip_tags($_POST['name']),
                    strip_tags($_POST['first_name']),
                    strip_tags($_POST['mail']),
                    $id

                )
            );
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }

        // print_r($_POST);
        // echo '<hr>';
 // fin UPDATE
    }



// DELETE 
    elseif (isset($_POST['delete'])) {
        print_r($_POST);
        echo '<hr>';

        try {
            $sql = "DELETE FROM users WHERE users_id = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
                array(
                    $id
                )
            );
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }
        echo '<script>window.location.href="index.php" </script>';
    }
// fin DELETE 
    ?>


    <?php
// SELECT 
    $id = strip_tags($_GET['id']);
    try {
        $sql = "SELECT * FROM users WHERE users_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(
            array(
                $id
            )
        );
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }

    // construct results
    $results = $stmt->fetch(PDO::FETCH_ASSOC); {
        // print_r($results);
        // echo $results['mail'];
        // echo '<hr>';
    }
// fin SELECT 
    ?>

    <a href="index.php">Retour sur Users listes</a>

    <h1>User</h1>

    <?php
    if (!empty($results)) { ?>
        <h2>
            <form method="POST">
                Vous êtes sur la page de :
                <br>
                <input type="text" name="name" value="<?php echo $results['name']; ?>"></input>
                <br>
                <input type="text" name="first_name" value="<?php echo $results['first_name'] ?>"></input>
                <br>
                <input type="mail" name="mail" value="<?php echo $results['mail']; ?>"></input>
                <br>
                <input type="submit" value="update" name="update">

                <input type="submit" value="delete" name="delete">
            </form>
        </h2>

    <?php } else {
        echo 'Utilisateur inconnu';
    }
    ?>

</body>

</html>