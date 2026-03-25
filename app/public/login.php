<?php
ob_start();
session_start();

//relie la page a config & user controller au header
require_once '/var/www/require/config.php';
require_once ROOT_PATH . 'app/controllers/UsersController.php';
include '../include/header.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller = new UserController();

    $login = htmlspecialchars($_POST['users_email']);
    $password = $_POST['users_password'];

    $result = $controller->login($login, $password);

    if ($result === true) {
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Email ou mot de passe incorrect";
    }
}
?>

<!---------------------- formulaire de connexion ----------------------------------------->

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
                <input type="email" name="users_email" placeholder="Email" id="email" class="input-connexion" autocomplete="on" required>
                <span id="email-error" class="error-message"></span>
            </div>

            <div class="textbox">
                <input type="password" autocomplete="current-password" name="users_password" placeholder="Mot de passe" id="users_password" class="input-connexion" required>
                <span id="password-error" class="error-message"></span>
            </div>
               <!----Mettre du JS pour que les span id fonctionnent sinon inutile --->
            <input type="submit" class="btn-connexion" value="Se connecter">

        </form>
    </div>
</div>

<?php ob_end_flush();
include "../include/footer.php"; ?>