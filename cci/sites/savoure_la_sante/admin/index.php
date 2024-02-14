<?php session_start(); ?>
<?php date_default_timezone_set('Europe/Paris'); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- bootstrap-icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <script src=" https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js "></script>

  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>

<body>
  <?php
  include('connectDB.php');



  // login test 
  if (isset($_POST['connectBtn'])) {
    try {
      $sql = "SELECT * FROM users WHERE mail = ? ";
      $stmt = $bdd->prepare($sql);
      $stmt->execute(
        array(
          strip_tags($_POST['mail'])
        )
      );
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (empty($user)) {
        $loginError = '<p class="bg-danger rounded">mail inconnu</p>';
      } else {
        if ($user['pass'] != $_POST['pass']) { // Ne pas hasher le mot de passe lors de la comparaison
          $loginError = '<p class="bg-danger rounded">Erreur de mot de passe inconnu</p>';
        } else {
          // Connexion réussie
          echo 'Connexion réussie';
          $_SESSION['admin'] = $user;

          try {
            $sql = "UPDATE users SET dateConnect = ? WHERE user_id = ? ";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
              array(
                date('Y-m-d H:i:s'),
                $user['user_id']
              )
            );
          } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
          }
        }
      }
    } catch (Exception $e) {
      print "Erreur ! " . $e->getMessage() . "<br/>";
    }
  }





  // deconnectBtn
  elseif (isset($_POST['deconnectBtn'])) {
    // remove session admin
    unset($_SESSION['admin']);
  } elseif (isset($_POST['passwordLost'])) {
    // print_r($_POST);
    ?>
    <!-- <p>Vous avez demandé un nouveau mot de pass </p> -->
    <!-- <a href=""></a> -->
    <?php

    // Test de la validité de l'email
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
      // echo 'Email valide';
      $mailValid = true;
    } else {
      echo 'Email non valide';
      $mailValid = false;
    }

    // Si l'email est valide
    if ($mailValid) {
      try {
        $sql = "SELECT * FROM users WHERE mail = ? ";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(
          array(
            strip_tags($_POST['mail']),
          )
        );
      } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
      }

      // Si aucun résultat n'est retourné
      if ($stmt->rowCount() == 0) {
        // Aucun utilisateur trouvé avec cet email
        echo '<br>';
        echo "Aucun utilisateur trouvé avec cet email";
      } else {
        // L'utilisateur existe,récupére ses données
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Générer une clé aléatoire
        $randomKey = bin2hex(random_bytes(16)); //clé aléatoire en hexadécimale pour le pas avoir de carrataire spéciaux
        // echo '<br>';
        // echo $randomKey;
        // Mettre à jour l'utilisateur avec la clé aléatoire
        try {
          $sql = "UPDATE users SET randomKey = ?, dateCreation = ? WHERE mail = ?";
          $stmt = $bdd->prepare($sql);
          $stmt->execute(
              array(
                  $randomKey,
                  date('Y-m-d H:i:s'), // Mettre à jour la date de création ici
                  strip_tags($_POST['mail'])
              )
          );
      } catch (Exception $e) {
          print "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage() . "<br/>";
      }
      

        // Créer une constante pour la durée de validité du lien en heures
        define('DUREE_VALIDITE_LIEN', 1); // Par exemple, 1 heures
  
        // Calculer la date et l'heure d'expiration du lien
        $dateExpiration = date('Y-m-d H:i:s', strtotime($user['dateCreation'] . ' +' . DUREE_VALIDITE_LIEN . ' hours'));

        // Calculer la durée restante avant l'expiration du lien
        $dureeRestante = strtotime($dateExpiration) - strtotime('now');
        $dureeRestante = max(0, $dureeRestante); // Assurer que la durée restante ne soit pas négative
  
        // Convertir la durée restante en format lisible (heures, minutes, secondes)
        $heures = floor($dureeRestante / 3600);
        $minutes = floor(($dureeRestante % 3600) / 60);
        $secondes = $dureeRestante % 60;


        // Créer un lien avec la clé aléatoire
        $resetLink = "reset_password.php?key=" . $randomKey;

        // Afficher le lien de réinitialisation du mot de passe avec la durée restante
        echo "<br>";
        echo "Pour réinitialiser votre mot de passe, veuillez suivre ce lien : <a href='$resetLink'>Réinitialiser le mot de passe</a>.";
        echo "<br>";
        echo "Ce lien expirera dans $heures heures, $minutes minutes et $secondes secondes.";
      }
    }

  } ?>





  <!-- login de _SESSION -->
  <?php
  if (!isset($_SESSION['admin'])) { ?>
    <form method="POST" class="row">
      <div class="clo-12 col-md-3 mx-auto">
        <br><br><br>
        <h2 class="text-center">Connexion</h2>
        <input type="text" name="mail" class="form-control" value="dede@mail.fr" placeholder="Mail" autofocus>
        <input type="" name="pass" class="form-control" value="" placeholder="Password">
        <input type="submit" name="connectBtn" class="form-control">
      </div>
    </form>

    <!-- Button trigger modal -->
    <br>
    <button type="button" class="form-control w-auto mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Mot de passe perdu ?
    </button>


    <!-- Modal -->
    <form method="POST">
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmer votre address mail ?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" name="mail" class="form-control mb-2" value="dede@mail.fr" placeholder="Mail" autofocus>
              <button type="submit" name="passwordLost" class="btn btn-primary w-100">Envoyer</button>
            </div>
          </div>
        </div>
      </div>
    </form>




  <?php } else { ?>



    <!-- navbar top -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark text-light">
      <div class="container-fluid border-bottom">
        <a class="navbar-brand" href="#">DWWM SjSR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>


            <!-- <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li> -->


            <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li> -->


            <!-- offcanvas btn -->
            <form method="POST">
              <li class="nav-item pt-1">
                <button class="btn btn-dark" type="submit" name="deconnectBtn" data-bs-toggle="offcanvas"
                  data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                  <i class="bi bi-arrow-bar-left"></i>
                  <!-- <li><button type="submit" name="deconnectBtn" class="dropdown-item" > Logout </button></li> -->
                </button>
              </li>
            </form>
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


            </ul>
          </div>
        </div>
        <!-- sideBar left -->

        <!-- content -->
        <div class="col mt-5 py-3" style="overflow-y: scroll;height:90vh;">
          <?php

          // hash
          // $pass='123456';
          // $hash=password_hash($pass,PASSWORD_BCRYPT,['cost' => 13]);
          // echo $hash;
        

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


    <!-- fin du esle _SESSION -->


  <?php } ?>




  <?php
  try {
    $sql = "SELECT user_id FROM users";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(
      array(

      )
    );
  } catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
  }

  $usersNB = $stmt->rowCount();
  // echo 'il y a ' . $usersNB . ' users';
  
  ?>
  <?php
  try {
    $sql = "SELECT article_id FROM article";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(
      array(

      )
    );
  } catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
  }

  $articleNB = $stmt->rowCount();
  // echo 'il y a ' . $usersNB . ' article';
  
  ?>
  <?php
  try {
    $sql = "SELECT categorie_id FROM categorie";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(
      array(

      )
    );
  } catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
  }

  $name_catNB = $stmt->rowCount();
  // echo 'il y a ' . $usersNB . ' article';
  
  ?>

  <?php
  try {
    $sql = "SELECT recette_id FROM recette";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(
      array(

      )
    );
  } catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
  }

  $recette_catNB = $stmt->rowCount();
  // echo 'il y a ' . $usersNB . ' article';
  
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>

</html>