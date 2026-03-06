<?php
ob_start();
require_once('../app/controllers/UsersController.php');
include '../include/header.php';
if (session_status() == PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$error_message = '';

// Traitement de la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller=new UserController();

    $login = $_POST['users_email'];
    $password = $_POST['users_password'];

    $error= $controller->login($login,$password);

        var_dump($type);
        die();

        echo "<script>window.location.href='index.php';</script>";
        exit();

    } else {
        // Email ou mot de passe incorrect
        $error_message = "Email ou mot de passe incorrect";
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

<?php ob_end_flush();
include "../include/footer.php"; ?>