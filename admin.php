<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gate_data";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fonction pour afficher les utilisateurs
function afficherUtilisateurs($conn) {
    $sql = "SELECT * FROM Utilisateur WHERE Statu='en attente' OR Statu='accepter'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<h2>Actions Admin</h2>';
        while($row = $result->fetch_assoc()) {
            echo '<form method="post" action="">';
            echo '<div style="border: 1px solid #000; padding: 10px; margin-bottom: 10px;">';
            echo '<p>ID: ' . $row["IDUser"] . '<br>Nom: ' . $row["Nom"] . '<br>Prénom: ' . $row["Prenom"] . '<br>Statut: ' . $row["Statu"] . '</p>';
            echo '<input type="hidden" name="user_id" value="' . $row["IDUser"] . '">';
            if ($row["Statu"] == 'en attente') {
                echo '<button type="submit" name="accept">Accepter</button> ';
            }
            echo '<button type="submit" name="delete">Supprimer</button>';
            echo '</div>';
            echo '</form>';
        }
    } else {
        echo "<p>Aucun utilisateur à afficher.</p>";
    }
}

// Fonction pour afficher les projets en cours
function afficherProjetsEnCours($conn) {
    $sql = "SELECT * FROM Projet WHERE Statu='En cours'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<h2>Projets en cours</h2>';
        while($row = $result->fetch_assoc()) {
            echo '<form method="post" action="">';
            echo '<div style="border: 1px solid #000; padding: 10px; margin-bottom: 10px;">';
            echo '<p>ID: ' . $row["IDProjet"] . '<br>Nom: ' . $row["nomProjet"] . '<br>Description: ' . $row["descriptionProjet"] . '<br>Durée: ' . $row["Duree_projet"] . '<br>Tâches: ' . $row["tachesprojets"] . '<br>Statut: ' . $row["Statu"] . '<br>Budget: ' . $row["budjet"] . '</p>';
            echo '<input type="hidden" name="projet_id" value="' . $row["IDProjet"] . '">';
            echo '<button type="submit" name="modifier_projet">Modifier</button> ';
            echo '<button type="submit" name="supprimer_projet">Supprimer</button>';
            echo '</div>';
            echo '</form>';
        }
    } else {
        echo "<p>Aucun projet en cours à afficher.</p>";
    }
}

// Accepter un compte utilisateur
if (isset($_POST['accept'])) {
    $user_id = $_POST['user_id'];
    $sql = "UPDATE Utilisateur SET Statu='accepter' WHERE IDUser='$user_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Compte utilisateur accepté avec succès.</p>";
    } else {
        echo "<p>Erreur lors de l'acceptation du compte: " . $conn->error . "</p>";
    }
}

// Supprimer un compte utilisateur
if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    
    // Supprimer d'abord les enregistrements dépendants dans la table 'creer'
    $sql = "DELETE FROM creer WHERE IDUser='$user_id'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        // Ensuite, supprimer l'utilisateur de la table 'Utilisateur'
        $sql = "DELETE FROM Utilisateur WHERE IDUser='$user_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Compte utilisateur et les données associées supprimés avec succès.</p>";
        } else {
            echo "<p>Erreur lors de la suppression du compte utilisateur: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Erreur lors de la suppression des données associées: " . $conn->error . "</p>";
    }
}

// Créer un projet
if (isset($_POST['creer_projet'])) {
    $nom_projet = $_POST['nom_projet'];
    $description = $_POST['description'];
    $duree_projet = $_POST['duree_projet'];
    $tachesprojets = $_POST['tachesprojets'];
    $statu = $_POST['statu'];
    $budjet = $_POST['budjet'];

    $sql = "INSERT INTO Projet (nomProjet, Duree_projet, descriptionProjet, tachesprojets, Statu, budjet) VALUES ('$nom_projet', '$duree_projet', '$description', '$tachesprojets', '$statu', '$budjet')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Projet créé avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la création du projet: " . $conn->error . "</p>";
    }
}

