<?php
require_once '../db.php';

$new_access_id = $_GET['access'];
$user_id = $_GET['user'];

mysqli_query($db, "UPDATE `users` SET `status` = '$new_access_id' WHERE `id` = '$user_id'");

header("Location: /admin");