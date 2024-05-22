<?php
session_start();

$user_nom = $user_prenom = $admin_nom = $admin_prenom = "";

if (isset($_SESSION['user_id'])) {
    $user_nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : "";
    $user_prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : "";
}

if (isset($_SESSION['admin_id'])) {
    $admin_nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : "";
    $admin_prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate</title>
</head>
<body>
    <div>
        <h1>Gate</h1>
        <?php if (isset($_SESSION['admin_id'])) : ?>
            <div>
                <p>Bonjour, <?php echo htmlspecialchars($admin_prenom . ' ' . $admin_nom); ?></p>
                <form method="post" action="http://localhost/Gate/password">
                    <button type="submit">Changer le mot de passe</button>
                </form>
                <form method="post" action="http://localhost/Gate/admin">
                    <button type="submit">Admin</button>
                </form>
                <form method="post" action="http://localhost/Gate/logout.php">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>
        <?php elseif (isset($_SESSION['user_id'])) : ?>
            <div>
                <p>Bonjour, <?php echo htmlspecialchars($user_prenom . ' ' . $user_nom); ?></p>
                <form method="post" action="http://localhost/Gate/password">
                    <button type="submit">Changer le mot de passe</button>
                </form>
                <form method="post" action="http://localhost/Gate/edit">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <button type="submit">Compte</button>
                </form>
                <form method="post" action="http://localhost/Gate/logout.php">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>
        <?php else : ?>
            <form method="post" action="http://localhost/Gate/login">
                <button type="submit">Connexion</button>
            </form>
            <form method="post" action="http://localhost/Gate/signup">
                <button type="submit">Inscription</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>