<?php
include 'config.php';

// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM tasks WHERE id = $id";
    mysqli_query($conn, $sql);
}

header("Location: home.php");
exit();
?>
