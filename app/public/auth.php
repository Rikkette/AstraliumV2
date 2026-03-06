<?php
session_start();

function requireLogin($role = null) {
    if (!isset($_SESSION['logged_in'])) {
        header('Location: login.php');
        exit;
    }

    if ($role && $_SESSION['type_libelle'] !== $role) {
        header('Location: ../admin/unauthorized.php');
        exit;
    }
}