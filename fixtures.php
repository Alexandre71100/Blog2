<?php

/**
 * fixtures.php
 * Insertion de fausses données en BDD
 */

 // Chargement de l'autoloader de Composer
 require_once 'vendor/autoload.php';

 require_once 'connexion.php';

 // Création de l'instance de Faker
 $faker = Faker\Factory::create('fr_FR');

$db->query('SET FOREIGN_KEY_CHECK = 0');

 $db->query('TRUNCATE categories');

 /**
  * Insertion des données dans la table "categories"
  */
//for($i = 0; $i < 10; $i++) {
//    $query = $db->prepare('INSERT INTO categories (name) VALUES (:name)');
//    $query->bindValue(':name', $faker->colorName);
//    $query->execute();
//}


/**
 * Inserction des données de la table "users"
 */

for($i = 0; $i < 55; $i++) {
    $query = $db->prepare('INSERT INTO users (lastname, firstname, email, password, role, created_at) VALUES (:lastname, :firstname, :email, :password, :role, :created_at)');
    $query->bindValue(':lastname', $faker->lastname);
    $query->bindValue(':firstname', $faker->firstName);
    $query->bindValue(':email', $faker->email);
    $query->bindValue(':password', $faker->password);
    $query->bindValue(':role');
    $query->bindValue(':created_at', $faker->dateTime);

    $query->execute();
}