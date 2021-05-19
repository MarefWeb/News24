<?php 
require_once '../db.php';
require_once '../functions.php';

$email = $_GET['email'];
$emails_query = mysqli_query($db, "DELETE FROM `emails_for_notifications` WHERE `email` = '$email'");

header('Location: /');