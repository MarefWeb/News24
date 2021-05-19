<?php
require_once '../db.php';
require_once '../functions.php';
session_start();

$comment = $_POST['comment'];
$news_id = $_POST['news_id'];
$user_id = $_SESSION['id'];

$stmt = $mysqli->prepare("INSERT INTO `comments` (`text`, `news_id`, `user_id`) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $comment, $news_id, $user_id);
$stmt->execute();
$stmt->close();

if ($_SERVER['HTTP_REFERER'] != null) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
else {
    header('Location: /');
}