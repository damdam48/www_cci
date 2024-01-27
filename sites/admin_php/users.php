<div class="row">   
    <?php
        // Requête SELECT pour récupérer tous les utilisateurs de la table 'users'
        try {
            $sql = "SELECT * FROM users";
            $stmt = $bdd->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            // En cas d'erreur lors de l'exécution de la requête, afficher un message d'erreur
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }

        // Boucle while pour parcourir les résultats de la requête et afficher chaque utilisateur
        while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>






            <!-- Lien vers la page utilisateur avec l'ID de l'utilisateur en tant que paramètre -->
            <a href="index.php?p=user.php&user_id=<?php echo $users['users_id']; ?>" class="row col-12 col-sm-6 col-md-4 col-lg-3 my-2 mx-auto rounded border text-center">                                                   
                
                <div class="">
                    <div class="card border bg-primary text-white mx-auto mb-2 mt-2">
                        <div class="card-body">
                            <?php echo $users['first_name']. ' ' .$users['name'];?>
                            <br>
                            <img src="img/<?php echo $users['img'];?>" class="rounded mt-2" style="max-width: 40%; height: auto;">
                        </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                    </div>
                </div>
            <!-- Icône utilisateur -->
                <!-- <i class="fa fa-user"></i> -->
                
                <!-- Affichage du prénom et du nom de l'utilisateur -->
                
            </a>

        <?php } ?>
</div>
