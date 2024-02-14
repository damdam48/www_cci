<h1 id="sideBar-recettes" >Page des recettes</h1>
<hr>

<div class="row">

    <?php
        try { 
            $sql="SELECT * FROM recette";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
        // construct results
            while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                // var_dump($results);
                // echo '<br>'; ?>
            
            <div class="col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2 border rounded mx-auto">
                <div class="card">
                    <div class="card-header">
                        <?php echo $results['name'];?>
                    </div>
                    <div class="card-body my-auto">
                        <?php echo 'ID : ' . $results['recette_id'];?>
                        <hr>

                        <div>
                            <?php
                                // img si existe
                                // echo $results['img'];
                                $folder = 'img/recette/';
                                // print_r(getimagesize($folder . $results['img']));

                                if (@is_array(getimagesize($folder . $results['img']))) {
                                    // echo 'image OK';
                                    echo '<img src="'.$folder .$results['img']. '" class="w-75" alt=""> ';
                                }
                                else {
                                    // echo 'no image';
                                    echo '<img src="img/img_icon.png" class="w-50">';
                                }
                            ?>
                        </div>

                    </div>
                    <div class="card-footer">
                        <lu>
                            <li><a href="index.php?p=recette.php&recette_id=<?php echo $results['recette_id']; ?>">Aller a la page</a></li>
                            <hr>
                            <li><a href="index.php?p=recette_update.php&recette_id=<?php echo $results['recette_id']; ?>">Modifier la recette</a></li>
                        </lu>
                    </div>
                </div>
            </div>

    <?php }?>
</div>

