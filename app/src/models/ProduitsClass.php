<?php

// Gère les données et la logique liée aux produits

require_once 'dao.php';
class Produit
{
    private $dao;
    private $produits_id;
    private $produits_nom;
    private $produits_description;
    private $produits_libelle;
    private $produits_prix;
    private $produits_promotions;
    private $produits_quantitees;
    private $produits_date;
    private $produits_slug;
    private $categorie_id;
    private $promotions_id;
    private $coupon_id;



    public function __construct($data = null)
    {
        $this->dao = new DAO("localhost", "AstraliumV2");

        if ($data !== null) {
            $this->hydrate($data);
        }
    }

    public function hydrate($data)
    {
        if ($data !== null) {
            foreach ($data as $key => $value) {
                $method = 'set_' . $key;
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }
        return $this;
    }


    // Getters --------------------------------------

    //Produits ID
    public function get_produits_id()
    {
        return $this->produits_id;
    }

    //Produits Nom
    public function get_produits_nom()
    {
        return $this->produits_nom;
    }

    //Produits Description
    public function get_produits_description()
    {
        return $this->produits_description;
    }

    //Produits Libelle
    public function get_produits_libelle()
    {
        return $this->produits_libelle;
    }

    //Produits Prix
    public function get_produits_prix()
    {
        return $this->produits_prix;
    }

    //Produits Promotions
    public function get_produits_promotions()
    {
        return $this->produits_promotions;
    }

    //Produits Quantitees
    public function get_produits_quantitees()
    {
        return $this->produits_quantitees;
    }

    //Produits Date
    public function get_produits_date()
    {
        return $this->produits_date;
    }

    //Produits Slug
    public function get_produits_slug()
    {
        return $this->produits_slug;
    }

    //Categorie ID
    public function get_categorie_id()
    {
        return $this->categorie_id;
    }

    //Promotion ID
    public function get_promotions_id()
    {
        return $this->promotions_id;
    }

    //Coupon ID
    public function get_coupon_id()
    {
        return $this->coupon_id;
    }


    // Setters ------------------------------------

    //produit ID
    public function set_produits_id($produits_id)
    {
        $this->produits_id = $produits_id;
    }

    //Produit Nom
    public function set_produits_nom($produits_nom)
    {
        $this->produits_nom = $produits_nom;
    }

    //Produit Description
    public function set_produits_description($produits_description)
    {
        $this->produits_description = $produits_description;
    }

     //Produit Description
    public function set_produits_libelle($produits_libelle)
    {
        $this->produits_libelle = $produits_libelle;
    }

    //Produit Prix
    public function set_produits_prix($produits_prix)
    {
        $this->produits_prix = $produits_prix;
    }

    //Produit Promotions
    public function set_produits_promotions($produits_promotions)
    {
        $this->produits_promotions = $produits_promotions;
    }

    //Produit Quantitees
    public function set_produits_quantitees($produits_quantitees)
    {
        $this->produits_quantitees = $produits_quantitees;
    }

    //Produit Date
    public function set_produits_date($produits_date)
    {
        $this->produits_date = $produits_date;
    }

    //Produit Slug
    public function set_produits_slug($produits_slug)
    {
        $this->produits_slug = $produits_slug;
    }

    // Categorie ID
    public function set_categorie_id($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }

    //Promotio,n ID
    public function set_promotions_id($promotions_id)
    {
        $this->promotions_id = $promotions_id;
    }

    //Coupon ID
    public function set_coupon_id($coupon_id)
    {
        $this->coupon_id = $coupon_id;
    }

    //Fonction ----------------------------------------------------------------

    public function getProduitById($produits_id)
    {
        $params = array('produits_id' => $produits_id);
        $results = $this->dao->select("produits", "produits_id = :produits_id", $params)[0] ?? null;

        if ($results) {
            return new Produit($results);
        }
        return null;
    }

    public function getProduitBySlug($produits_slug)
    {
        $params = array('produits_slug' => $produits_slug);
        $results = $this->dao->select("produits", "produits_slug = :produits_slug", $params)[0] ?? null;

        if ($results) {
            return new Produit($results);
        }
        return null;
    }


    public function countProduits()
    {
        $result = $this->dao->select("produits", '', [], '', '', '', 'COUNT(*) as total');
        return $result[0]['total'] ?? 0;
    }


    public function getAllProduits()
    {
        $results = $this->dao->select("produits");

        $produits = [];
        foreach ($results as $result) {
            $produits[] = new Produit($result);
        }

        return $produits;
    }

    // recherche de produit 
    public function getProduitsForSearch($search)
    {
        $params = array(':search' => "%$search%");
        return $this->dao->select("produits", "produits_libelle LIKE :search", $params);
    }

    public function getAllPromotions()
    {
        $results = $this->dao->select("promotions");

        $promotions = [];
        foreach ($results as $result) {
            $promotion = new Promotions();
            $promotion->set_promotions_id($result['promotions_id']);
            $promotions[] = $promotion;
        }

        return $promotions;
    }


    public function insertProduit()
    {
        $values = array(
            'produits_nom' => $this->produits_nom,
            'produits_libelle' => $this->produits_libelle,
            'produits_slug' => $this->produits_slug,
            'produits_description' => $this->produits_description,
            'produits_prix' => $this->produits_prix,
            'produits_quantitees' => $this->produits_quantitees,
            'promotions_id' => $this->promotions_id,
            'categorie_id' => $this->categorie_id,
            'coupon_id' => $this->coupon_id,
        );
        return $this->dao->insert("produits", $values);
    }


    public function updateProduit()
    {
        $data = array(
          'produits_nom' => $this->produits_nom,
            'produits_libelle' => $this->produits_libelle,
            'produits_slug' => $this->produits_slug,
            'produits_description' => $this->produits_description,
            'produits_prix' => $this->produits_prix,
            'produits_quantitees' => $this->produits_quantitees,
            'promotions_id' => $this->promotions_id,
            'categorie_id' => $this->categorie_id,
            'coupon_id' => $this->coupon_id,
        );

        $where = 'produits_id = ?';
        $params = [$this->produits_id];
        return $this->dao->update("produits", $data, $where, $params);
    }


    public function deleteProduit()
    {
        $where = 'produits_id = ?';
        $params = [$this->produits_id];
        return $this->dao->delete("produits", $where, $params);
    }
}
