<?php
session_start();
session_destroy();

header("Location: index.php");
exit;

// logout simple, il detruit la session, et deconnecte et renvoie vers l'index 