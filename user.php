<?php
session_start();

if (!isset($_SESSION['user'])) {
    die("You are not logged in.");
}

$user = $_SESSION['user'];
unset($user['password']);
echo json_encode($user);
?>
