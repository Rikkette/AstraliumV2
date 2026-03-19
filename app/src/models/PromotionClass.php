<?php

require_once 'dao.php';

class Promotions
{
    private $dao;
    private $promotions_id;
    private $code_promo;
    private $promotions_pourcentage;
    private $promotions_date_debut;
    private $promotions_date_fin;
    private $promotions_creer;

    public function __construct($data = null)
    {
        $this->dao = new DAO("localhost", "AstraliumV2");

        // Hydrate 
        if ($data !== null) {
            foreach ($data as $key => $value) {
                $method = 'set_' . $key;
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }
    }

    // Getters--------------------------------------------------promotions_id
    //Promotions ID
    public function get_promotions_id()
    {
        return $this->promotions_id;
    }

    //Code Promo
    public function get_code_promo()
    {
        return $this->code_promo;
    }

    //Promotions Pourcentage
    public function get_promotions_pourcentage()
    {
        return $this->promotions_pourcentage;
    }

    //Promotions Date Debut
    public function get_promotions_date_debut()
    {
        return $this->promotions_date_debut;
    }

    //Promotions Date Fin
    public function get_promotions_date_fin()
    {
        return $this->promotions_date_fin;
    }

    //Promotions Creer
    public function get_promotions_creer()
    {
        return $this->promotions_creer;
    }

    // Setters-------------------------------------------

    //promotions_id
    public function set_promotions_id($promotions_id)
    {
        $this->promotions_id = $promotions_id;
    }

    //code_promo
    public function set_code_promo($code_promo)
    {
        $this->code_promo = $code_promo;
    }

    //Promotions Pourcentage
    public function set_promotions_pourcentage($promotions_pourcentage)
    {
        $this->promotions_pourcentage = $promotions_pourcentage;
    }

    //promotions_date_debut
    public function set_promotions_date_debut($promotions_date_debut)
    {
        $this->promotions_date_debut = $promotions_date_debut;
    }

    //promotions_date_fin
    public function set_promotions_date_fin($promotions_date_fin)
    {
        $this->promotions_date_fin = $promotions_date_fin;
    }

    //promotions_creer
    public function set_promotions_creer($promotions_creer)
    {
        $this->promotions_creer = $promotions_creer;
    }

    //function-----------------------------------------------------------------

    public function getAllPromotions()
    {
        $results = $this->dao->select("promotions");

        $promotions = [];
        foreach ($results as $result) {
            $promotions[] = new Promotions($result);
        }

        return $promotions;
    }

    //Fonction: recupère une promo par son id-----------------------------------------------
    public function getPromotionById($promotions_id)
    {
        $params = array('promotions_id' => $promotions_id);
        $result = $this->dao->select("promotions", "promotions_id = :promotions_id", $params)[0] ?? null;

        if ($result) {
            return new Promotions($result);
        }
        return null;
    }

    //INSERT une promo-------------------------------------------------------
    public function insertPromotion()
    {
        $values = array(
            'code_promo' => $this->code_promo,
            'promotions_pourcentage' => $this->promotions_pourcentage,
            'promotions_date_debut' => $this->promotions_date_debut,
            'promotions_date_fin' => $this->promotions_date_fin,
            'promotions_creer' => $this->promotions_creer,
        );
        return $this->dao->insert("promotions", $values);
    }

    //Valide le code promo---------------------------------------------------
    public function getPromotionByCode($code)
    {
        $params = array('code' => $code);
        $result = $this->dao->select("promotions", "code_promo = :code", $params)[0] ?? null;

        if ($result) {
            return new Promotions($result);
        }
        return null;
    }

    //UPDATE MAJ PROMO---------------------------------------------
    public function updatePromotion()
    {
        $data = array(
            'code_promo' => $this->code_promo,
            'promotions_pourcentage' => $this->promotions_pourcentage,
            'promotions_date_debut' => $this->promotions_date_debut,
            'promotions_date_fin' => $this->promotions_date_fin,
            'promotions_creer' => $this->promotions_creer,
        );

        $where = 'promotions_id = ?';
        $params = [$this->promotions_id];

        return $this->dao->update("promotions", $data, $where, $params);
    }

    // DELETE la promo------------------------------------------------
    public function deletePromotion()
    {
        $where = 'promotions_id = ?';
        $params = [$this->promotions_id];
        return $this->dao->delete("promotions", $where, $params);
    }

    // gere la promo sur le produit/panier/categorie et sous categorie
    //public function getPromotionsByType($type)
    //{
    //    $params = array('promo_appliquer' => $type);
    //    $results = $this->dao->select("promotions", "promo_appliquer = :promo_appliquer", $params);

    //    $promotions = [];
    //   foreach ($results as $result) {
    //        $promotions[] = new Promotions($result);
    //    }

    //    return $promotions;
    //}

    // gere quand la promo est active et quand yen a plus
    //public function getActivePromotions()
    //{
    //    $currentDate = date('Y-m-d');
    //    $params = array(
    //        'current_date' => $currentDate
    //   );

    //    $results = $this->dao->select(
    //        "promotions",
    //        "date_debut <= :current_date AND date_fin >= :current_date",
    //        $params
    //    );

    //    $promotions = [];
    //    foreach ($results as $result) {
    //        $promotions[] = new Promotions($result);
    //    }

    //    return $promotions;
    //}
    //public function getLibelle()
    //{
    //    return $this->code_promo;
    //}
}
