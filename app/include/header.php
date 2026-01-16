<!----- Header qui regroupe la barre de recherche, la navbarre de naviagation, panier, traduction, connextion user/admin, newsletter,contacte marion ------>

<?php
//-----------------------------je lance la session ---------------------------

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// ------------------J'inclue le gestionnaire de langue------------------------------------
//include_once 'Trad_FR-En/gestionnaire_langue.php';

// -----------------------Configuration de la base de données-------------------------

$host = '127.0.0.1';
$dbname = 'astraliumv2';
$username = 'root';
$password = '';

//$conn = new mysqli($servername ,$username ,$password ,$dbname);

//if($conn->connect_error)(
//    die("erreur de connexion à la base de donnée : ". $conn->connect_error)
//)else {
 //   echo "connexion ok !"
//}

try {
  // ----------------------Connexion à la base de données------------------------------
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}

// -------------Vérifiez si l'utilisateur est connecté---------
$username = null;
if (isset($_SESSION['users_id'])) {
  $userId = $_SESSION['users_id'];

  // ------------Récupération des informations de l'utilisateur-------
  $sqlUser = "SELECT * FROM users WHERE users_id=:users_id";
  $stmtUser = $pdo->prepare($sqlUser);
  $stmtUser->execute(['users_id' => $userId]);
  $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    $username = $user['users_id'];
  }
}
$Admin = isset($_SESSION['type_libelle']) && in_array($_SESSION['type_libelle'], ['Admin']);
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;

// var_dump($_SESSION['type_libelle']); //(renvoie si je suis co comme admin ou non)

?>
<!---------------------------------------html--------------------------------------------->

<!DOCTYPE html>
<!--ici je lance une session pour choisir la langue ou renvoyer l'info-->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-------------------------- link bootstrap ---------------------------------------------->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="Style/style.css">

  <!--------------------- bibliothèque Javascript "Fancybox" ------------------------------------->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

  <!-------------------------- favicon Astralium --------------------------------------------------->
  <link rel="icon" type="image/png" sizes="32x32" href="/Style/logo/favicon_lune.png">
</head>

<!-------------------------- Drapeau langue EN & FR ------------------------->
<div class="langue-select">
  <div class="banniereHeader">
    <div class="drapeau">
      <a href="#"><img src="Style/logo/drapeau_en.png" width="40" height="30" alt="English" class="drapeau-img" style="cursor: pointer"></a>
      <a href="#"><img src="Style/logo/drapeau_fr.png" width="40" height="30" alt="Français" class="drapeau-img" style="cursor: pointer"></a>
    </div>
  </div>
</div>

<!-------------------------- caddie logo ------------------------->
<div class="caddie">
  <img src="Style/logo/sac_logo.png" width="150" height="80" alt="caddie logo" class="caddie-img" style="cursor: pointer;">
</div>
<!-------------------------- Nav bar bootstrap : barre de recherche ------------------------------>
<!-------------------------- ici je traduit la barre de recherche -------------------->
<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
  </form>
</nav>
<img src="Style/logo/banniere.header.png" class="banniere">
</div>

<!------------------------------ Nav Bar bootstrap :  ---------------------------->
<nav class="custom-nav">
  <nav class="navbar navbar-expand-lg navbar-lightbg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto">
        <!--Je traduit egalement les differents élèment de la barre de navigation -->
        <!--------------- Accueil ---------------->
        <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
        </li>
        <!--------------- Boutique --------------->
        <li class="nav-item">
          <a class="nav-link" href="produits.php">Boutique</a>
        </li>
        <!--------------- Portfolio -------------->
        <li class="nav-item">
          <a class="nav-link" href="portfolio.php">Portfolio</a>
        </li>
        <!---------------- A propos ---------------->
        <li class="nav-item">
          <a class="nav-link" href="apropos.php">Qui suis-je ?</a>
        </li>
        <!------------------- blog ----------------->
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
        <!----------------- newsletter --------------->
        <li class="nav-item">
          <a href="#" data-bs-toggle="modal" data-bs-target="#newsletterModal">Newsletter</a>
        </li>
        <!------------------------ Me contacter modale via bootstrap--------------->
        <li class="nav-item">
          <a href="#" data-bs-toggle="modal" data-bs-target="#contactModal"> Me contacter </a>
        </li>
        <!----->


        <!----------------- Bouton Connexion/Déconnexion ----->

        <?php if ($isLoggedIn && $Admin): ?>
          <li class="nav_item">
            <a href="produit-select.php" class="nav-link">ajouter produit</a>
          </li>
          <a href="logout.php" class="position"> Déconnexion</a>
        <?php else: ?>
          <a href="login.php" class="position"> Connexion </a>
        <?php endif; ?>
        </li>

      </ul>
    </div>
  </nav>
