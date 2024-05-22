<?php
session_start();
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $query_user = "SELECT * FROM Utilisateur WHERE Email = ? AND MDP = ?";
    $stmt_user = mysqli_prepare($connection, $query_user);
    mysqli_stmt_bind_param($stmt_user, "ss", $mail, $password);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);

    if ($user = mysqli_fetch_assoc($result_user)) {
        $_SESSION['user_id'] = $user['IDUser'];
        $_SESSION['nom'] = $user['Nom'];
        $_SESSION['prenom'] = $user['Prenom'];
        $_SESSION['mail'] = $user['Email'];
        $_SESSION['roles'] = $user['roles'];

        if ($user['roles'] === 'Admin') {
            $_SESSION['admin_id'] = $user['IDUser'];
        }

        header('Location: ../index.php');
        exit();
    } else {
        $error_message = 'Identifiants incorrects';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <form method="post" action="">
        <label for="mail">Mail:</label>
        <input type="email" name="mail" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Connexion</button>
    </form>
    <form method="post" action="../index.php">
        <button type="submit">Accueil</button>
    </form>
</body>
</html>