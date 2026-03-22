<?php 
include '../../../include/header.php';
require_once '../models/CategorieClass.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($message)): ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Liste des Catégories</h2>
                    <a href="index.php?action=manageCategorie" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter une Catégorie
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($categories)): ?>
                                <tr>
                                    <td colspan="4" class="text-center">Aucune catégorie trouvée</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($category->get_categorie_id()) ?></td>
                                        <td><?= htmlspecialchars($category->get_categorie_nom()) ?></td>
                                        <td><?= htmlspecialchars($category->get_categorie_slug()) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="index.php?action=showCategorie&slug=<?= urlencode($category->get_categorie_slug()) ?>" class="btn btn-sm btn-info">
                                                    Voir
                                                </a>
                                                <a href="../index.php?action=manageCategorie" class="nav-link" id="ajouter-categorie-link"><i class="fas fa-plus"></i> Ajouter une catégorie</a>
                                                <a>
                                                    href="index.php?action=manageCategorie&slug=<?= urlencode($category->get_categorie_slug()) ?>" class="btn btn-sm btn-warning">
                                                    Modifier
                                                </a>
                                                <button onclick="confirmDelete(<?= $category->get_categorie_id() ?>)" class="btn btn-sm btn-danger">
                                                    Supprimer
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-3 text-center">
    <a href="<?php echo BASE_URL; ?>/public/dashboard/dashboard.php" class="btn btn-secondary">
        Retour au tableau de bord
    </a>
</div>

<script>
    function confirmDelete(categorieId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')) {
            window.location.href = 'index.php?action=deleteCategorie&categorie_id=' + categorieId;
        }
    }
</script>

