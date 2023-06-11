<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("This page is for form submission only.");
}

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    die("Please fill in all fields.");
}

$usersFile = "C:/Users/rlss0/OneDrive/Desktop/corelia_proj2/users.txt";

if (!file_exists($usersFile)) {
    die("No users have been registered yet.");
}

$users = unserialize(file_get_contents($usersFile));

foreach ($users as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: home.html");
        exit();
    }
}

die("Invalid username or password.");
?>
