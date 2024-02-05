<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- bootstrap-icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src=" https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js "></script>

    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php include('connectDB.php'); ?>

      <!-- navbar top -->
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark text-light">
          <div class="container-fluid border-bottom">
            <a class="navbar-brand" href="#">DWWM SjSR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
                <!-- offcanvas btn -->
                  <li class="nav-item pt-1">
                      <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <i class="bi bi-arrow-bar-left"></i>
                      </button>
                  </li>
                <!-- offcanvas btn -->

                <li class="nav-item">
                  <form method="POST">
                    <button class="nav-link form-control bg-dark border-dark">
                      <i class="bi bi-person-lock"></i>
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- navbar top -->

      <div class="container-fluid">
            <div class="row flex-nowrap">

            	<!-- sideBar left -->
	                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
	                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-5 text-white min-vh-100">
	                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-3" id="menu">
	                            <li class="nav-item">
	                                <a href="index.php" class="nav-link align-middle px-0">
	                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
	                                </a>
	                            </li>
	                            <li class="nav-item">
	                                <a id="sideBar-articles" href="index.php?p=articles.php" class="nav-link align-middle px-0">
	                                    <i class="fs-4 bi bi-puzzle"></i> 
	                                     <span class="ms-1 d-none d-sm-inline">Articles</span>
	                                </a>
	                            </li>

                                <li class="nav-item">
	                                <a id="sideBar-categories" href="index.php?p=categories.php" class="nav-link align-middle px-0">
	                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">categories</span>
	                                </a>
	                            </li>

                                <li class="nav-item">
	                                <a id="sideBar-users" href="index.php?p=Users.php" class="nav-link align-middle px-0">
	                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Users</span>
	                                </a>
	                            </li>

                                <li class="nav-item">
	                                <a id="sideBar-recettes" href="index.php?p=recettes.php" class="nav-link align-middle px-0">
	                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">recettes</span>
	                                </a>
	                            </li>



<!-- //////// -->


<!-- //////// -->
	                            <li>
	                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
	                                <i class="fs-4 bi-speedometer2"></i> 
	                                	<span class="ms-1 d-none d-sm-inline">	
	                                		Dashboard
	                                	</span></a>
	                                <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
	                                    <li class="w-100">
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Item 1</span>
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Item 2</span> 
	                                        </a>
	                                    </li>
	                                </ul>
	                            </li>
	                            <li>
	                                <a href="#" class="nav-link px-0 align-middle">
	                                    <i class="fs-4 bi-table"></i> 
	                                   	<span class="ms-1 d-none d-sm-inline">Orders</span>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
	                                    <i class="fs-4 bi-bootstrap"></i> 
	                                    <span class="ms-1 d-none d-sm-inline">Bootstrap</span>
	                                </a>
	                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
	                                    <li class="w-100">
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Item 1</span>
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Item 2</span> 
	                                        </a>
	                                    </li>
	                                </ul>
	                            </li>
	                            <li>
	                                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
	                                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
	                                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
	                                    <li class="w-100">
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Product 1</span> 
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Product 2</span> 
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Product 3</span>
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="nav-link px-0"> 
	                                        	<span class="d-none d-sm-inline">Product 4</span>
	                                        </a>
	                                    </li>
	                                </ul>
	                            </li>
	                            <li>
	                                <a href="#" class="nav-link px-0 align-middle">
	                                    <i class="fs-4 bi-people"></i> 
	                                    <span class="ms-1 d-none d-sm-inline">Customers</span> 
	                                </a>
	                            </li>
	                        </ul>
	                    </div>
	                </div>
            	<!-- sideBar left --> 

            	<!-- content -->
	                <div class="col mt-5 py-3" style="overflow-y: scroll;height:90vh;">
	                    <?php
							// If GET p exist > include 
								if (isset($_GET['p'])) {
									include($_GET['p']); 
								}
							// Else include home
								else {
									include('home.php');
								}
							?>
                    </div>	                
            	<!-- content -->

            </div>
        </div>
      <!-- container -->



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

<?php
        try { 
            $sql="SELECT recette_id FROM recette";
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

        <div id="menu" class="text-center" >
            <hr>
            <a href="index.php?p=home.php">Home</a>
            <a href="index.php?p=Articles.php">Articles (<?php echo $articleNB; ?>)</a>
            <a href="index.php?p=Users.php">Users (<?php echo $usersNB; ?>)</a>
            <a href="index.php?p=categories.php">Categories (<?php echo $name_catNB; ?>)</a>
            <a href="index.php?p=recettes.php">recette (<?php echo $recette_catNB; ?>)</a>
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