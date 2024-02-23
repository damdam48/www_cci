session_start

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if (!empty($_POST))

    // si (if) le bouton est préssé
        if (isset($_POST['connect']))
        
    faire une requette select sur la zone cibler
        $sql="SELECT * FROM users WHERE mail = ? ";

    construire les resultats
        $resulta=$stmt->fetch(PDO::FETCH_ASSOC);


    faire une condition (if,else) sur le resultat construit
        if (empty($resulta))

        vérification du mail
        else { echo 'mail ok;

        vérification du mot de passe
            if ($resulta['pass'] == $_POST['pass']) {
                echo 'Pass ok';

                // Si le mot de passe est correct, sa initialise la session
                $_SESSION['user'] = 1;
        }

    bouton de déconnexion a été pressé
        else if (isset($_POST['deconnecter'])) {
                    // Supprimer la session 'user'
                    unset($_SESSION['user']);


    Vérifier si l'utilisateur n'est pas connecté
    <?php if (!isset($_SESSION['user'])) { ?>

    donner de la page .php de l'utisisateur (form)
    pour la connection
        <!-- Formulaire de connexion -->
        <form method="POST">
            <input type="text" name="mail" value="1@mail.fr" autofocus id=""><br>  
            <input type="submit" name="connect" value="Se connecter" id="">    
        </form>

    
    sinon
    et un autre (form) pour la déconnection

    else { ?>


        <!-- Formulaire de déconnexion -->
        <form method="POST">
            <!-- Bouton de soumission du formulaire pour la déconnexion avec le focus automatique -->
            <input type="submit" name="deconnecter" value="Se deconnecter" autofocus>
        </form>