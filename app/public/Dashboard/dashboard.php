<?php
include "../include/header.php";
?>


<!-------------------------- Formulaire de création d'un produit ----------------------------->
<div class="container my-5">
    <h1 class="mb-4">Création d'un produit</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-danger"><?= htmlentities($message) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <!--Ici j'ajoute une image pour illustrer le produit -->
            <label for="produit_image" class="form-label">Image du produit: </label>
            <input type="file" class="form-control" id="produit_image" name="produit_image" multiple required>
        </div>

        <div class="mb-3">
            <!--Nom du produit -->
            <label for="produit_nom" class="form-label">Nom du produit: </label>
            <input type="text" class="form-control" id="produit_nom" name="produit_nom" required>
        </div>

        <div class="mb-3">
            <!--Catégorie du produit -->
            <label for="categorie" class="form-label">Catégorie du produit: </label>
            <select name="categorie" class="form-select" id="categorie" required>
                <option value="">Sélectionner une catégorie</option>
                <?php foreach ($categories as $categorieValue): ?>
                    <option value="<?= htmlentities($categorieValue['categorie_id']) ?>">
                        <?= htmlentities($categorieValue['categorie_nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <!--Prix du produit -->
            <label for="produits_prix" class="form-label">Prix du produit (€): </label>
            <input type="number" step="0.01" class="form-control" id="produits_prix" name="produits_prix" required>
        </div>

        <div class="mb-3">
            <!--Description du produit -->
            <label for="produits_description" class="form-label">Description du produit: </label>
            <textarea class="form-control" id="produits_description" name="produits_description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <!--Promotions -->
            <label for="produits_promotions" class="form-label">Promotions: </label>
            <input type="text" class="form-control" id="produits_promotions" name="produits_promotions">
        </div>

        <div class="mb-3">
            <!--Quantité disponible -->
            <label for="produits_quantitees" class="form-label">Quantité disponible: </label>
            <input type="number" min="0" class="form-control" id="produits_quantitees" name="produits_quantitees" required>
        </div>

        <!--bouton pour soumettre le formulaire d'ajout de produit -->
        <button type="submit" class="btn btn-warning">Créer le produit</button>
        <a href="produits.php" class="btn btn-dark">Retour</a>
    </form>
</div>


<?php
include "../include/footer.php";
?>