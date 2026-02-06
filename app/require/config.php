<?php

$host = getenv('DOCKER_ENV') === 'true' ? 'db' : 'localhost';
define('DB_HOST_DEV', $host);
define('DB_USER_DEV', 'root');
define('DB_PASSWORD_DEV', 'opif');

define('DB_HOST_PROD', 'production_host');
define('DB_USER_PROD', 'root');
define('DB_PASSWORD_PROD', '');