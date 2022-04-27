<?php

/**
 * Séléction de données en BDD
 */

// Connexion à la BDD
require_once '../connexion.php';

// Chargement des dépendances Composer
require_once '../vendor/autoload.php';

// Passe la requête SQL
$query = $db->query('SELECT id, title, created_at FROM posts  ORDER BY posts.created_at DESC');

// Recupère tous les résultats et je les stocke dans la variable "$admin"
$admin = $query->fetchAll();

// dump($articles);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philosophy</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="..css/style.css">
    <script src="script.js" defer></script>
</head>
<body>

    <header class="bg-dark py-4">
        <div class="container">

            <!-- Ligne -->
            <div class="row">

                <!-- Titre du site -->
                <div class="col-6 col-lg-12 text-start text-lg-center">
                    <a href="#" title="Philosophy." class="text-white text-decoration-none h1 logo">
                        Admin Philosophy.
                    </a>
                </div>

                </div>
    </header>
            <div class="gradient"></div>
            
    <main>
            
            <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Titre</th>
            <th scope="col">Date création</th>
            <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($admin as $article): ?>
                <tr>
                    <td><?php echo $article['id'] ?></td>
                    <td><?php echo $article['title'] ?></td>
                    <td><?php echo $article['created_at'] ?></td>
                    <td>
                        <a href=""><img src="imgs/pencil.svg" alt="renommer"></a>
                        <a href="" ><img src="imgs/clear.svg" alt="supprimer"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

    </main>

                  
    
    
</body>
</html>
