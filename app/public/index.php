<!----------- Page d'acceuil du site présentation des dernieres nouveautés mise dans le shop, -------->

<?php include "../include/header.php"
?>

<!--------- banniere d'agrement pour illustré la page d'acceuil ---------->

    <div class="banniere-container">
        <div>
            <img src="/app/image/banniere_index.png" class="banniere_index">
        </div>
    </div>

    <!-----------Partie PHP Select * from pour afficher les dernier produits mis sur le site -------->
    <?php
    $sql = "SELECT p.* , media_libelle 
    FROM produits p inner join media m on p.produits_id =m.produits_id
    ORDER BY produits_id 
    DESC LIMIT 4";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $derniers_produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump ($derniers_produits);
    // echo "</pre>";

    ?>

    <!----------------------- partie bootstrap pour afficher les produit sur la page d'accueil --------------------------->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="mb-4">Nos dernières nouveautés</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($derniers_produits as $produit): ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- image du Produit -->
                            <img class="card-img-top" src="uploads/<?= $produit['media_libelle'] ?>" alt="Photo du produit" />

                            <!-- détail du Produit -->
                            <div class="card-body m-4">
                                <div class="text-center">
                                    <!-- nom du Produit -->
                                    <h5 class="fw-bolder"><?= htmlentities($produit['produits_nom']) ?></h5>
                                    <hr>
                                    <!-- Prix du Produit -->
                                    <?= number_format($produit['produits_prix'], 2) ?> €
                                </div>
                            </div>

                            <!-- Product actions -->
                            <div class="card-footer m-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="produit-details.php?id=<?= htmlentities($produit['produits_id']) ?>">En savoir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!--------- cette partie et relier a un bouton qui renvoie vers la boutique ---------->
            <div class="text-center mt-4">
                <a class="btn btn-primary" href="produits.php">Voir tous nos produits</a>
            </div>

        </div>
    </section>

<?php
    include "../include/footer.php";
    ?>
