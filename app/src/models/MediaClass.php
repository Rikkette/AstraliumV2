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

    //Setters -------------------------------------------

    //Media ID
    public function set_media_id($media_id)
    {
        $this->media_id = $media_id;
    }

    // Media Nom
    public function set_media_nom($media_nom)
    {
        $this->media_nom = $media_nom;
    }

    //Media Tag 
    public function set_media_tag($media_tag)
    {
        $this->media_tag = $media_tag;
    }

    //Media Chemin 
    public function set_media_chemin($media_chemin)
    {
        $this->media_chemin = $media_chemin;
    }

    //Media Descriptions
    public function set_media_descriptions($media_descriptions)
    {
        $this->media_descriptions = $media_descriptions;
    }

    //Blog ID
    public function set_blog_id($blog_id)
    {
        $this->blog_id = $blog_id;
    }

    //Commentaires ID
    public function set_commentaires_id($commentaires_id)
    {
        $this->commentaires_id = $commentaires_id;
    }

    //Produits ID (pas sur)
    public function set_produits_id($produits_id)
    {
        $this->produits_id = $produits_id;
    }

    //Fonction---------------------------------------------------------

    public function getMediaByID($media_id)
    {
        $params = array('media_id' => $media_id);
        $results = $this->dao->select("media", "media_id = :media_id", $params)[0] ?? null;

        if ($results) {
            return new Media($results);
        }
        return null;
    }

    //INSERT ------------------------------------------
    public function insertMedia()
    {
        $values = array(
            'media_nom' => $this->media_nom,
            'media_tag' => $this->media_tag,
            'media_chemin' => $this->media_chemin,
            'media_descriptions' => $this->media_descriptions,
            'blog_id' => $this->blog_id,
            'media_id' => $this->media_id,
            'commentaires_id' => $this->commentaires_id,
            'produits_id' => $this->produits_id,

        );
        return $this->dao->insert("media", $values);
    }
    
    //UPDATE---------------------------------------------
    public function updateMedia()
    {
        $values = array(
            'media_nom' => $this->media_nom,
            'media_tag' => $this->media_tag,
            'media_chemin' => $this->media_chemin,
            'media_descriptions' => $this->media_descriptions,
            'blog_id' => $this->blog_id,
            'media_id' => $this->media_id,
            'commentaires_id' => $this->commentaires_id,
            'produits_id' => $this->produits_id,

        );

        $where = 'media_id = ?';
        $params = [$this->media_id];
        return $this->dao->update("media", $data, $where, $params);
    }

    // DELETE------------------------------------------------------------
    public function deleteMedia()
    {
        $where = 'media_id = ?';
        $params = [$this->media_id];
        return $this->dao->delete("media", $where, $params);
    }
}
