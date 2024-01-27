<?php session_start();?>
<?php date_default_timezone_set('Europe/Paris');?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">


    <!-- connect a la basse de donner -->
        <?php
            try
            {    
            $bdd = new PDO("mysql:host=localhost;dbname=dwmm_test", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e) {die($erreur_sql='Erreur connect bd: '.$e->getMessage());}
        ?>

            <?php 
            // login test 
            if (isset($_POST['loginBtn'])) {

                

                    // print_r($_POST);
                try { 
                    $sql="SELECT mail, pass, role, nbConnect FROM users WHERE mail = ? ";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(
                        array(
                           strip_tags($_POST['mail'])
                            )
                        );   
                    }
                    catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
                        $user=$stmt->fetch(PDO::FETCH_ASSOC);

                        // print_r($user);

                        if (empty($user)) {
                            // echo 'utilisateur inconue';
                            $loginError = '<p class="bg-danger rounded">utilisateur inconue</p>';
                        }
                        else {
                            if ($user['pass'] != $_POST['pass']) {
                                // echo 'pass PAS ok';
                                $loginError = '<p class="bg-danger rounded">Erreur de Mots de pass inconue</p>';
                            } 
                            
                            else {
                                // echo 'pass ok';
                                if ($user['role'] == 0 ) {
                                    $loginError = '<p class="bg-danger rounded"> Vous navez pas accèes a cette espace </p>';
                                }
                                else {
                                    echo'OK entrer';
                                    // UPDATE dateConnect

                                    try { 
                                        $sql="UPDATE users SET dateConnect = ?, nbConnect = ? WHERE mail = ? ";
                                        $stmt = $bdd->prepare($sql);
                                        $stmt->execute(
                                            array(

                                                date('Y-m-d H:i:s'),
                                                strip_tags($user['nbConnect'] = $user['nbConnect'] + 1),
                                                strip_tags($user['mail'])
                                                )
                                            );   
                                        }
                                        catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

                                    
                                    // session admin
                                    $_SESSION['admin'] = $user;
                                    // print_r($_SESSION);


                                
                                }
                            }
                        }      
            }
            // login test

            // deconnectBtn
            elseif (isset($_POST['deconnectBtn'] )) {
                // remove session admin
                unset($_SESSION['admin']);
            }
            ?>



        <!-- login de _SESSION -->
        <?php
            if (!isset($_SESSION['admin'])) {
                include('login.php');
            }
            else { ?>

                <!-- TOP NAV -->
                <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark text-white ">
                    <!-- Navbar Brand-->
                    <a class="navbar-brand ps-3" href="index.html">Savourez la santé</a>
                    <!-- Sidebar Toggle-->
                    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
                    <!-- Navbar Search-->
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                        <div class="input-group">

                        <!-- <button type="submit" name=deconnectBtn" class="form-control me-3 ronded text-center" > Déconnection </button> -->

                            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <!-- Navbar-->

                    <form method="POST">
                        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <!-- <li><a class="dropdown-item" href="#!">Logout</a></li> -->

                                    
                                    <li><button type="submit" name="deconnectBtn" class="dropdown-item" > Logout </button></li>
                                
                                
                                </ul>
                            </li>
                        </ul>
                    </form>
                </nav>
                <!-- fin de TOP NAV -->


                <div id="layoutSidenav">


                    <!-- SIDE NAV menu -->
                    <div id="layoutSidenav_nav">
                        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                            <div class="sb-sidenav-menu">
                                <div class="nav">
                                    <div class="sb-sidenav-menu-heading">Core</div>



                                    <a class="nav-link" href="index.php?p=home.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                        Accueil
                                    </a>

                                    <a class="nav-link" href="index.php?p=users.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                        User
                                    </a>

                                    <a class="nav-link" href="index.php?p=visitor.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                        Visitors
                                    </a>




                                    <div class="sb-sidenav-menu-heading">Interface</div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                        Layouts
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                        Pages
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                                Authentication
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>
                                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                                <nav class="sb-sidenav-menu-nested nav">
                                                    <a class="nav-link" href="login.html">Login</a>
                                                    <a class="nav-link" href="register.html">Register</a>
                                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                                </nav>
                                            </div>
                                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                                Error
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>
                                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                                <nav class="sb-sidenav-menu-nested nav">
                                                    <a class="nav-link" href="401.html">401 Page</a>
                                                    <a class="nav-link" href="404.html">404 Page</a>
                                                    <a class="nav-link" href="500.html">500 Page</a>
                                                </nav>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="sb-sidenav-menu-heading">Addons</div>
                                    <a class="nav-link" href="charts.html">
                                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                        Charts
                                    </a>
                                    <a class="nav-link" href="tables.html">
                                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                        Tables
                                    </a>
                                </div>
                            </div>
                            <div class="sb-sidenav-footer">
                                <div class="small">Logged in as:</div>
                                Start Bootstrap
                            </div>
                        </nav>
                    </div>
                    <!-- fin de SIDE NAV -->



                    <!-- content -->
                    <!-- Div avec un identifiant pour le contenu principal -->
                    <div id="layoutSidenav_content" class="bg-dark text-light">
                        <main>
                            <!-- Conteneur fluide avec un décalage de 4 colonnes sur chaque côté -->
                            <div class="container-fluid px-4">
                                <?php 
                                    // Conditionnelle qui inclut une page si elle existe, sinon inclut la page 'home.php'
                                    if (!@include_once($_GET['p'])) {
                                        include_once('home.php');
                                    }
                                ?>
                            </div>
                        </main>

                            <footer class="py-4 mt-auto bg-dark text-light">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Savourez la santé <?php echo date('Y');?> </div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- fin de content -->

        <!-- fin du esle _SESSION -->
        <?php } ?>





        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
