<h3>
	Carousel 
</h3>
<p>
	Ajouter, supprimer les images du carousel
</p>


<?php

		
				try
				{    
				$bdd = new PDO("mysql:host=localhost;dbname=savourer_la_sante_alpha", "root", "");
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				catch(Exception $e) {
				die($erreur_sql='Erreur connect bd: '.$e->getMessage());
				}
				
				// control si ya erreur a la connection de la base
					if (isset($erreur_sql)) {
				echo $erreur_sql;
			}







	$path='../public/images/img/carousel/';

	if (isset($_POST['update'])) {
		$nb = 0;
		// print_r($_POST); 
		foreach ($_POST as $key => $value) {
			// echo $key . ' > '. $value . '<br>'; 

				// START UNLINK IMG
					// if key contain 'checkbox_' so... 
						if (strstr($key, 'checkbox_')) {
							// echo 'OK checkbox_ ' . $key . ' ' . $value . '<br>'; 
							// echo 'Remove ' . $_POST['img_' . $value] . '<br>';
							$nb++;
							// unlink($_POST['img_' . $value]);
						}
				// END UNLINK IMG

				// START HIDE IMG 


				// echo $key . ' ' . $value . '<br>';

				// if it is an images (POST img_)

					if (strstr($key, 'img_' )) {
						// echo 'ok img '.$key.'<br>';

					

						$id = str_replace('img_', '', $key); 
						// echo 'ID : '.$id.'<br>';
					
					 	if (isset($_POST['imgShow_' . $id])) {
							// echo 'Ok check '.$id . '<br>';
							//  echo 'state = 1 <br>';
							 $state = 1;


						}
					
						else {
							// echo 'checkbox '.$id . ' No exist <br>';
							// echo 'state = 0 <br>';

							$state = 0;

						}
						try { 
							$sql="UPDATE carousel SET state = ? WHERE id = ?";
							$stmt = $bdd->prepare($sql);
							$stmt->execute(array(
								$state,
								$id
							));
							} catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

					}
					// }

					// if key containt 'img_'  img_1, img_2
						//  > retreive id 

							// if checkbox_ id exist 

								// UPDATE carousel SET state 1 WHERE id = ?

							// else 
								// UPDATE carousel SET state 0 WHERE id = ?




				// HIDE IMG 
		} 
		$nb==0?$neg='n\'':$neg='';
		$nb==0?$nb='aucune':''; 
		echo '<p class="mt-3">Vous '.$neg.'avez supprimé ' . $nb . ' image';
		echo ($nb!='aucune' && $nb>1)?'s':'';echo '</p>';
	} 
	?>
	<hr>From Table carousel<br>
		<form method="POST" class="row">
			<?php 
			// carousel 	
				try { 
			    $sql="SELECT * FROM carousel";
			    $stmt = $bdd->prepare($sql);
			    $stmt->execute(array());
				} catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}

				while ($carousel=$stmt->fetch(PDO::FETCH_ASSOC)) {
					// print_r($carousel);echo '<br>'; ?>

					<div class="col-3 border rounded p-3 mx-auto"> 
						<img src="<?php echo $path. $carousel['name'];?>" class="w-100 mb-3" >
						id : <?php echo $carousel['id'];?>
						<input type="hidden" name="img_<?php echo $carousel['id'];?>" value="<?php echo $carousel['name'];?>">

						<input type="checkbox" id="img_<?php echo $carousel['id'];?>" class="checkbox d-none" value="<?php echo $carousel['id'];?>" name="checkbox_<?php echo $carousel['id'];?>">
						State : <?php echo $carousel['state'];?>
						<label class="float-start" for="img_<?php echo $carousel['id'];?>">
							<i class="bi bi-trash fs-5"></i>
						</label>

						<input type="checkbox" id="imgShow_<?php echo $carousel['id'];?>" class="checkbox_show" value="<?php echo $carousel['id'];?>" name="imgShow_<?php echo $carousel['id'];?>" <?php echo $carousel['state']?'checked':'';?>>

						<label class="float-end" for="imgShow_<?php echo $carousel['id'];?>">
							<i class="bi bi-eye fs-5"></i>
						</label>

					</div>
				<?php } ?>
			<div class="col-12">
				<input type="submit" name="update" value="Enregistrer les modifications" class="form-control bg-dark text-light w-auto mx-auto">
			</div>
		</form>

<?php 
	// die();
?>


<form method="POST" class="row">
	<?php 
	$img = glob('../img/*');
	print_r($img); echo '<br>';

	foreach ($img as $key => $value) { 
		// echo $key . ' => ' . $value.'<br>';
		// print_r(filesize($value));
		?>
		<div class="col-3 border rounded p-3 mx-auto">
			<img src="<?php echo $value;?>" class="w-100 mb-3" >
			
			<input type="hidden" name="img_<?php echo $key;?>" value="<?php echo $value;?>">

			<input type="checkbox" id="img_<?php echo $key;?>" class="checkbox d-none" value="<?php echo $key;?>" name="checkbox_<?php echo $key;?>">

			<label class="" for="img_<?php echo $key;?>">
				<i class="bi bi-trash fs-5"></i>
			</label>

		</div>
	<?php } ?>		

	<div class="col-12">
		<input type="submit" name="update" value="Enregistrer les modifications" class="form-control bg-dark text-light w-auto mx-auto">
	</div>	
</form>







	<form class="row" method="POST">
		
		<!-- boucle -->
			<div class="col-3">
				<img src="">
				<input type="checkbox" name="">
				<input type="checkbox" name="">
			</div>
		<!-- boucle -->

			<div class="col-3">
				<input type="submit" name="">
			</div>

	</form>






























<?php die();?>
<div class="row">
	<div class="col-7 mx-auto">
		<div id="carouselExample" class="carousel slide border">
		  <div class="carousel-inner">
		  	<?php foreach ($img as $key => $value) { ?>
		    <div class="carousel-item <?php echo $key==0?'active':'';?>">
		      <img src="<?php echo $value;?>" class="d-block w-100" alt="..." style="height: 300px;">
		    </div>
		  	<?php } ?> src="..." class="d-block w-100" alt="...">	
		    </div>
		</div>
		  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="visually-hidden">Previous</span>
		  </button>
		  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="visually-hidden">Next</span>
		  </button>
	</div>
</div>
