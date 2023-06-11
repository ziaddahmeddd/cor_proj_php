<?php
session_start();

if (!isset($_SESSION['user'])) {
    die("You are not logged in.");
}

$usersFile = "**your place for storing the creds.**";
$users = unserialize(file_get_contents($usersFile));

foreach ($users as $index => $user) {
    if ($user['username'] === $_SESSION['user']['username']) {
        array_splice($users, $index, 1);
        file_put_contents($usersFile, serialize($users));
        session_destroy();
        header("Location: index.html");
        exit();
    }
}

die("Your account could not be deleted.");
?>
