<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GATE</title>
    <link rel="stylesheet" href="gate1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>GATE</strong>
            </a>
            <button class="btn btn-primary" id="toggleMenu">Menu</button>
        </div>
    </header>
    
    <div class="menu" id="menu">
        <div class="menu-header">
            <h5>GATE</h5>
            <button type="button" class="btn-close" id="closeMenu" aria-label="Close"></button>
        </div>
        <div class="menu-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Rechercher</a></li>
                <li class="list-group-item"><a href="#">Boîte de réception</a></li>
                <li class="list-group-item"><a href="#">Paramètres</a></li>
                <li class="list-group-item"><a href="#">Membre</a></li>
                <li class="list-group-item"><a href="#">Créer un espace d'équipe</a></li>
                <li class="list-group-item"><a href="#">Modèles</a></li>
                <li class="list-group-item"><a href="#">Corbeille</a></li>
                <li class="list-group-item"><a href="C:/xampp/htdocs/gate/calendrier.php">Planificateur de projet</a></li>
            </ul>
        </div>
    </div>
    
    <main class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenue sur GATE</h1>
                <p>Gérez vos projets et vos équipes efficacement.</p>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="gate1.js"></script>
</body>
</html>
