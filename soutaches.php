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

$tache_id = $_GET['tache_id'];
$projet_id = $_GET['projet_id'];

// Fonction pour récupérer les détails de la tâche
function getTacheDetails($conn, $tache_id) {
    $sql = "SELECT * FROM Tache WHERE IDTache='$tache_id'";
    return $conn->query($sql)->fetch_assoc();
}

if (isset($_POST['modifier_tache'])) {
    $nom_tache = $_POST['nom_tache'];
    $description = $_POST['description'];
    $datedebut = $_POST['datedebut'];
    $datefin = $_POST['datefin'];
    $id_user = $_POST['id_user'];

    $sql = "UPDATE Tache SET Titre='$nom_tache', description='$description', datedebut='$datedebut', datefin='$datefin', IDUser='$id_user' WHERE IDTache='$tache_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Tâche modifiée avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la modification de la tâche: " . $conn->error . "</p>";
    }
}

$tache = getTacheDetails($conn, $tache_id);
?>

<h2>Modifier la Tâche</h2>
<form method="post" action="">
    <label for="nom_tache">Nom de la Tâche:</label>
    <input type="text" id="nom_tache" name="nom_tache" value="<?php echo $tache['Titre']; ?>" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo $tache['description']; ?></textarea>
    <br>
    <label for="datedebut">Date de Début:</label>
    <input type="text" id="datedebut" name="datedebut" value="<?php echo $tache['datedebut']; ?>" required>
    <br>
    <label for="datefin">Date de Fin:</label>
    <input type="text" id="datefin" name="datefin" value="<?php echo $tache['datefin']; ?>" required>
    <br>
    <label for="id_user">ID Utilisateur:</label>
    <input type="number" id="id_user" name="id_user" value="<?php echo $tache['IDUser']; ?>" required>
    <br>
    <button type="submit" name="modifier_tache">Modifier la Tâche</button>
</form>

<a href="projet.php?projet_id=<?php echo $projet_id; ?>">Retour aux tâches</a>

<?php
$conn->close();
?>
