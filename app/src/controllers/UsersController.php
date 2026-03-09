<?php

require_once __DIR__ . '/../models/UserClass.php';
require_once __DIR__ . '/../models/TypeRoleClass.php';

class UserController
{
    private $userModel;
    private $typeModel;

    public function __construct()
    {
        $this->userModel = new UserClass();
        $this->typeModel = new TypeRoleClass();
    }

    public function login($email, $password)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            return "Identifiants incorrects";
        }

        if (!password_verify($password, $user['users_password'])) {
            return "Identifiants incorrects";
        }

        // récupérer le rôle
        $role = $this->typeModel->getLibelleById($user['type_role_id']);

        session_regenerate_id(true);

        $_SESSION['users_id'] = $user['users_id'];
        $_SESSION['users_email'] = $user['users_email'];
        $_SESSION['type_libelle'] = $role;
        $_SESSION['logged_in'] = true;

        return true;
    }
}