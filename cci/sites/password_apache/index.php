  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>password_hash_form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/styles.css">
  </head>
  <body>

  <?php 
    if (isset($_POST['hashBtn'])) {
      $pass = strip_tags($_POST['pass']);
      // hash
        $hash=password_hash($pass,PASSWORD_BCRYPT,['cost' => 13]);

      echo 'pass:<br>'.$pass.'<hr>hash<br>'.$hash;

      echo '<hr>';
      // verify 
        if(password_verify($pass, $hash)) {
          echo 'OK';
        } 
        else {
            echo 'ERREUR';
        }
    }
  ?>
  <hr>
  <form method="POST">
    <input type="text" name="pass" placeholder="Mot de passe">
    <input type="submit" name="hashBtn" value="Hasher">
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
</body>
</html>