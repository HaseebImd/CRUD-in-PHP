<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($check) > 0) {
        header("Location: signup.php?error=Email already exists!");
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users (name, email, password, address) VALUES ('$name', '$email', '$hashed_password', '$address')";

    if (mysqli_query($conn, $sql)) {
        header("Location: signup.php?success=Registration successful! Please login.");
        exit();
    } else {
        header("Location: signup.php?error=Something went wrong!");
        exit();
    }
}

header("Location: signup.php");
exit();
?>
