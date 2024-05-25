<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Déplaçable et Redimensionnable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Essayer_gate.css">
</head>
<body>
    <button class="btn btn-primary" type="button" id="toggleMenu">Menu</button>

    <div class="menu" id="menu">
        <div class="menu-header">
            <h5>GATE</h5>
            <button type="button" class="btn-close" id="closeMenu" aria-label="Close"></button>
        </div>
        <div class="menu-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Rechercher</a></li>
                <li class="list-group-item"><a href="#">Boîte de réception</a></li>
                <li class="list-group-item"><a href="#">Paramètre</a></li>
                <li class="list-group-item"><a href="#">Membre</a></li>
                <li class="list-group-item"><a href="#">Créer un espace d'équipe</a></li>
                <li class="list-group-item"><a href="#">Modèle</a></li>
                <li class="list-group-item"><a href="#">Corbeille</a></li>
                <li class="list-group-item"><a href="#">Aide et service client</a></li>
                <li class="list-group-item"><a href="#">Planificateur de projet</a></li>
            </ul>
        </div>
        <div class="resizer" id="resizer"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Essayer_gate.js"></script>
</body>
</html>
