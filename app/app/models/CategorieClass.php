<?php

require_once 'dao.php';

class CategorieClass
{
    private $dao;
    private $slug;
    private $categorie_id;
    private $libelle;
    private $promo_id;
    private $nom;


    public function __construct($categorie_id = null, $libelle = null)
    {
        throw new \Exception('Not implemented');
    }
}

?>