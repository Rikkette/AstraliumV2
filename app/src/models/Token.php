<?php
class JWT

{
    private $dao;

    public function __construct()
    {
          $this->dao = new dao('AstraliumV2', 'dev');
    }

    public function create($user_id, $token, $expires_at = null)
    {
        $values = array(
            'users_id' => $user_id,
            'token' => $token,
            'expires_at' => $expires_at

        );

        return $this->dao->insert('t_d_token', $values);
    }

    public function getByToken($token)
    {
        $params = array(
            ':token' => $token
        );
        return $this->dao->select(
            "t_d_token",
            "token = :token
              AND (expires_at IS NULL OR expires_at > NOW()) "
        );
    }

    public function delete($token)
    {
        // Suppression d'un token spécifique
        $params = array(
            ':token' => $token
        );
        return $this->dao->delete("t_d_token", "token = :token", $params);
    }

    public function deleteAllByUser($user_id)
    {
        // Suppression de tous les tokens d'un utilisateur
        if (empty($user_id)) {
            return false; // Si l'ID utilisateur est vide, on ne fait rien
        }
        $params = array(
            ':id_user' => $user_id
        );
        return $this->dao->delete("t_d_token", "id_user = :id_user", $params);
    }

    public function cleanExpired()
    {
        // Suppression de tous les tokens expirés
        // On supprime les tokens dont expires_at est non null et inférieur à la date actuelle
        return $this->dao->delete("t_d_token", "expires_at IS NOT NULL AND expires_at < NOW()");
    }


    public function getValidTokenByUserId($user_id)
    {
          $params = array(
            ':id_user' => $user_id
        );
        return $this->dao->select(
            "t_d_token",
            "id_user = :id_user
              AND (expires_at IS NULL OR expires_at > NOW())
              ORDER BY created_at DESC
              LIMIT 1",
            $params
        );
    }
}