<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("This page is for form submission only.");
}

$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];

if (empty($username) || empty($password) || empty($gender) || empty($phone)) {
    die("Please fill in all fields.");
}

$usersFile = "**your place for storing the creds.**";

if (file_exists($usersFile)) {
    $users = unserialize(file_get_contents($usersFile));

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            die("This username is already taken.");
        }
    }
} else {
    $users = [];
}

$newUser = [
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'gender' => $gender,
    'phone' => $phone
];

$users[] = $newUser;
file_put_contents($usersFile, serialize($users));
header("Location: index.html");
exit();
?>
