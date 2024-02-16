
            <!-- pour ce connecter a la basse de donner -->
        <?php
            try
            {    
            $bdd = new PDO("mysql:host=localhost;dbname=relationnal", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e) {
            die($erreur_sql='Erreur connect bd: '.$e->getMessage());
            }
            
            // control si ya erreur a la connection de la base
                if (isset($erreur_sql)) {
            echo $erreur_sql;
        }
        ?>

<?php
        try { 
            $sql="SELECT * FROM users";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
        // construct results
            while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                // print_r($results);
                // echo '<hr>';
                // SELECT * FROM COMMENTS WHERE user_id = ?
                try { 
                    $sql="SELECT * FROM comments";
                    $stmt_comments = $bdd->prepare($sql);
                    $stmt_comments->execute( array(
        
                    ) );
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                
                // construct results
                    while($results=$stmt_comments->fetch(PDO::FETCH_ASSOC)) {
                        print_r($results);
                        echo '<hr>';
                        // echo '<h3>user '.$results['user_id']. '<br>' .$results['comment_content']. '</h3>';
                    }
                    
        } // and wile(user)
	?>

<br><br>
    die();





<?php
    try { 
                // SELECT table_1.colonne, table_2.colonne
                // from (depuis) table_1
                // JOIN (joindre) table_2
                // WHERE (la ou) table_1.colonne_commune = table.colonne_commune
                    $sql="
                    SELECT users.users_name, comments.comment_content
                    FROM users
                    INNER JOIN comments
                    ON users.user_id = comments.user_id";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute( array(
        
                    ) );
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                     // construct results
                        while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        print_r($results);
                        echo '<hr>';

                    }


?>

<br><br>

<p>récuper information a gauche users</p>
<?php
    try { 
                // SELECT table_1.colonne, table_2.colonne
                // from (depuis) table_1
                // JOIN (joindre) table_2
                // WHERE (la ou) table_1.colonne_commune = table.colonne_commune
                    $sql="
                    SELECT users.users_name, comments.comment_content
                    FROM users
                    LEFT OUTER JOIN comments
                    ON users.user_id = comments.user_id
                    ";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute( array(
                        
        
                    ) );
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                     // construct results
                        while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        print_r($results);
                        echo '<hr>';

                    }

?>


<br><br>

<p>récuper information a gauche comments</p>
<?php
    try { 
                // SELECT table_1.colonne, table_2.colonne
                // from (depuis) table_1
                // JOIN (joindre) table_2
                // WHERE (la ou) table_1.colonne_commune = table.colonne_commune
                    $sql="
                    SELECT users.users_name, comments.comment_content
                    FROM comments
                    LEFT OUTER JOIN users
                    ON users.user_id = comments.user_id";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute( array(
        
                    ) );
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                     // construct results
                        while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        print_r($results);
                        echo '<hr>';

                    }

?>




<br><br>

<p>récuper information a droite users</p>
<?php
    try { 
                // SELECT table_1.colonne, table_2.colonne
                // from (depuis) table_1
                // JOIN (joindre) table_2
                // WHERE (la ou) table_1.colonne_commune = table.colonne_commune
                    $sql="
                    SELECT users.users_name, comments.comment_content
                    FROM users
                    RIGHT OUTER JOIN comments
                    ON users.user_id = comments.user_id";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute( array(
        
                    ) );
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                     // construct results
                        while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        print_r($results);
                        echo '<hr>';

                    }

?>


<br><br>

<p>récuper information a gauche users changer le nom de colonne</p>
<?php
    try { 
                // SELECT table_1.colonne, table_2.colonne
                // from (depuis) table_1
                // JOIN (joindre) table_2
                // WHERE (la ou) table_1.colonne_commune = table.colonne_commune
                    $sql="
                    SELECT users.users_name userName, comments.comment_content
                    FROM users
                    LEFT OUTER JOIN comments
                    ON users.user_id = comments.user_id
                    ";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute( array(
                        
        
                    ) );
                    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                     // construct results
                        while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        print_r($results);
                        echo '<hr>';

                    }

?>


