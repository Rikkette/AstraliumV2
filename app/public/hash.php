<?php
echo password_hash('opif', PASSWORD_DEFAULT); // <-- juste ici a la place 
/* de "tonMotDePasse" tu met ton vrai mdp 

ensuite tu va sur l'url http://localhost:8082/hash.php

tu copie le mdp hashé genréré et tu va sur php my admin ta table users, tu fait une requete sql 
UPDATE users SET users_password = 'ICI TU COLLE LE MOT DE PASSE HASHER QUE TU AS COPIER PRECEDEMENT'
 WHERE users_email = 'test@test.com'; 
tu execute la requetes 

et apres tu pourra te connecter avec ton vrai mdp 
*/
?>