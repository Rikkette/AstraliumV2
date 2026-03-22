<?php 
ob_start();

include "../include/header.php";
require_once "src/controllers/ProduitsController.php";

// Vérification de l'action dans l'URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
// ACTIONS CATEGORIES
        case 'allCategories':
            $categorieController = new CategorieController();
            $categorieController->getAllCategories();
            break;
        case 'showCategorie':
            $slug = $_GET['slug'] ?? null;
            $categorieController = new CategorieController();
            $categorieController->showCategorie($slug);
            break;
        case 'manageCategorie':
            $slug = isset($_GET['slug']) ? $_GET['slug'] : null;
            $categorieController = new CategorieController();
            $categorieController->manageCategorie($slug);
            break;
        case 'saveCategorie':
            $categorieController = new CategorieController();
            $categorieController->saveCategorie();
            break;
        case 'deleteCategorie':
            $categorie_id = $_GET['categorie_id'] ?? null;
            $categorieController = new CategorieController();
            $categorieController->delete($categorie_id);
            break;
            
            }
            }