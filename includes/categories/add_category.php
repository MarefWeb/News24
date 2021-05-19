<?php
require_once '../db.php';
require_once '../functions.php';

$name = $_GET['name'];

$stmt = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
$stmt->bind_param("s", $name);
$stmt->execute();
$stmt->close();

header("Location: /admin");