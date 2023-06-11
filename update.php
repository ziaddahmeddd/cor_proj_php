<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("This page is for form submission only.");
}

if (!isset($_SESSION['user'])) {
    die("You are not logged in.");
}

$gender = $_POST['gender'];
$phone = $_POST['phone'];
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];

if (empty($gender) || empty($phone)) {
    die("Please fill in all fields.");
}

if (!password_verify($oldPassword, $_SESSION['user']['password'])) {
    die("Your old password is incorrect.");
}

$usersFile = "**your place for storing the creds.**";
$users = unserialize(file_get_contents($usersFile));

foreach ($users as &$user) {
    if ($user['username'] === $_SESSION['user']['username']) {
        $user['gender'] = $gender;
        $user['phone'] = $phone;
        $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        $_SESSION['user'] = $user;
        file_put_contents($usersFile, serialize($users));
        header("Location: home.html");
        exit();
    }
}

die("Your information could not be updated.");
?>
