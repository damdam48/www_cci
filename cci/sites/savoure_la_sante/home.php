<h1>Home</h1>

<?php
        try { $sql="SELECT users_id FROM users";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
            $usersNB = $stmt ->rowCount();
            // echo 'il y a ' . $usersNB . ' users';
            

        try { $sql="SELECT articles_id FROM articles";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
            $articleNB = $stmt ->rowCount();
            // echo 'il y a ' . $usersNB . ' article';
            

        try { $sql="SELECT categories_id FROM categories";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
            $name_catNB = $stmt ->rowCount();
            // echo 'il y a ' . $usersNB . ' article';
            

        try { $sql="SELECT recettes_id FROM recettes";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
            $recette_catNB = $stmt ->rowCount();
            // echo 'il y a ' . $usersNB . ' article';
            
	?>


<header>
    <!-- start header -->
        <h1 class="text-center">Acceuil</h1>




        <div class="card-group">
            <div class="card text-white mb-3" id="card-articles">
                <div class="card-header text-white text-center"> <a class="text-white" href="index.php?p=Articles.php">Articles</a> </div>
                <p class="card-body text-white text-center">Nombres :  <?php echo $articleNB; ?> </p>
                <div class="card-footer"> </div>
            </div>
            
            <div class="card text-white mb-3" id="card-users" >
                <div class="card-header text-white text-center"> <a class="text-white" href="index.php?p=Users.php">Users</a> </div>
                <p class="card-body text-white text-center">Nombres :  <?php echo $usersNB; ?> </p>
                <div class="card-footer"> </div>
            </div>
           
            <div class="card text-white mb-3" id="card-categories">
                <div class="card-header text-white text-center"> <a class="text-white" href="index.php?p=categories.php">categories</a> </div>
                <p class="card-body text-white text-center">Nombres :  <?php echo $name_catNB; ?> </p>
                <div class="card-footer"> </div>
            </div>
            
            <div class="card text-white mb-3"  id="card-recettes" >
                <div class="card-header text-white text-center"> <a class="text-white" href="index.php?p=recettes.php">recettes</a> </div>
                <p class="card-body text-white text-center">Nombres :  <?php echo $recette_catNB ; ?> </p>
                <div class="card-footer"> </div>
            </div>  
        </div>

    </header>