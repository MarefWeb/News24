<?php
require_once '../db.php';
require_once '../functions.php';

$id = $_GET['id'];

mysqli_query($db, "DELETE FROM categories WHERE id = '$id'");

header("Location: /admin");