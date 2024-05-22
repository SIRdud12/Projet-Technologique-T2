<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Check if email is already used
    $query_check_email = "SELECT * FROM Utilisateur WHERE Email = ?";
    $stmt_check_email = mysqli_prepare($connection, $query_check_email);
    mysqli_stmt_bind_param($stmt_check_email, "s", $mail);
    mysqli_stmt_execute($stmt_check_email);
    $result_check_email = mysqli_stmt_get_result($stmt_check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
        $error_message = 'Cette adresse e-mail est déjà utilisée.';
    } elseif ($password !== $password_confirm) {
        $error_message = 'Les mots de passe ne correspondent pas.';
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'L\'adresse email n\'est pas valide.';
    } else {
        $roles = 'User';
        $Statu = 'en attente';

        // Correcting the number of values in the INSERT statement
        $query = "INSERT INTO Utilisateur (Email, MDP, Nom, Prenom, roles, Statu) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $mail, $password, $nom, $prenom, $roles, $Statu);
        
        if (mysqli_stmt_execute($stmt)) {
            $userId = mysqli_insert_id($connection);
            $_SESSION['user_id'] = $userId;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['mail'] = $mail;
            header('Location: ../index.php');
            exit();
        } else {
            $error_message = 'Une erreur s\'est produite lors de l\'inscription.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <form method="post" action="">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required><br>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" required><br>
        <label for="mail">Mail:</label>
        <input type="email" name="mail" required><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br>
        <label for="password_confirm">Confirmer le mot de passe:</label>
        <input type="password" name="password_confirm" required><br>
        <button type="submit">S'inscrire</button>
    </form>
    <form method="post" action="../index.php">
        <button type="submit">Accueil</button>
    </form>
</body>
</html>