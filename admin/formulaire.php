<?php

require_once '../connexion.php';
require_once '../vendor/autoload.php';
require_once 'fonctions.php';

/**
 * Séléction de toutes les catégories en BDD
 */

$query = $db->query('SELECT * FROM categories ORDER BY name');
$categories = $query->fetchAll();

/**
 * Déclaration de variables à NULL
 * Elles serviront à remplir le formulaire des données soumises
 * par l'utilisateur
 */

$titre = null;
$contenu = null;
$category = null;
$error = null;

/**
 * Si la superglobale $_POST n'est pas vide, alors j'effectue
 * les vérifications nécessaires et l'insertion en BDD
 */

if (!empty($_POST)) {
    $titre = htmlspecialchars(strip_tags($_POST['titre']));
    $contenu = htmlspecialchars(strip_tags($_POST['contenu']));
    $category = htmlspecialchars(strip_tags($_POST['categorie']));

    //Verifie que mes champ soient bien remplis
    if (
        !empty($titre)
        && !empty($contenu)
        && !empty($category)
        && !empty($_FILES['image'])
        && $_FILES['image']['error'] === 0
    ) {
        $upload = uploadPicture($_FILES['image'], '../images/upload', 1);

        // Si aucune erreur...
        if (empty($upload['error'])) {
            $fileName = $upload['filename'];

            // ... insertion en BDD
            $query = $db->prepare('INSERT INTO posts (user_id, category_id, title, content, cover, created_at) VALUES (1, :category_id, :title, :content, :cover, NOW())');
            $query->bindValue(':category_id', $category, PDO::PARAM_INT);
            $query->bindValue(':title', $titre);
            $query->bindValue(':content', $contenu);
            $query->bindValue(':cover', $fileName);
            $query->execute();

            header('Location: index.php?successAdd=1');
        } else {
            // Sinon, on transfère l'erreur à la variable "$error" pour l'afficher
            // au dessus du formulaire
            $error = $upload['error'];
        }
    } else {
        $error = 'Tous les champ sont obligatoires';
    }
}
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/article.css">
        <link rel="stylesheet" href="../css/style.css">
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
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </div>

                <!-- Navigation -->
                <div class="col-12 d-none d-lg-block">
                    <nav>
                        <ul class="d-flex align-items-center justify-content-center gap-5 py-3">
                            <li><a href="../index.php" title="blog" class="text-secondary text-decoration-none">Blog</a></li>
                            <li><a href="index.php" title="home" class="text-secondary text-decoration-none">Articles</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </header>
    <div class="gradient"></div>
    <main>
        <div class="container">

            <!-- Affichage d'une erreur formulaire si nécessaire -->
            <?php if ($error !== null) : ?>
                <div class="alert alert-danger">
                    <?php echo $error ?>
                </div>
            <?php endif ?>

            <div class="row">

                <div class="col-xl-8 offset-xl-2 py-5">

                    <h1>Formulaire d'ajout d'article</h1>

                    <form method="post" enctype="multipart/form-data">

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_image">Image</label>
                                        <input id="form_image" type="file" name="image" class="form-control" placeholder="Veuillez importer votre image">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_cat">Catégories</label>
                                        <select id="form_cat" name="categorie" class="form-control">
                                            <option selected>Choisir une catégorie</option>

                                            <?php foreach ($categories as $categorie) : ?>
                                                <!-- Liste des catégories -->
                                                <option value="<?php echo $categorie['id']; ?>" <?php echo ($category !== null && $category == $categorie['id']) ? 'selected' : '';  ?>>
                                                    <?php echo $categorie['name']; ?>
                                                </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_titre">Titre</label>
                                        <input id="form_titre" type="text" name="titre" class="form-control" placeholder="Veuillez entrer votre titre" value="<?php echo $titre; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="form_message">Contenu de l'article</label>
                                        <textarea id="form_message" name="contenu" class="form-control" placeholder="Text" rows="10"><?php echo $contenu; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success btn-send" value="Valider">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>


        </div>
    </main>

</body>

</html>