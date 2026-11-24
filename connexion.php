<?php
/*
  CONNEXION.PHP
  Recopier ici le code de connexion du TP 1, sans le message "Connexion réussie !".
  Ce fichier sera inclus dans les TP 2 à 9 avec : require 'connexion.php';
*/

try {
    // WAMP : utilisateur root, mot de passe vide
    $pdo = new PDO('mysql:host=localhost;dbname=ludotheque;charset=utf8mb4', 'root', '');
    // Afficher les erreurs SQL sous forme d'exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
