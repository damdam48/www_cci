<h1>Users</h1>

<div class="row">

    <?php
        try { 
            $sql="SELECT * FROM users";
            $stmt = $bdd->prepare($sql);
            $stmt->execute( array(

            ) );
            } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
        
        // construct results
            while($results=$stmt->fetch(PDO::FETCH_ASSOC)) {
                // var_dump($results);
                // echo '<br>'; ?>
            
            <div class="col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2 border rounded ">
                <div class="card">
                    <div class="card-header">
                        <?php echo $results['name'] .' '. $results['first_name'];?>
                    </div>
                    <div class="card-body my-auto">
                        <?php echo $results['mail'];?>
                        <hr>

                        <div>
                            <?php
                                // img si existe
                                // echo $results['img'];
                                $folder = 'img/users/';
                                // print_r(getimagesize($folder . $results['img']));

                                if (@is_array(getimagesize($folder . $results['img']))) {
                                    // echo 'image OK';
                                    echo '<img src="'.$folder .$results['img']. '" class="w-75" alt=""> ';
                                    echo getimagesize($folder . $results['img'])[0];
                                    echo 'X';
                                    echo getimagesize($folder . $results['img'])[0].' px';


                                }
                                else {
                                    // echo 'no image';
                                    echo '<img src="img/img_icon.png" class="w-75">';
                                }
                            ?>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="index.php?p=user.php&user_id=<?php echo $results['user_id']; ?>">Aller a la page</a>
                    </div>
                </div>
            </div>

    <?php }?>
</div>

