<?php

require_once 'dao.php';

Class TypeRoleClass 
{

private $dao;

  public function __construct()
  {
    $this->dao = new dao(DB_HOST_DEV,'AstraliumV2'); //protege les donner sensible en les mettant dans une classe et en les appelant que quand on en a besoin
    
  }

 // Récupère tous les types de rôles (admin et client)

public function getAllTypes()
    {
        return $this->dao->select('type_role');
    }

 // Récupère le libelle du role à partir de son ID
    public function getLibelleById($type_id) 
    {
        $result = $this->dao->select( 
            'type_role', //nom table
            'type_role_id = ?', //nom colone
            [$type_id]
        );
        return $result ? $result[0]['type_libelle'] : null;
    }

 // Récupère l'id du role à partir de son libelle (1 pour admin)( 2 pour client) 
    public function getIdByLibelle($libelle)
    {
        $result = $this->dao->select(
            'type_role', // la table à interroger
            'type_libelle = ?', // Condition de recherche
            [$libelle] // Valeur à rechercher
        );
        return $result ? $result[0]['type_role_id'] : null;  // Retourne null si aucun résultat trouvé
    }
}









?>