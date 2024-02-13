<?php
// Inclure le fichier de connexion à la base de données
include('connectDB.php');

// Initialiser la variable d'erreur de mot de passe
$passwordMessage = '';

if (isset($_POST['update'])) {
    // Vérifier si les mots de passe correspondent
    if ($_POST['pass'] !== $_POST['confirmPassword']) {
        // Si les mots de passe ne correspondent pas, définir le message d'erreur
        $passwordMessage = "<div class='text-danger'>Les mots de passe ne correspondent pas.</div>";
    } else {
        try {
            // Vérifier si l'adresse e-mail est définie
            if (isset($_POST['email'])) {
                $email = $_POST['email'];

                // Requête pour récupérer l'utilisateur avec l'adresse e-mail fournie
                $sql = "SELECT * FROM users WHERE mail = ?";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(array($email));

                // Vérifier si un utilisateur avec cet e-mail existe
                if ($stmt->rowCount() == 1) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    $randomKey = $user['randomKey'];

                    // Vérifier si les clés correspondent
                    if ($_GET['key'] === $randomKey) {
                        // Mettre à jour le mot de passe de l'utilisateur
                        $updateSql = "UPDATE users SET pass = ?, randomKey = NULL WHERE mail = ?";
                        $updateStmt = $bdd->prepare($updateSql);
                        $updateStmt->execute(array($_POST['pass'], $email));

                        // Afficher un message de succès si la mise à jour est réussie
                        $passwordMessage = "<div class='text-success'>Mot de passe mis à jour avec succès.</div>";
                    } else {
                        // Afficher un message d'erreur si la clé de réinitialisation est invalide
                        $passwordMessage = "<div class='text-danger'>Clé invalide pour la réinitialisation du mot de passe.</div>";
                    }
                } else {
                    // Afficher un message si aucun utilisateur n'est trouvé avec cet e-mail
                    $passwordMessage = "<div class='text-danger'>Aucun utilisateur trouvé avec cet e-mail.</div>";
                }
            } else {
                // Afficher un message si l'adresse e-mail n'est pas fournie
                $passwordMessage = "<div class='text-danger'>Veuillez fournir une adresse e-mail.</div>";
            }
        } catch (Exception $e) {
            // Gestion des exceptions s'il y a une erreur lors de l'exécution de la requête SQL
            $passwordMessage = "<div class='text-danger'>Erreur ! " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du Mot de Passe</title>
    <!-- Liens Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Réinitialisation du Mot de Passe</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Nouveau Mot de Passe</label>
                                <input type="password" class="form-control" id="newPassword" name="pass" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmer le Nouveau Mot de
                                    Passe</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                    required>
                                <!-- Message d'erreur ou de succès -->
                                <?php if (isset($passwordMessage)): ?>
                                    <div class="text-danger">
                                    <?php echo $passwordMessage; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Réinitialiser le Mot de
                                Passe</button>
                            <a href="index.php" class="btn btn-secondary">Revenir à la Page d'Accueil</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liens Bootstrap JS (optionnel, pour les fonctionnalités avancées) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>