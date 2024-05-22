<?php
session_start();
include '../db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];
} else {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$connection) {
        die("Erreur de connexion à la base de données: " . mysqli_connect_error());
    }

    $query = "SELECT MDP, roles FROM Utilisateur WHERE IdUser = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $current_password = $row['MDP'];
    $roles = $row['roles'];

    if ($current_password === $_POST['current_password']) {
        $new_password = $_POST['new_password'];
        $query_update = "UPDATE Utilisateur SET MDP = ? WHERE IdUser = ?";
        $stmt_update = mysqli_prepare($connection, $query_update);
        mysqli_stmt_bind_param($stmt_update, "ss", $new_password, $user_id);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);

        $success_message = "Mot de passe modifié avec succès.";
    } else {
        $error_message = "Mot de passe actuel incorrect.";
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
</head>
<body>
    <h2>Changer le mot de passe</h2>
    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php elseif (isset($success_message)) : ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
    
    <form method="post" action="">
        <label for="current_password">Mot de passe actuel :</label>
        <input type="password" name="current_password" required><br>
        <label for="new_password">Nouveau mot de passe :</label>
        <input type="password" name="new_password" required><br>
        <label for="confirm_new_password">Confirmer le nouveau mot de passe :</label>
        <input type="password" name="confirm_new_password" required><br>
        <button type="submit">Changer le mot de passe</button>
    </form>
    <form method="post" action="../index.php">
        <button type="submit">Accueil</button>
    </form>
</body>
</html>