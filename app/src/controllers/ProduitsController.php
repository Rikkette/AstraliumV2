<?php

// Gère l'affichage et les actions liées aux catégories
require_once __DIR__ . '/../models/CategorieClass.php';
require_once __DIR__ . '/../models/Promotions.php'; // j'inclue le modèle Promotion

class CategorieController
{
    private $categorie;

    public function __construct()
    {
        $this->categorie = new Categorie();
    }

    // Afficher toutes les catégories ----------------------------------
    public function getAllCategories()
    {
        $categories = $this->categorie->getAllCategories();

        if ($categories) {
       //     include __DIR__ . '/../views/categorie/allCategories.php';
        } else {
            $message = "Aucune catégorie trouvée";
       //     include __DIR__ . '/../views/categorie/allCategories.php';
        }
    }

    // Afficher une catégorie par son slug---------------------------------
    public function showCategorie($slug)
    {
        $categorie = $this->categorie->getCategorieBySlug($slug);

        if (!$categorie) {
            echo "Catégorie non trouvée.";
            return;
        }

        require_once __DIR__ . '/../views/categorie/showCategorie.php';
    }

    // Afficher une catégorie par son ID------------------------------------
    public function getCategorieById($categorie_id)
    {
        $categorie = $this->categorie->getCategorieById($categorie_id);
        return $categorie;
    }

    // Méthode pour sauvegarder une catégorie (création ou mise à jour)----------
    public function saveCategorie()
    {
        $errors = $this->validateCategorieData($_POST);


        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;

            // Arrêter l'exécution du script après la redirection
            if (isset($_POST['categorie_id'])) {
                header("Location: index.php?action=manageCategorie&slug=" . urlencode($_POST['categorie_slug']));
                exit();
            } else {
                header("Location: index.php?action=manageCategorie");
                exit();
            }
        }

        // Vérification si c'est une mise à jour ou un ajout
        if (isset($_POST['categorie_id']) && !empty($_POST['categorie_id'])) {
            // Mise à jour d'une catégorie existante
            $categorie_id = $_POST['categorie_id'];
            $data = $_POST;
            $this->update($categorie_id, $data);
            $_SESSION['message'] = "Catégorie mise à jour avec succès";
            header("Location: index.php?action=manageCategorie&slug=" . urlencode($data['categorie_slug']));
            exit();
        } else {
            // Ajout d'une nouvelle catégorie
            $data = $_POST;
            $this->create($data);
            $_SESSION['message'] = "Catégorie ajoutée avec succès";
            header("Location: index.php?action=allCategories");
            exit();
        }
    }

    // Validation des données de la catégorie
    private function validateCategorieData($data)
    {
        $errors = [];

        // Validation du nom de la catégorie
        if (empty($data['categorie_nom'])) {
            $errors['categorie_nom'] = "Le nom de la catégorie est obligatoire";
        }

        return $errors;
    }


    // Méthode pour ajouter une catégorie
    public function create($data)
    {
        $this->categorie->set_categorie_nom($data['categorie_nom']);

        // Ajout de la promotion si présente et non vide
        if (!empty($data['promotions_id'])) {
            $this->categorie->set_promotions_id($data['promotions_id']);
        } else {
            $this->categorie->set_promotions_id(null);
        }


        // Le slug sera généré automatiquement par le setter
        return $this->categorie->insertCategorie();
    }

    public function update($categorie_id, $data)
    {
        $this->categorie->set_categorie_id($categorie_id);
        $this->categorie->set_categorie_nom($data['categorie_nom']);

        // Ajout de la promotion si présente et non vide
        if (!empty($data['promotions_id'])) {
            $this->categorie->set_promotions_id($data['promotions_id']);
        } else {
            $this->categorie->set_promotions_id(null);
        }


        // Le slug sera généré automatiquement par le setter
        return $this->categorie->updateCategorie();
    }


    // Suppression d'une catégorie
    public function delete($categorie_id)
    {
        $this->categorie->set_categorie_id($categorie_id);
        $this->categorie->deleteCategorie();
        $_SESSION['message'] = "Catégorie supprimée avec succès";
        header("Location: index.php?action=allCategories");
        exit();
    }

    // Gère la modification ou la création d'une catégorie
    public function manageCategorie($categorie_slug = null)
    {
        // Vérification des permissions
        $isAdmin = isset($_SESSION['type_libelle']) && $_SESSION['type_libelle'] === 'admin';
        $isAdmin = $isAdmin;

        // Gestion des erreurs de formulaire
        $errors = $_SESSION['errors'] ?? [];
        $formData = $_SESSION['form_data'] ?? [];
        unset($_SESSION['errors'], $_SESSION['form_data']);

        // Récupération de la catégorie
        if ($categorie_slug) {
            $categorieData = $this->categorie->getCategorieBySlug($categorie_slug);
            $viewTitle = $isAdmin ? "Modifier la catégorie" : "Voir la catégorie";
        } else {
            $categorieData = new Categorie();
            $viewTitle = "Ajouter une catégorie";

            // Pré-remplir avec les données du formulaire précédent en cas d'erreur
            if (!empty($formData)) {
                $categorieData->hydrate($formData);
            }
        }


        // Récupération de toutes les promotions pour le formulaire
        $promotion = new Promotions; // Assurez-vous d'avoir créé ce modèle
        $promotions = $promotion->getAllPromotions();


        // Récupération du message de la session
        $message = $_SESSION['message'] ?? '';
        unset($_SESSION['message']);

        // Appel de la vue
        include 'app/views/categorie/categorieForm.php';
    }
}
?>