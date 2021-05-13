<?php
require_once '../db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['text'];
$category = $_POST['category'];
$tags = $_POST['tags'];

$query = "UPDATE news SET `id` = '$id', `title` = '$title', `content` = '$content', `category` = '$category', `tags` = '$tags'";

$img_tmp_name = $_FILES['image']['tmp_name'];
$img_name = $_FILES['image']['name'];

if($img_tmp_name != '' && $img_name != '') {
    move_uploaded_file($img_tmp_name, $_SERVER['DOCUMENT_ROOT'].'/img/news/'.$img_name);

    $query .= ", `img_path` = '$img_name'";
}

$query .= " WHERE `id` = $id";

mysqli_query($db, $query);

header("Location: /admin");