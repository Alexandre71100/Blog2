/**
 * Suppression d'article via modal Boostrap
 */

// Récupère le bouton de suppression d'un article
const btnDelete = document.querySelectorAll('.btnDelete');

btnDelete.forEach(btn => {
    // Ecouteur d'évènement sur le bouton au click
    btn.addEventListener('click', (event) => {
        event.preventDefault();

        //Récupère l'attribut href
        const href = btn.href;
        const modalDelete = document.querySelector('.btnDeleteModal');
        modalDelete.href = href;



        // Récupération de la modal
        const modal = new bootstrap.Modal(document.querySelector('#confDelete'));


        // Ouverture de la modal Boostrap
        modal.show();
    });
});

