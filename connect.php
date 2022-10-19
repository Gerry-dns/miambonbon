<?php

try {
    // connexion à la BDD
    $db = new PDO('mysql:host=localhost;dbname=miambonbon', 'root', '');
  
    

    // si connexion échoue, on envoie ce message d'erreur

} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}
