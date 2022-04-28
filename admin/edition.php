<?php

require_once '../connexion.php';
require_once '../vendor/autoload.php';
require_once 'fonctions.php';

/**
 * Séléction de toutes les catégories en BDD
 */

// Effectue la requête SQL
$query = $db->prepare('SELECT posts.id, posts.title, posts.content, posts.cover, posts.created_at, users.firstname, users.lastname, categories.name AS category FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id = posts.category_id WHERE posts.id = :id ORDER BY posts.created_at DESC ');
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
        <link rel="stylesheet" href="..css/style.css">
    </head>
    <body>

        <header class="bg-dark py-4">
            <div class="container">

                <!-- Ligne -->
                <div class="row">

                    <!-- Titre du site -->
                    <div class="col-6 col-lg-12 text-start text-lg-center">
                        <a href="#" title="Philosophy." class="text-white text-decoration-none h1 logo">
                            Formulaire Philosophy.
                        </a>
                    </div>

                    </div>
        </header>
    <main>
        <div class="container">
 
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

                                 <?php foreach($categories as $categorie):?>
                                    <!-- Liste des catégories -->
                                    <option value="<?php echo $categorie['id']; ?>" <?php echo ($category !== null && $category == $categorie['id']) ? 'selected': '';  ?>>
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