</nav>


<!----------------------------------- Modal : me contacter sur la barre de navigation via bootstrap ---------------------------------------->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactModalLabel"><?php echo isset($lang['contact_me']) ? $lang['contact_me'] : 'Me contacter'; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">

        <!--------------------- le formulaire de contact --------------------->
        <form>
          <!------------------- Le Nom ------------------------>
          <div class="mb-3">
            <label for="nom" class="form-label"><?php echo isset($lang['name']) ? $lang['name'] : 'Nom'; ?></label>
            <input type="text" class="form-control" id="nom">
          </div>
          <!-------------------- L'email ---------------------->
          <div class="mb-3">
            <label for="email" class="form-label"><?php echo isset($lang['email']) ? $lang['email'] : 'Email'; ?></label>
            <input type="email" class="form-control" id="email">
          </div>
          <!---------------------- Le Message --------------------->
          <div class="mb-3">
            <label for="message" class="form-label"><?php echo isset($lang['message']) ? $lang['message'] : 'Message'; ?></label>
            <textarea class="form-control" id="message" rows="3"></textarea>
          </div>

        </form>

      </div>
      <!-------------------- Bouton Fermer/Envoyer --------------------->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo isset($lang['close']) ? $lang['close'] : 'Fermer'; ?></button>
        <button type="button" class="btn btn-primary"><?php echo isset($lang['send']) ? $lang['send'] : 'Envoyer'; ?></button>
      </div>

    </div>
  </div>
</div>

<!----------------------------------- Modal : me Newsletter sur la barre de navigation via bootstrap ---------------------------------------->
<div class="modal fade" id="newsletterModal" tabindex="-1" aria-labelledby="newsletterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-----------------------------------titre de la modale + traduction -------------------------------------->
      <div class="modal-header">
        <h5 class="modal-title" id="newsletterModalLabel"><?php echo isset($lang['newsletter_signup']) ? $lang['newsletter_signup'] : 'Inscription à la newsletter'; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <div class="modal-body">
        <p><?php echo isset($lang['newsletter_text']) ? $lang['newsletter_text'] : 'Inscrivez-vous pour recevoir mes dernières actualités et créations.'; ?></p>

        <!------------------------------- Formulaire Newsletter --------------------------------------->
        <form>
          <!---------------------------------- Le Nom  + traduction------------------------------------------------->
          <div class="mb-3">
            <label for="newsletterNom" class="form-label"><?php echo isset($lang['name']) ? $lang['name'] : 'Nom'; ?></label>
            <input type="text" class="form-control" id="newsletterNom">
          </div>
          <!---------------------------------- L'email  + traduction-------------------------------------------------->
          <div class="mb-3">
            <label for="newsletterEmail" class="form-label"><?php echo isset($lang['email']) ? $lang['email'] : 'Email'; ?></label>
            <input type="email" class="form-control" id="newsletterEmail" required>
          </div>
          <!-------------- la check box pour accepter de recevoir les emails de newsletter  + traduction----------------->
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rgpdCheck" required>
            <label class="form-check-label" for="rgpdCheck"><?php echo isset($lang['privacy_policy']) ? $lang['privacy_policy'] : 'J\'accepte de recevoir la newsletter et j\'ai lu la politique de confidentialité'; ?></label>
          </div>

        </form>

      </div>
      <!--------- modal footer + traduction-------->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo isset($lang['cancel']) ? $lang['cancel'] : 'Annuler'; ?></button>
        <button type="button" class="btn btn-primary"><?php echo isset($lang['subscribe']) ? $lang['subscribe'] : 'S\'inscrire'; ?></button>
      </div>

    </div>
  </div>
</div>