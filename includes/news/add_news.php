<?php
require_once '../db.php';
require_once '../functions.php';

$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];
$tags = $_POST['tags'];
$date = date("Y-m-d");
$time = date("H:i:s");

$img_tmp_name = $_FILES['image']['tmp_name'];
$img_name = $_FILES['image']['name'];
move_uploaded_file($img_tmp_name, $_SERVER['DOCUMENT_ROOT'].'/img/news/'.$img_name);

mysqli_query($db, "INSERT INTO news (`title`, `content`, `img_path`, `tags`, `category`, `views`, `date`, `time`) VALUES ('$title', '$content', '$img_name', '$tags', '$category', '0', '$date', '$time')");

header("Location: /admin");