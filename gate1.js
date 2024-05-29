document.addEventListener('DOMContentLoaded', function () {
    const menu = document.getElementById('menu');
    const toggleMenuButton = document.getElementById('toggleMenu');
    const closeMenuButton = document.getElementById('closeMenu');

    toggleMenuButton.addEventListener('click', function () {
        menu.style.display = 'flex';
    });

    closeMenuButton.addEventListener('click', function () {
        menu.style.display = 'none';
    });
});
