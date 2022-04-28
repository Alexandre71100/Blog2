<?php 

    /**
     * Upload d'une image
     */
     function uploadPicture(array $picture, string $path, int $maxSize = 1 ): array {

        // Poid max.
        $maxSize = 1 * 1048576;

        // Types MINE acceptés
        $typeMine = [
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif'
        ];

                // Récupération de l'extension
                $ext = pathinfo(strtolower($picture['name']), PATHINFO_EXTENSION);

               // Vérification de l'extension du fichier
               if(array_key_exists($ext, $typeMine) && in_array($picture['type'], $typeMine)) {
                
                 // Vérification du poids max. de l'image
                    if($picture['size'] <= $maxSize) {

                        // Génère un nom unique pour l'image
                        $newName = md5(time()) . ".$ext";

                        // Upload de l'image
                        move_uploaded_file(
                            $picture['tmp_name'],
                            "$path/$newName"
                        );

                        // Retourne le nom de l'image
                        return ['filename' => $newName];
                    }
                    else {
                        return ['error' => 'Le poids de l\'image est trop lourd'];
                    }
               }
               else {
                    return['error' => 'Ce fichier n\'est pas autorisé'];
               }
        
    }

?> 