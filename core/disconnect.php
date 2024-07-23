<?php

require '../config/dbconnect.php';

session_start();

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("DELETE FROM user_tokens WHERE user_id = ?");
    $stmt->execute([$user_id]);
}

session_unset();
session_destroy();

header('Location: ../config/auth.php');
exit();
?>
