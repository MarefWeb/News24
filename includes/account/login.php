<?php
require_once '../db.php';
require_once '../functions.php';
session_start();

$login = $_POST['login'];
$password = $_POST['password'];
$exists = is_account_exists($login, $password, $db);

$_SESSION['login'] = $login;
$_SESSION['password'] = $password;

if($exists) {
    header('Location: /admin/content.php');
} else {
    header('Location: /admin?exists=false');
}