<?php

require_once 'dao.php';

class Media
{
    private $dao;
    private $media_id;
    private $media_nom;
    private $media_tag;
    private $media_chemin;
    private $media_descriptions;
    private $blog_id;
    private $commentaires_id;
    private $produits_id;

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

    //Media ID
    public function get_media_id()
    {
        return $this->media_id;
    }

    //Media Nom
    public function get_media_nom()
    {
        return $this->media_nom;
    }

    //Media Tag
    public function get_media_tag()
    {
        return $this->media_tag;
    }

    //Media Chemin
    public function get_media_chemin()
    {
        return $this->media_chemin;
    }

    //Media Descriptions
    public function get_media_descriptions()
    {
        return $this->media_descriptions;
    }

    // Blog ID
    public function get_blog_id()
    {
        return $this->blog_id;
    }

    //Commentaires ID
    public function get_commentaires_id()
    {
        return $this->commentaires_id;
    }

    //Produit ID (interet de redefinir ?)
    public function get_produits_id()
    {
        return $this->produits_id;
    }

}
