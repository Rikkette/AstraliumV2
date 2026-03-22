<div class ="container my-3">
    <h3 class ="mb-3">
        All produits
    </h3>
    
<!-- Liste des produits -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
        <?php if (isset($message)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($produits) && is_array($produits) && count($produits) > 0): ?>
            <?php foreach ($produits as $product): ?>
                <div class="col">
                    <a href="index.php?action=showProduit&slug=<?= urlencode($product->get_prod_slug()) ?>" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            <img src="../../../public/images/Bw-logo.webp" class="card-img-top p-2" style="max-height: 120px; object-fit: contain;">
                            <div class="card-body p-2">
                                <h6 class="card-title"><?= htmlentities($product->get_prod_libelle()) ?></h6>
                                <p class="card-text small mb-1"><?= substr(htmlentities($product->get_prod_description()), 0, 60) ?>...</p>
                                <p class="card-text fw-bold mb-2"><?= number_format($product->get_prod_prix(), 2, ',', ' ') ?> €</p>
<form method='POST' action='panier.php' class='add-to-cart-form' data-slug="<?= $product->get_prod_slug() ?>"
                                    data-libelle="<?= htmlentities($product->get_prod_libelle()) ?>"
                                    data-prix="<?= $product->get_prod_prix() ?>">
                                    <input type='hidden' name='action' value='ajouter'>
                                    <input type='hidden' name='libelle' value="<?= $product->get_prod_libelle() ?>">
                                    <input type='hidden' name='prix' value="<?= $product->get_prod_prix() ?>">
                                    <button type='submit' class='btn btn-primary btn-sm w-100'>Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Aucun produit trouvé.
            </div>
        <?php endif; ?>
    </div>
</div>





<?php

?>