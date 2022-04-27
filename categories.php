<?php
// Connexion à la BDD
require_once 'connexion.php';

// Chargement des dépendances Composer
require_once 'vendor/autoload.php';

//dump($_GET['id']);

// Nettoyage de la valeur reçue
$id_category = htmlspecialchars(strip_tags($_GET['id']));

// Effectue la requête SQL
$query = $db->prepare('SELECT posts.id, posts.title, posts.content, posts.cover, posts.created_at, posts.category_id, categories.name AS category FROM posts INNER JOIN categories ON categories.id = posts.category_id WHERE categories.id = :id ORDER BY posts.created_at DESC');

$query->bindValue(':id', $id_category, PDO::PARAM_INT);
$query->execute();

$articles_cat = $query->fetchAll();

// Si $articles_cat est égal à false...
if(!$articles_cat) {
    header('Location: 404.php');
}

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
    <link rel="stylesheet" href="css/style.css">
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
                        Philosophy.
                    </a>
                </div>

                <!-- Menu Burger -->
                <div class="col-6 d-block d-lg-none text-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list text-white" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                      </svg>
                </div>

                <!-- Navigation -->
                <div class="col-12 d-none d-lg-block">
                    <nav>
                        <ul class="d-flex align-items-center justify-content-center gap-5 py-3">
                            <li><a href="index.php" title="Home"class="text-secondary text-decoration-none">Home</a></li>
                            <li><a href="#" title="Categorie" class="text-secondary text-decoration-none">Categorie</a></li>
                            <li><a href="#" title="Styles" class="text-secondary text-decoration-none">Styles</a></li>
                            <li><a href="#" title="About" class="text-secondary text-decoration-none">About</a></li>
                            <li><a href="#" title="Contact" class="text-secondary text-decoration-none">Conctact</a></li>
                        </ul>
                    </nav>
                </div>
        </div>
    </header>
            <div class="gradient"></div>

<!-------------------------------------------- PHP ----------------------------------------------->

    <main class="py-5">
        <div class='container'>
            <h3 class="pb-3">Catégorie : <?php echo $articles_cat[0]['category']?></h3>
            <div class='row'>       
                    

                        <?php foreach($articles_cat as $article): ?>
                                <!-- Colonne contenant un article -->
                                <div class="col-12 col-lg-6 pb-5">
                                    
                                    <!-- L'article -->
                                    <article>
                                        <a href="article.php?id=<?php echo $article['id']; ?>" title="<?php echo $article['title']; ?>" class="text-dark text-decoration-none">
                                            <img src="images/upload/<?php echo $article['cover']; ?>" alt="<?php echo $article['title']; ?>" class="w-100 rounded">
                                            <h1 class="pt-2"><?php echo $article['title']; ?></h1>
                                        </a>
                                        <p class="text-secondary">
                                            <?php 
                                                $timestamp = strtotime($article['created_at']);
                                                echo date('d, F, Y', $timestamp); 
                                            ?>
                                        </p>
                                        <p class="py-2">
                                            <?php echo mb_strimwidth($article['content'], 0, 200, '...'); ?>
                                        </p>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="categories.php?id=<?php echo $article['category_id']; ?>" title="<?php echo $article['category']; ?>" class="badge rounded-pill bg-primary text-decoration-none">
                                                <?php echo $article['category']; ?>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>

            </div>
        </div>
    </main>






        <!-- Footer -->
        <footer class="bg-dark py-4">
            <div class="container">
                <p class="m-0 text-white">&copy; Copyright Philosophy 2022</p>
            </div>
        </footer>
    
    
</body>
</html>