<?php
include 'config.php';

// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (title, description, status) VALUES ('$title', '$description', '$status')";

    mysqli_query($conn, $sql);
}

header("Location: home.php");
exit();
?>
