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
            
            // control si ya erreur a la connection de la base
                if (isset($erreur_sql)) {
            echo $erreur_sql;
        }
        ?>