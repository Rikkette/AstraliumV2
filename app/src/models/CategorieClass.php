<?php

require_once 'dao.php';

class CategorieClass
{
    private $dao;
    private $categorie_slug; // (categorie slug) représentation textuelle simplifiée d'une ressource dans l'url pour créer des liens propres.
    private $categorie_nom; // (categorie nom)

    // id de la bdd
    private $blog_id;
    private $media_id;
    private $categorie_id;
    private $produits_id;

    // les promos
    private $coupon_id;
    private $promotions_id;

    public function __construct($data = null)
    {
        $this->dao = new DAO("localhost", "AstraliumV2");

        if ($data !== null) {
            $this->hydrate($data); // j'utilise Hydrate pour remplir un objet avec des données de bdd
        }
    }
    public function hydrate($data)
    {
        if ($data !== null) {
            foreach ($data as $key => $value) {   //boucle qui parcour mon tableau
                $method = 'set_' . $key;
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }
        return $this;
    }



    //Getter--------------------------------------------------------------
    //retourne la valeur d'une variable d'un champ privé.

    //Categorie ID
    public function get_categorie_id()
    {
        return $this->categorie_id;
    }
    //Produit ID
    public function get_produits_id()
    {
        return $this->produits_id;
    }
    //Media ID
    public function get_media_id()
    {
        return $this->media_id;
    }
    //Blog ID
    public function get_blog_id()
    {
        return $this->blog_id;
    }
    //Categorie Slug
    public function get_categorie_slug()
    {
        return $this->categorie_slug;
    }
    //Categorie Nom
    public function get_categorie_nom()
    {
        return $this->categorie_nom;
    }
    //Coupon ID
    public function get_coupon_id()
    {
        return $this->coupon_id;
    }
    //Promotion ID
    public function get_promotions_id()
    {
        return $this->promotions_id;
    }


    //Setters------------------------------------------------------------- 
    //modifie la valeur d'une variable de champ privé.

    //Categorie ID
    public function set_categorie_id($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }

    //Produit ID
    public function set_produits_id($produits_id)
    {
        $this->produits_id = $produits_id;
    }

    //Media ID
    public function set_media_id($media_id)
    {
        $this->media_id = $media_id;
    }

    //Blog ID
    public function set_blog_id($blog_id)
    {
        $this->blog_id = $blog_id;
    }

    //Categorie Slug
    public function set_categorie_slug($categorie_slug)
    {
        $this->categorie_slug = $categorie_slug;
    }

    //Categorie Nom
    public function set_categorie_nom($categorie_nom)
    {
        $this->categorie_nom = $categorie_nom;
    }

    //Coupon ID
    public function set_coupon_id($coupon_id)
    {
        $this->coupon_id = $coupon_id;
    }

    //Promotion ID
    public function set_promotions_id($promotions_id)
    {
        $this->promotions_id = $promotions_id;
    }


    // Méthode de génération de slug--------------------------------------------
    public function generateSlug($string)
    {
        $string = trim($string);
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9-]/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }


    // Récupérer toutes les catégories-------------------------------------------
    public function getAllCategories($search = '')
    {
        $params = array();
        if (!empty($search)) {
            $params = array(':categorie_slug' => $search);
            $categories = $this->dao->select("categorie", "categorie_slug = :categorie_slug", $params, "categorie_nom");
        } else {
            $categories = $this->dao->select("categorie", "", $params, "categorie_nom");
        }


        // Convertir chaque entrée en objet Categorie----------------------------
        $categorieObjects = [];
        foreach ($categories as $categorieData) {
            $categorieObjects[] = new CategorieClass($categorieData);
        }

        return $categorieObjects;
    }

    public function countCategories()
    {
        $result = $this->dao->select("categorie", '', [], '', '', '', 'COUNT(*) as total');
        return $result[0]['total'] ?? 0;
    }

    // Récupérer une catégorie par son ID---------------------------------------
    public function getCategorieById($categorie_id)
    {
        $params = array('categorie_id' => $categorie_id);
        $results = $this->dao->select(
            "categorie",
            "categorie_id = :categorie_id",
            $params
        )[0] ?? null;

        if ($results) {
            return new CategorieClass($results);
        }
        return null;
    }

    // Récupérer une catégorie par son slug-------------------------------------
    public function getCategorieBySlug($categorie_slug)
    {
        $params = array('categorie_slug' => $categorie_slug);
        $results = $this->dao->select(
            "categorie",
            "categorie_slug = :categorie_slug",
            $params
        )[0] ?? null;

        if ($results) {
            return new CategorieClass($results);
        }
        return null;
    }

    // Insérer une nouvelle catégorie----------------------------------
    public function insertCategorie()
    {
        $values = array(
            'categorie_nom' => $this->categorie_nom,
            'categorie_slug' => $this->categorie_slug,
            'promo_id' => $this->promotions_id,
            'coupon_id' => $this->coupon_id,
        );

        return $this->dao->insert("categorie", $values);
    }

    // Mettre à jour une catégorie------------------------------------------
    public function updateCategorie()
    {
        $data = array(
            'categorie_nom' => $this->categorie_nom,
            'categorie_slug' => $this->categorie_slug,
            'promo_id' => $this->promotions_id,
            'coupon_id' => $this->coupon_id,
        );

        $where = 'categorie_id = ?';
        $params = [$this->categorie_id];

        return $this->dao->update("categorie", $data, $where, $params);
    }

    // Supprimer une catégorie-------------------------------------------------
    public function deleteCategorie()
    {
        $where = 'categorie_id = ?';
        $params = [$this->categorie_id];
        return $this->dao->delete("categorie", $where, $params);
    }
}
