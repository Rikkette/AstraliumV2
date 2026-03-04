<?php

require_once '../model/UserClass.php';
require_once '../model/TypeRoleClass.php';

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
        $user = $this->userModel->getUserByEmail($email);
        if (!$user) return "Identifiants incorrects";

        $user = $user[0];

        if (!password_verify($password, $user['users_password'])) {
            return "Identifiants incorrects";
        }

        // Récupérer le rôle
        $role = $this->typeModel->getLibelleById($user['type_role_id']);

        session_regenerate_id(true);
        $_SESSION['users_id'] = $user['users_id'];
        $_SESSION['type_libelle'] = $role;
        $_SESSION['logged_in'] = true;

        // Redirection selon le rôle vers le dashboard 
        // if ($role === 'admin') {
        //     header('Location: ../admin/dashboard.php');
        //     exit;
        // } else {
        //     header('Location: index.php');
        //     exit;
        //}

        if ($role === 'admin' || $role === 'client' || $role === 'dev') {
            header('Location: ../../public/index.php');
            exit;
        } else {
            return "Rôle inconnu, accès refusé";
        }
    }
}
