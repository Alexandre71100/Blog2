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
    <script src="js/delete.js" defer></script>
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
        <div>
            <h1>Articles</h1>
            <a href="formulaire.php" class="badge bg-primary text-decoration-none">Ajout d'article</a>
        </div>

        <?php if (isset($_GET['successAdd'])) : ?>
            <div class="alert alert-success mb-4">
                L'article à bien été ajouté !
            </div>
        <?php endif; ?>

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

                <?php foreach ($admin as $article) : ?>
                    <tr>
                        <td><?php echo $article['id'] ?></td>
                        <td><?php echo $article['title'] ?></td>
                        <td><?php echo date('d.m.Y', strtotime($article['created_at'])); ?></td>
                        <td>
                            <a href="edition.php?id=<?php echo $article['id'] ?>" title="Editer"><img src="imgs/pencil.svg" alt="renommer"></a>
                            <a href="delete.php?id=" class="btnDelete"><img src="imgs/clear.svg" alt="supprimer"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="confDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation Suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Confirmation de la suppression !
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-primary">Oui, je supprime</a>
                    </div>
                </div>
            </div>
        </div>

    </main>




</body>

</html>