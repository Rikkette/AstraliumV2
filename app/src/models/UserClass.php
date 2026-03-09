<?php

require_once 'dao.php';


class UserClass
{
    private $dao;

    public function __construct()
    {
        $this->dao = new dao('AstraliumV2', 'dev');
    }

    public function getUserByEmail($email)
    {
        $result = $this->dao->select(
            'users',
            'users_email = ?',
            [$email]
        );
        return $result ? $result[0] : null;
    }

    public function getUserById($users_id)
    {
        $result = $this->dao->select(
            'users',
            'users_id = ?',
            [$users_id]
        );
        return $result ? $result[0] : null;
    }

    public function getUserWithRole($email)
    {
        $sql = "SELECT u.*, t.type_libelle AS role
                FROM users u
                JOIN type_role t ON u.type_role_id = t.type_role_id
                WHERE u.users_email = ?";
        $stmt = $this->dao->connect()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
