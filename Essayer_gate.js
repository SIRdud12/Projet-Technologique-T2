document.addEventListener('DOMContentLoaded', function () {
    const menu = document.getElementById('menu');
    const toggleMenuButton = document.getElementById('toggleMenu');
    const closeMenuButton = document.getElementById('closeMenu');
    const resizer = document.getElementById('resizer');

    toggleMenuButton.addEventListener('click', function () {
        menu.style.display = 'flex';
    });

    closeMenuButton.addEventListener('click', function () {
        menu.style.display = 'none';
    });

    let isResizing = false;

    resizer.addEventListener('mousedown', function (e) {
        isResizing = true;
    });

    document.addEventListener('mousemove', function (e) {
        if (!isResizing) return;

        const newWidth = e.clientX;
        if (newWidth > 100 && newWidth < 500) {
            menu.style.width = newWidth + 'px';
        }
    });

    document.addEventListener('mouseup', function () {
        isResizing = false;
    });

    let isDragging = false;
    let startX, startY, startLeft, startTop;

    menu.addEventListener('mousedown', function (e) {
        if (e.target === resizer) return;

        isDragging = true;
        startX = e.clientX;
        startY = e.clientY;
        startLeft = menu.offsetLeft;
        startTop = menu.offsetTop;

        document.body.classList.add('no-select');
    });

    document.addEventListener('mousemove', function (e) {
        if (!isDragging) return;

        const newLeft = startLeft + (e.clientX - startX);
        const newTop = startTop + (e.clientY - startY);

        if (newLeft >= 0 && newTop >= 0) {
            menu.style.left = newLeft + 'px';
            menu.style.top = newTop + 'px';
        }
    });

    document.addEventListener('mouseup', function () {
        isDragging = false;
        document.body.classList.remove('no-select');
    });
});
    