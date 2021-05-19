<?php
require_once '../db.php';
require_once '../functions.php';
require_once 'user_session.php';

function is_exist($db, $value, $field) {
    $query = mysqli_query($db, "SELECT * FROM users WHERE $field = '$value'");
    $res = mysqli_fetch_assoc($query) == NULL ? false : true;
    return $res;
}

$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$username = $_POST['username'];
$notifications = $_POST['notifications'];

$is_exist_email = is_exist($db, $email, 'email');
$is_exist_username = is_exist($db, $username, 'username');
$is_exist_login = is_exist($db, $login, 'login');

if($is_exist_email) {
    header('Location: /register.php?email=true');
}
else if($is_exist_username) {
    header('Location: /register.php?username=true');
}
else if($is_exist_login) {
    header('Location: /register.php?login=true');
}
else {
    $status = 1;

    $stmt = $mysqli->prepare("INSERT INTO users (`login`, `password`, `username`, `email`, `status`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $login, $password, $username, $email, $status);
    $stmt->execute();

    $stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ? AND `username` = ? AND `email` = ?");
    $stmt->bind_param("ssss", $login, $password, $username, $email);
    $stmt->execute();
    $user_res = $stmt->get_result();
    $user_id = mysqli_fetch_assoc($user_res)['id'];

    start_user_session($db, $user_id);

    if($notifications) {
        $stmt = $mysqli->prepare("INSERT INTO emails_for_notifications (`email`) VALUES (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
    }

    $stmt->close();
    $user_res->close();

    header('Location: /');
}