<?php
require_once '../db.php';

$id = $_GET['id'];

mysqli_query($db, "DELETE FROM news WHERE `id` = $id");

header('Location: /admin');
