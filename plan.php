<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
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
          <a href="plan.php" class="active">
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
          <a href="gestion_client.php" >
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
        <!--
        <li>
          <a href="#">
            <i class="bx bx-book-alt"></i>
            <span class="links_name">Tout les commandes</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span class="links_name">Utilisateur</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="links_name">Configuration</span>
          </a>
        </li>
      -->
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
          <span class="dashboard">Plan</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Recherche..." />
          <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
          <!--<img src="images/profile.jpg" alt="">-->
          <span class="admin_name">Komche</span>
          <i class="bx bx-chevron-down"></i>
        </div>
      </nav>

      <div class="project-management">
        <h2>Gestion de Projet</h2>
        <div class="task-list">
          <div class="task-header">
            <span>Tâche</span>
            <span>Date Limite</span>
            <span>Actions</span>
          </div>
          <!-- Liste des tâches sera ajoutée ici dynamiquement -->
        </div>
        <div class="task-actions">
          <input type="text" id="new-task" placeholder="Nouvelle tâche..." />
          <input type="date" id="new-task-deadline" />
          <button onclick="addTask()">Ajouter Tâche</button>
        </div>
      </div>

      <div class="project-participants">
        <h2>Participants du Projet</h2>
        <div class="participant-list">
          <div class="participant-header">
            <span>Nom</span>
            <span>Rôle</span>
          </div>
          <!-- Liste des participants sera ajoutée ici dynamiquement -->
        </div>
        <div class="participant-actions">
          <input type="text" id="new-participant-name" placeholder="Nom du participant..." />
          <input type="text" id="new-participant-role" placeholder="Rôle du participant..." />
          <button onclick="addParticipant()">Ajouter Participant</button>
        </div>
      </div>

      <div class="project-teams">
        <h2>Création et Gestion des Équipes</h2>
        <div class="team-list">
          <div class="team-header">
            <span>Équipe</span>
            <span>Membres</span>
            <span>Actions</span>
          </div>
          <!-- Liste des équipes sera ajoutée ici dynamiquement -->
        </div>
        <div class="team-actions">
          <input type="text" id="new-team-name" placeholder="Nom de l'équipe..." />
          <button onclick="addTeam()">Créer Équipe</button>
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

      let tasks = [];
      let participants = [];
      let teams = [];

      function addTask() {
        const taskInput = document.getElementById('new-task');
        const taskDeadlineInput = document.getElementById('new-task-deadline');
        const taskName = taskInput.value;
        const taskDeadline = taskDeadlineInput.value;

        if (taskName && taskDeadline) {
          const task = {
            id: tasks.length + 1,
            name: taskName,
            deadline: taskDeadline,
            done: false
          };
          tasks.push(task);
          renderTasks();
          taskInput.value = '';
          taskDeadlineInput.value = '';
        }
      }

      function deleteTask(taskId) {
        tasks = tasks.filter(task => task.id !== taskId);
        renderTasks();
      }

      function toggleTaskDone(taskId) {
        const task = tasks.find(task => task.id === taskId);
        if (task) {
          task.done = !task.done;
          renderTasks();
        }
      }

      function renderTasks() {
        const taskList = document.querySelector('.task-list');
        taskList.innerHTML = `
          <div class="task-header">
            <span>Tâche</span>
            <span>Date Limite</span>
            <span>Actions</span>
          </div>
        `;

        tasks.forEach(task => {
          const taskElement = document.createElement('div');
          taskElement.className = 'task';
          taskElement.innerHTML = `
            <input type="checkbox" ${task.done ? 'checked' : ''} onclick="toggleTaskDone(${task.id})">
            <span class="task-name ${task.done ? 'done' : ''}">${task.name}</span>
            <span class="task-deadline">${task.deadline}</span>
            <button onclick="deleteTask(${task.id})">Supprimer</button>
          `;
          taskList.appendChild(taskElement);
        });
      }

      function addParticipant() {
        const participantNameInput = document.getElementById('new-participant-name');
        const participantRoleInput = document.getElementById('new-participant-role');
        const participantName = participantNameInput.value;
        const participantRole = participantRoleInput.value;

        if (participantName && participantRole) {
          const participant = {
            name: participantName,
            role: participantRole
          };
          participants.push(participant);
          renderParticipants();
          participantNameInput.value = '';
          participantRoleInput.value = '';
        }
      }

      function renderParticipants() {
        const participantList = document.querySelector('.participant-list');
        participantList.innerHTML = `
          <div class="participant-header">
            <span>Nom</span>
            <span>Rôle</span>
          </div>
        `;

        participants.forEach(participant => {
          const participantElement = document.createElement('div');
          participantElement.className = 'participant';
          participantElement.innerHTML = `
            <span class="participant-name">${participant.name}</span>
            <span class="participant-role">${participant.role}</span>
          `;
          participantList.appendChild(participantElement);
        });
      }

      function addTeam() {
        const teamNameInput = document.getElementById('new-team-name');
        const teamName = teamNameInput.value;

        if (teamName) {
          const team = {
            id: teams.length + 1,
            name: teamName,
            members: []
          };
          teams.push(team);
          renderTeams();
          teamNameInput.value = '';
        }
      }

      function renderTeams() {
        const teamList = document.querySelector('.team-list');
        teamList.innerHTML = `
          <div class="team-header">
            <span>Équipe</span>
            <span>Membres</span>
            <span>Actions</span>
          </div>
        `;

        teams.forEach(team => {
          const teamElement = document.createElement('div');
          teamElement.className = 'team';
          teamElement.innerHTML = `
            <span class="team-name">${team.name}</span>
            <span class="team-members">${team.members.join(', ')}</span>
            <button onclick="addMemberToTeam(${team.id})">Ajouter Membre</button>
            <button onclick="deleteTeam(${team.id})">Supprimer Équipe</button>
          `;
          teamList.appendChild(teamElement);
        });
      }

      function addMemberToTeam(teamId) {
        const memberName = prompt('Nom du membre à ajouter:');
        if (memberName) {
          const team = teams.find(team => team.id === teamId);
          if (team) {
            team.members.push(memberName);
            renderTeams();
          }
        }
      }

      function deleteTeam(teamId) {
        teams = teams.filter(team => team.id !== teamId);
        renderTeams();
      }

      renderTasks();
      renderParticipants();
      renderTeams();
    </script>

    <style>
      .project-management, .project-participants, .project-teams {
        padding: 80px;
        margin-bottom: 10px;
      }

      .task-list, .participant-list, .team-list {
        margin-bottom: 20px;
      }

      .task-header, .participant-header, .team-header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        padding: 10px;
        border-bottom: 1px solid #ccc;
      }

      .task, .participant, .team {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 5px;
      }

      .task .task-name.done {
        text-decoration: line-through;
      }

      .task-actions, .participant-actions, .team-actions {
        display: flex;
        gap: 10px;
      }

      .task-actions input, .participant-actions input, .team-actions input, .task-actions button, .participant-actions button, .team-actions button {
        padding: 10px;
        font-size: 16px;
      }
    </style>
  </body>
</html>



