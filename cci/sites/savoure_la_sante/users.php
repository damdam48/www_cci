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
            
            <div class="col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2 border rounded m-5 ">
                <div class="card">
                    <div class="card-header">
                        <?php echo $results['name'] .' '. $results['first_name'];?>
                    </div>
                    <div class="card-body">
                        <?php echo $results['mail'];?>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?p=user.php&user_id=<?php echo $results['user_id']; ?>">Aller a la page</a>
                    </div>
                </div>
            </div>

    <?php }?>
</div>