// Modifier un projet
if (isset($_POST['modifier_projet'])) {
    $projet_id = $_POST['projet_id'];
    $sql = "SELECT * FROM Projet WHERE IDProjet='$projet_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<h2>Modifier le Projet</h2>';
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="projet_id" value="' . $row["IDProjet"] . '">';
        echo '<label for="nom_projet">Nom du Projet:</label>';
        echo '<input type="text" id="nom_projet" name="nom_projet" value="' . $row["nomProjet"] . '" required>';
        echo '<br>';
        echo '<label for="description">Description:</label>';
        echo '<textarea id="description" name="description" required>' . $row["descriptionProjet"] . '</textarea>';
        echo '<br>';
        echo '<label for="duree_projet">Durée du Projet:</label>';
        echo '<input type="text" id="duree_projet" name="duree_projet" value="' . $row["Duree_projet"] . '" required>';
        echo '<br>';
        echo '<label for="tachesprojets">Tâches du Projet:</label>';
        echo '<input type="text" id="tachesprojets" name="tachesprojets" value="' . $row["tachesprojets"] . '" required>';
        echo '<br>';
        echo '<label for="statu">Statut:</label>';
        echo '<input type="text" id="statu" name="statu" value="' . $row["Statu"] . '" required>';
        echo '<br>';
        echo '<label for="budjet">Budget:</label>';
        echo '<input type="number" id="budjet" name="budjet" value="' . $row["budjet"] . '" required>';
        echo '<br>';
        echo '<button type="submit" name="sauvegarder_projet">Sauvegarder</button>';
        echo '</form>';
    }
}

// Sauvegarder les modifications d'un projet
if (isset($_POST['sauvegarder_projet'])) {
    $projet_id = $_POST['projet_id'];
    $nom_projet = $_POST['nom_projet'];
    $description = $_POST['description'];
    $duree_projet = $_POST['duree_projet'];
    $tachesprojets = $_POST['tachesprojets'];
    $statu = $_POST['statu'];
    $budjet = $_POST['budjet'];

    $sql = "UPDATE Projet SET nomProjet='$nom_projet', Duree_projet='$duree_projet', descriptionProjet='$description', tachesprojets='$tachesprojets', Statu='$statu', budjet='$budjet' WHERE IDProjet='$projet_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Projet modifié avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la modification du projet: " . $conn->error . "</p>";
    }
}

// Supprimer un projet
if (isset($_POST['supprimer_projet'])) {
    $projet_id = $_POST['projet_id'];
    
    // Supprimer d'abord les enregistrements dépendants dans les autres tables si nécessaire
    $sql = "DELETE FROM creer WHERE IDProjet='$projet_id'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        // Ensuite, supprimer le projet de la table 'Projet'
        $sql = "DELETE FROM Projet WHERE IDProjet='$projet_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Projet supprimé avec succès.</p>";
        } else {
            echo "<p>Erreur lors de la suppression du projet: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Erreur lors de la suppression des données associées: " . $conn->error . "</p>";
    }
}

?>

<h2>Créer un Projet</h2>
<form method="post" action="">
    <label for="nom_projet">Nom du Projet:</label>
    <input type="text" id="nom_projet" name="nom_projet" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>
    <br>
    <label for="duree_projet">Durée du Projet:</label>
    <input type="text" id="duree_projet" name="duree_projet" required>
    <br>
    <label for="tachesprojets">Tâches du Projet:</label>
    <input type="text" id="tachesprojets" name="tachesprojets" required>
    <br>
    <label for="statu">Statut:</label>
    <input type="text" id="statu" name="statu" required>
    <br>
    <label for="budjet">Budget:</label>
    <input type="number" id="budjet" name="budjet" required>
    <br>
    <button type="submit" name="creer_projet">Créer le Projet</button>
</form>


<?php
afficherUtilisateurs($conn);
afficherProjetsEnCours($conn);
$conn->close();
?>
