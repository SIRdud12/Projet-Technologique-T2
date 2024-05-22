// Récupérer les éléments offcanvas
const offcanvasElement = document.getElementById('offcanvas');

// Écouter l'événement de show pour enlever la classe de désactivation du défilement
offcanvasElement.addEventListener('show.bs.offcanvas', function () {
    document.body.classList.remove('offcanvas-backdrop');
});

// Écouter l'événement de hidden pour réactiver la classe de désactivation du défilement
offcanvasElement.addEventListener('hidden.bs.offcanvas', function () {
    document.body.classList.add('offcanvas-backdrop');
});
