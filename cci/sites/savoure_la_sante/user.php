<h1>user</h1>

page user_id <?php echo $_GET['user_id'];?><hr>

<?php

        if (isset($_POST['update'])) {
            print_r($_POST);
     // UPDATE
            try {
                $sql = "UPDATE users SET name = ?, first_name = ?, mail = ?, pass = ? WHERE user_id = ? ";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        strip_tags($_POST['name']),
                        strip_tags($_POST['first_name']),
                        strip_tags($_POST['mail']),
                        strip_tags($_POST['pass']),
                        $_GET['user_id']
                    )
                );
            } catch (Exception $e) {
                print "Erreur ! " . $e->getMessage() . "<br/>";
            }
    
     // fin UPDATE
        }


    // REQUEST select
        try { 
            $sql="SELECT * FROM users WHERE user_id = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(
                $_GET['user_id']
            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
        // construct results
        $results=$stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($results);
            // echo '<br>';

        if (empty($results)) {

            echo 'nous n\'avons pas trouvé cet utilisateur. <br><a href="index.php?p=users.php"> Revenir a la page utilisateurs</a>';
        }
        // else {
        //     echo 'OK trouvé';
        // }
    // end REQUEST select
        
?>

<form method="POST">
    <br>
    <label for="name"></label>
    <input  type="text" name="name" value="<?php echo $results['name']; ?>" placeholder="name"></input>
    <br>
    <label for="first_name"></label>
    <input type="text" name="first_name" value="<?php echo $results['first_name'] ?>" placeholder="first_name"></input>
    <br>
    <label for="mail"></label>
    <input type="mail" name="mail" value="<?php echo $results['mail']; ?>" placeholder="mail"></input>
    <br>
    <label for="pass"></label>
    <input type="password" name="pass" value="<?php echo $results['pass']; ?>" placeholder="password"></input>
    <br>
    <label for=""></label>
    <input type="submit" value="update" name="update">
</form>


