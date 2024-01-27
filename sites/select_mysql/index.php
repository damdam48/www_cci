<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>select mysql</title>
</head>

<body>



    <?php
    if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::') {
        echo 'local connection';
        echo '<hr>';
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
    } else {
        echo 'distant connection';
        echo '<hr>';
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
    }


    // create
    if (isset($_POST['create'])) {
        // print_r($_POST);
        // echo '<hr>';
    
        try {
            $sql = "INSERT INTO users SET name = ?, first_name = ?, mail = ? ";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
                array(
                    strip_tags($_POST['name']),
                    strip_tags($_POST['first_name']),
                    strip_tags($_POST['mail']),


                )
            );
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }

        $lastId = $bdd->lastInsertId();
        echo '<p>You have insert the user id :' .$lastId. '</p>' ;

// fin create
    }
    ?>

    <h1>
        insert
    </h1>

    <form method="POST">
        <h1>select mysq</h1>

        <input class="user" type="text" name="name" value="" placeholder="name"></input>
        <br>
        <input class="user" type="text" name="first_name" value="" placeholder="first_name"></input>
        <br>
        <input class="user" type="mail" name="mail" value="" placeholder="mail"></input>
        <br>
        <input class="user" type="submit" value="create" name="create">
    </form>

    <p>
        lister les lignes d'une table
    </p>
    <hr>

    <?php



    try {
        $sql = "SELECT * FROM users";
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
        ?>
        <p class="card">
            <?php
            echo 'name: ' . ' ' . $results['name'] . '<br>' .
                'first_name: ' . $results['first_name'] . '<br>' .
                'mail: ' . $results['mail'] . '<br>' .
                'ID: ' . $results['users_id'] . '<br>'; ?>
        </p>
        <!-- ?> -->

        <a href="mysqlone.php?id=<?php echo $results['users_id'] ?>">
            Aller a la page </a>

        <?php
        echo '<hr>';
    }
    ?>

    <!-- ?> -->



</body>

</html>