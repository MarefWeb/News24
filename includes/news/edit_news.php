<?php
require_once '../db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['text'];
$category = $_POST['category'];
$tags = $_POST['tags'];

$query = "UPDATE news SET `id` = ?, `title` = ?, `content` = ?, `category` = ?, `tags` = ?";

$img_tmp_name = $_FILES['image']['tmp_name'];
$img_name = $_FILES['image']['name'];

if($img_tmp_name != '' && $img_name != '') {
    move_uploaded_file($img_tmp_name, $_SERVER['DOCUMENT_ROOT'].'/img/news/'.$img_name);

    $query .= ", `img_path` = ?";
}

$query .= " WHERE `id` = ?";


$stmt = $mysqli->prepare($query);

if($img_tmp_name != '' && $img_name != '')
    $stmt->bind_param("sssssss", $id, $title, $content, $category, $tags, $img_name, $id);
else
$stmt->bind_param("ssssss", $id, $title, $content, $category, $tags, $id);

$stmt->execute();
$stmt->close();

if ($_SERVER['HTTP_REFERER'] != null) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
else {
    header('Location: /');
}