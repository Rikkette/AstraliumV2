<?php
session_start();

function requireLogin($role = null) {
    if (!isset($_SESSION['logged_in'])) {
        header('Location: login.php'); // à la connexion automatiquement rediriger grace au fichier login qui integre la redirection 
        exit;
    }

    if ($role && $_SESSION['type_libelle'] !== $role) {
        header('Location: ../admin/unauthorized.php'); // a modifier plus tard 
        exit;
    }
} 