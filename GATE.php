<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate - Gestion de projet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="GATE.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3">Gate</h1>
                <nav>
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Produit</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Documents</a></li>
                                <li><a class="dropdown-item" href="#">Projets</a></li>
                                <li><a class="dropdown-item" href="#">Calendrier</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Ressources</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Blog</a></li>
                                <li><a class="dropdown-item" href="#">Gate Academie</a></li>
                                <li><a class="dropdown-item" href="#">Site d'aide</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Solution</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Grandes Entreprises</a></li>
                                <li><a class="dropdown-item" href="#">Petites équipes et PME</a></li>
                                <li><a class="dropdown-item" href="#">Individuel</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Télécharger</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Gate</a></li>
                                <li><a class="dropdown-item" href="#">Gate Calendrier</a></li>
                                <li><a class="dropdown-item" href="#">Clipper</a></li>
                            </ul>
                        </li>
                         <li class="nav-item"><a href="#" class="nav-link text-white">Tarifs</a></li>
                    </ul>
                </nav>
                <div>
                    <button class="btn btn-outline-light me-2">Se connecter</button>
                    <button class="btn btn-light">S'inscrire</button>
                     <a href="Essayer_gate.php" class="btn btn-light">Essayer Gate</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <h2>Bienvenue sur Gate</h2>
            <p>Votre outil de gestion de projet ultime.</p>
        </div>
    </main>

  <!-- Footer -->
  <!-- Footer -->
  <footer class="bg-dark text-white py-5">
      <div class="container">
          <div class="row">
              <div class="col-md-3">
                  <h5>Gate</h5>
                  <ul class="list-unstyled">
                      <li><a href="#" class="text-white text-decoration-none">Accueil</a></li>
                      <li><a href="#" class="text-white text-decoration-none">À propos</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Blog</a></li>
                  </ul>
              </div>
              <div class="col-md-3">
                  <h5>Produit</h5>
                  <ul class="list-unstyled">
                      <li><a href="#" class="text-white text-decoration-none">Fonctionnalités</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Tarifs</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Intégrations</a></li>
                      <li><a href="#" class="text-white text-decoration-none">API</a></li>
                  </ul>
              </div>
              <div class="col-md-3">
                  <h5>Ressources</h5>
                  <ul class="list-unstyled">
                      <li><a href="#" class="text-white text-decoration-none">Documentation</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Guides</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Support</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Communauté</a></li>
                  </ul>
              </div>
              <div class="col-md-3">
                  <h5>Entreprise</h5>
                  <ul class="list-unstyled">
                      <li><a href="#" class="text-white text-decoration-none">À propos</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Carrières</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Presse</a></li>
                      <li><a href="#" class="text-white text-decoration-none">Blog</a></li>
                  </ul>
              </div>
                <div class="footer-column">
                <h5>Suivez-nous</h5>
                <ul class="social-links">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
          </div>
          <div class="row mt-4">
              <div class="col-md-12 text-center">
                  <p class="mb-0">&copy; 2024 Gate. Tous droits réservés.</p>
              </div>
          </div>
      </div>
  </footer>

  <style>
      footer {
          background-color: #f8f9fa;
          color: #343a40;
      }
      footer h5 {
          margin-bottom: 1rem;
      }
      footer ul {
          padding-left: 0;
          list-style: none;
      }
      footer a:hover {
          text-decoration: underline;
      }
  </style>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</body>
</html>
