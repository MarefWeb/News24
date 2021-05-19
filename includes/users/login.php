<?php
require_once '../db.php';
require_once '../functions.php';
require_once 'user_session.php';

$login = $_POST['login'];
$password = $_POST['password'];
$exists = is_account_exists($db, $login, $password);

if($exists) {
    $user_id = $exists;
    start_user_session($db, $user_id);

    header('Location: /');
}
else {
    header('Location: /login.php?exists=false');
}