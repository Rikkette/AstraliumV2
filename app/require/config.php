<?php
// config.php

// Détection de l'environnement (Docker ou local)
$host = getenv('DOCKER_ENV') === 'true' ? 'db' : 'localhost'; // en local parfait pour dev 
define('DB_HOST_DEV', $host);
define('DB_USER_DEV', 'root');
define('DB_PASSWORD_DEV', 'opif');

define('DB_HOST_PROD', 'production_host'); // variable defini pour production a modifier en consequence lors de la prod 
define('DB_USER_PROD', 'root');
define('DB_PASSWORD_PROD', 'opif');

// Définir le chemin racine du projet pour PHP
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . '/../'); // chemin réel sur le serveur
}

// URL de base pour générer des liens
if (!defined('BASE_URL')) {
    $environment = getenv('ENVIRONMENT') ?: 'development';
    if ($environment === 'production') {
        define('BASE_URL', 'https://astralium.com/ASTRALIUMV2'); // generer url en prod ( a modifier)
    } else {
        define('BASE_URL', 'http://localhost/ASTRALIUMV2'); // url pour dev 
    }
}