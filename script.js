/**
 * CAROUSEL
 */


    // Chemin ou sont situées les images
    const path ="Images/slide/";

    // Tableau contenant les différentes images du carousel
    const pictures = ["01.jpg","02.jpg","03.jpg"];

    // Image du slider
    const picture = document.querySelector("#slider img")

    /**
     * Partie 2
     * écouteur d’évènement sur la flèche de droite
     */

    // Compteur
    let counter = 0;

    // Déclaration du timer pour les fonctions
    let timer;

    const fleched = document.querySelector('.bi-arrow-right')
    // Slide auto
    const autoSlide = () => {
        if( counter === pictures.length - 1 ) {
            counter = 0;
        }
        else {
            //Sinon, on ajoute 1 à notre compteur
            counter += 1;
        } 
         // Modifie l'attribut "src" de l'image en sélectionnant l'élément suivant du tableau
        picture.src = `${path}${pictures[counter]}`
    }
    // Appelle la fonction "autoSlide" toutes les 2 secondes 

    // écouteur d’évènement sur la flèche de droite
    fleched.addEventListener('click', () => {
        // Ajoute 1 à notre compteur
    
        if( counter === pictures.length - 1 ) {
            counter = 0;
        }
        else {
            //Sinon, on ajoute 1 à notre compteur
            counter += 1;
        }
    
    // Modifie l'attribut "src" de l'image en sélectionnant l'élément suivant du tableau
    picture.src = `${path}${pictures[counter]}`
    
    });
    
/**
 * Partie 3
 * écouteur d’évènement sur la flèche de gauche
 */

const flecheg = document.querySelector(".bi-arrow-left")

flecheg.addEventListener('click', () => {
    // Ajoute 1 à notre compteur

    // Si le compteur est à zéro, je suis au début du tableau
    if( counter === 0 ) {
        counter =  pictures.length - 1;
    }
    else {
        //Sinon, on ajoute 1 à notre compteur
        counter -= 1;
    }

// Modifie l'attribut "src" de l'image en sélectionnant l'élément suivant du tableau
picture.src = `${path}${pictures[counter]}`

});

/**
 * Partie 5
 * Au survol de la souris sur l’image du carousel,
 * le changement automatique des images s’arrête.
 */

/**
 * Fonction qui Arrête le slide
 */

    const stopCarousel = () => {
    // "Tue" le setInterval
    clearInterval(timer);
}

/**
 * Fonction qui Relance le slide
 */

const startCarousel = () => {
    // Appelle la fonction "autoSlide" toutes les 2 secondes 
    timer = setInterval (autoSlide, 2000);
}

startCarousel();

// Quand le pointeur de la souris se retrouve sur l'image de carousel, on stop le setInterval
picture.addEventListener("mouseover", stopCarousel);
picture.addEventListener("mouseout", startCarousel);


fleched.addEventListener("mouseover", stopCarousel);
fleched.addEventListener("mouseout", startCarousel);


flecheg.addEventListener("mouseover", stopCarousel);
flecheg.addEventListener("mouseout", startCarousel);