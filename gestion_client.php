<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <a href="index.php" class="active">
          <i class="bx bxl-c-plus-plus"></i>
          <span class="logo_name">GATE</span>
        </a>
      </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="projet.php">
            <i class="bx bx-box"></i>
            <span class="links_name">Projet</span>
          </a>
        </li>
        <li>
          <a href="plan.php">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Plan</span>
          </a>
        </li>
        <li>
          <a href="indicateur.php">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Indicateur clés</span>
          </a>
        </li>
        <li>
          <a href="gestion_client.php" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Gestion Client</span>
          </a>
        </li>
        <li>
          <a href="calendrier.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Calendrier</span>
          </a>
        </li>
        <li class="log_out">
          <a href="GATE.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Déconnexion</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Gestion Client</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Recherche..." />
          <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
          <span class="admin_name">Komche</span>
          <i class="bx bx-chevron-down"></i>
        </div>
      </nav>

      <div class="home-content">
        <div class="users-table">
          <h2>Utilisateurs en attente de validation</h2>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="pending-users">
              <!-- Utilisateurs en attente de validation -->
            </tbody>
          </table>
        </div>
        
        <div class="users-table">
          <h2>Utilisateurs enregistrés</h2>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Projet</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="registered-users">
              <!-- Utilisateurs enregistrés -->
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };

      // Exemple de données utilisateurs
      const pendingUsers = [
        { id: 1, name: 'Alice', email: 'alice@example.com' },
        { id: 2, name: 'Bob', email: 'bob@example.com' },
      ];

      const registeredUsers = [
        { id: 1, name: 'Charlie', email: 'charlie@example.com', project: 'Projet A' },
        { id: 2, name: 'Dave', email: 'dave@example.com', project: 'Projet B' },
      ];

      // Afficher les utilisateurs en attente
      const pendingUsersTable = document.getElementById('pending-users');
      pendingUsers.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${user.id}</td>
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>
            <button onclick="validateUser(${user.id})">Valider</button>
            <button onclick="deleteUser(${user.id})">Supprimer</button>
          </td>
        `;
        pendingUsersTable.appendChild(row);
      });

      // Afficher les utilisateurs enregistrés
      const registeredUsersTable = document.getElementById('registered-users');
      registeredUsers.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${user.id}</td>
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>${user.project}</td>
          <td>
            <button onclick="deleteUser(${user.id})">Supprimer</button>
          </td>
        `;
        registeredUsersTable.appendChild(row);
      });

      // Fonctions pour gérer les utilisateurs
      function validateUser(userId) {
        alert('Utilisateur ' + userId + ' validé.');
        // Ajoutez ici le code pour valider l'utilisateur (ex : appel à l'API)
      }

      function deleteUser(userId) {
        alert('Utilisateur ' + userId + ' supprimé.');
        // Ajoutez ici le code pour supprimer l'utilisateur (ex : appel à l'API)
      }
    </script>

    <style>
      /* Styles pour le contenu de la page */

.home-content {
  padding: 20px;
}

.users-table {
  background: #fff;
  padding: 20px;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.users-table h2 {
  margin-bottom: 20px;
  font-size: 22px;
  font-weight: 500;
  color: #333;
}

.users-table table {
  width: 100%;
  border-collapse: collapse;
}

.users-table table thead tr {
  background: #2B3A42;
  color: #fff;
  text-align: left;
}

.users-table table th,
.users-table table td {
  padding: 12px 15px;
  border-bottom: 1px solid #ddd;
}

.users-table table tbody tr:hover {
  background: #f1f1f1;
}

.users-table button {
  background: #2B3A42;
  color: #fff;
  border: none;
  padding: 8px 12px;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.users-table button:hover {
  background: #0e98e6;
}

    </style>
  </body>
</html>

