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

$tache_id = intval($_GET['id']); // Sécuriser l'ID de la tâche

// Fonction pour afficher les documents
function afficherDocuments($conn, $tache_id) {
    $sql = "SELECT * FROM Dossier WHERE IDTache=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tache_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<h2>Documents</h2>';
        while($row = $result->fetch_assoc()) {
            echo '<div style="border: 1px solid #000; padding: 10px; margin-bottom: 10px;">';
            echo '<p>ID: ' . htmlspecialchars($row["IDDocumment"]) . '<br>Nom: ' . htmlspecialchars($row["Nom"]) . '<br>Chemin: ' . htmlspecialchars($row["url"]) . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>Aucun document à afficher.</p>";
    }
    $stmt->close();
}

// Fonction pour ajouter un document
if (isset($_POST['ajouter_document'])) {
    $nom_document = $conn->real_escape_string($_POST['nom_document']);
    $chemin_document = "uploads/" . basename($_FILES["chemin_document"]["name"]);
    
    if (move_uploaded_file($_FILES["chemin_document"]["tmp_name"], $chemin_document)) {
        $sql = "INSERT INTO Dossier (Nom, url, dateup, IDUser, idProjet, IDProjet__contenir1) VALUES (?, ?, NOW(), 1, 1, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nom_document, $chemin_document);
        
        if ($stmt->execute()) {
            echo "<p>Document ajouté avec succès.</p>";
        } else {
            echo "<p>Erreur lors de l'ajout du document: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Erreur lors du téléchargement du fichier.</p>";
    }
}

// Fonction pour afficher les commentaires
function afficherCommentaires($conn, $tache_id) {
    $sql = "SELECT * FROM commentaire WHERE IDTache=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tache_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<h2>Commentaires</h2>';
        while($row = $result->fetch_assoc()) {
            echo '<div style="border: 1px solid #000; padding: 10px; margin-bottom: 10px;">';
            echo '<p>ID: ' . htmlspecialchars($row["IDcommentaire"]) . '<br>Contenu: ' . htmlspecialchars($row["contenu"]) . '<br>Date: ' . htmlspecialchars($row["datecrea"]) . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>Aucun commentaire à afficher.</p>";
    }
    $stmt->close();
}

// Fonction pour ajouter un commentaire
if (isset($_POST['ajouter_commentaire'])) {
    $contenu = $conn->real_escape_string($_POST['contenu']);
    $id_user = intval($_POST['id_user']);

    $sql = "INSERT INTO commentaire (contenu, datecrea, IDTache, IDUser, IDTache_contenir2) VALUES (?, NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $contenu, $tache_id, $id_user, $tache_id);
    
    if ($stmt->execute()) {
        echo "<p>Commentaire ajouté avec succès.</p>";
    } else {
        echo "<p>Erreur lors de l'ajout du commentaire: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

?>

<h2>Ajouter un Document</h2>
<form method="post" enctype="multipart/form-data" action="">
    <label for="nom_document">Nom du Document:</label>
    <input type="text" id="nom_document" name="nom_document" required>
    <br>
    <label for="chemin_document">Choisir un fichier:</label>
    <input type="file" id="chemin_document" name="chemin_document" required>
    <br>
    <button type="submit" name="ajouter_document">Ajouter le Document</button>
</form>

<h2>Ajouter un Commentaire</h2>
<form method="post" action="">
    <label for="contenu">Commentaire:</label>
    <textarea id="contenu" name="contenu" required></textarea>
    <br>
    <label for="id_user">ID Utilisateur:</label>
    <input type="number" id="id_user" name="id_user" required>
    <br>
    <button type="submit" name="ajouter_commentaire">Ajouter le Commentaire</button>
</form>

<?php
afficherDocuments($conn, $tache_id);
afficherCommentaires($conn, $tache_id);
$conn->close();
?>
