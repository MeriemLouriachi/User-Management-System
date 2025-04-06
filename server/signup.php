<?php
require 'config.php'; // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname =htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $confirmpass = $_POST["confirm-password"];


    if (empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($confirmpass)) {
        die("❌ All fields are required!");
    }

    if ($password !== $confirmpass) {
        die("❌ Passwords do not match!");
    }

    $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $userExists = $stmt->fetchColumn();

     $form_type = $_POST["form_type"] ?? '';

    if ($userExists > 0 ) {
     header("Location: ../err.php?form_type=" . urlencode($form_type));
      exit();
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if ($form_type === 'signup') {
        //For signup form
        $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstname, $lastname, $username, $hashed_password]);

        header("Location: ../index.html");
        exit();
    } elseif ($form_type === 'add_user') {
        //For add user form
        $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstname, $lastname, $username, $hashed_password]);

        header("Location: ../dashboard.php");
        exit();
    }
} else {
    // Redirect if the page is accessed directly
    header("Location: ../index.html");
    exit();
}
