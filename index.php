<?php
session_start();
include('db.php');

// Check if the user is logged in and has the 'Admin' status
if (!isset($_SESSION['user_id']) || $_SESSION['statu'] !== 'Admin') {
    echo "Erreur : Vous n'êtes pas autorisé à accéder à cette page.";
    exit();
}

// Redirect to dashboard.php if the user is an admin
header('Location: dashboard.php');
exit();
?>