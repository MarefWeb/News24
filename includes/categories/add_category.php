<?php
require_once '../db.php';
require_once '../functions.php';

$name = $_GET['name'];

mysqli_query($db, "INSERT INTO categories (name) VALUES ('$name')");

header("Location: /admin");