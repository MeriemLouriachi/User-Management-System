<?php
require 'config.php'; 
session_start(); // Start a session for user auth

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(htmlspecialchars($_POST["username"]));
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        die("❌ Username and password are required!");
    }

    $sql = "SELECT username, password FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    //Check if user exists and verify password
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];

        header("Location: ../dashboard.php");
        exit();
    } else {
        die("❌ Invalid username or password.");
    }
} else {
    // Redirect if accessed directly
    header("Location: ../index.html");
    exit();
}
?>
