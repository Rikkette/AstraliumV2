<?php
session_start();
session_destroy();

header("Location: index.php");
exit;

// logout simple on detruit la session, faut pas voir plus loin, on deconnecte et on renvoie vers l'index 