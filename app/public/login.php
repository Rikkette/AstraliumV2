<?php
include '../include/header.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$error_message = null;

// Traitement de la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = $_POST['users_email'];
    $password = $_POST['users_password'];

    // Recherche de l'utilisateur par email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE users_email = :login");
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification que l'utilisateur existe ET que le mot de passe est correct
    if ($user && $password === $user['users_password']) {

        // Récupère le rôle de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM type_role WHERE type_role_id = :type_role_id");

        $stmt->bindValue(':type_role_id', $user['type_role_id']);
        $stmt->execute();
        $type = $stmt->fetch(PDO::FETCH_ASSOC);

        // Stocker les informations en session
        $_SESSION['users_id'] = $user['users_id'];
        $_SESSION['logged_in'] = true;
        $_SESSION['type_libelle'] = $type['type_libelle'];

        echo "<script>window.location.href='index.php';</script>";
        exit();

    } else {
        // Email ou mot de passe incorrect
        $error_message = "Email ou mot de passe incorrect";
    }
}
?>

<!--------------------------------------------------------------->

<div class="container-connexion">
    <div class="login-box">
        <h2 class="title-connexion">Connexion</h2>

        <?php if ($error_message) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="form-connexion">

            <div class="textbox">
                <input type="text" name="users_email" placeholder="Email" id="email" class="input-connexion" autocomplete="on" required>
                <span id="email-error" class="error-message"></span>
            </div>

            <div class="textbox">
                <input type="password" name="users_password" placeholder="Mot de passe" id="users_password" class="input-connexion" required>
                <span id="password-error" class="error-message"></span>
            </div>

            <input type="submit" class="btn-connexion" value="Se connecter">

        </form>
    </div>
</div>

<?php include "../include/footer.php"; ?>