<?php

/**
 * Test de var_dumper()
 */

 // Chargement de l'autoloader de Composer
 require_once 'vendor/autoload.php';

 $array = [
     'id' => 1,
     'prenom' => 'Alexandre'
 ];

 dump($array);


