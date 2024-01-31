<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php include('connectDB.php'); ?>

<?php
        try { 
            $sql="SELECT user_id FROM users";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
            $usersNB = $stmt ->rowCount();
            // echo 'il y a ' . $usersNB . ' users';
            
	?>
<?php
        try { 
            $sql="SELECT article_id FROM article";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
            $articleNB = $stmt ->rowCount();
            // echo 'il y a ' . $usersNB . ' article';
            
	?>
<?php
        try { 
            $sql="SELECT categorie_id FROM categorie";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
            $name_catNB = $stmt ->rowCount();
            // echo 'il y a ' . $usersNB . ' article';
            
	?>

    <header>
    <!-- start header -->
        <h1>Acceuil</h1>

        <div id="menu">
            <hr>
            <a href="index.php?p=home.php">Home</a>
            <a href="index.php?p=Articles.php">Articles (<?php echo $articleNB; ?>)</a>
            <a href="index.php?p=Users.php">Users (<?php echo $usersNB; ?>)</a>
            <a href="index.php?p=categories.php">Categories (<?php echo $name_catNB; ?>)</a>
            <hr>
        </div>

    </header>
    <!-- end header -->

    <main>
    <!-- start main -->
    
        <!-- <?php echo var_dump($_GET);?> -->
            <div class="contener">
                <?php
                // si il exite GET p l'inclure
                    if (isset($_GET['p'])) {
                        include($_GET['p']);
                    }
                // sinon inclure home
                    else {
                        include('home.php');
                    }
                ?>
            </div>
    </main>
    <!-- end main -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>