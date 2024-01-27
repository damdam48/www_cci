<!-- Titre de la page -->
<h1 class="mt-4">Accueil</h1>

<?php
    print_r($_SESSION['admin']);
    echo '<br>';
    echo $_SESSION['admin']['nbConnect'];
?>
