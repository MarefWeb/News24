<?php
require_once '../db.php';
require_once '../functions.php';
require_once '../users/send_notification.php';

$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];
$tags = $_POST['tags'];
$date = date("Y-m-d");
$time = date("H:i:s");
$views = 0;

$img_tmp_name = $_FILES['image']['tmp_name'];
$img_name = $_FILES['image']['name'];
move_uploaded_file($img_tmp_name, $_SERVER['DOCUMENT_ROOT'].'/img/news/'.$img_name);

$stmt = $mysqli->prepare("INSERT INTO `news` (`title`, `content`, `img_path`, `tags`, `category`, `views`, `date`, `time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $title, $content, $img_name, $tags, $category, $views, $date, $time);
$stmt->execute();

$stmt = $mysqli->prepare("SELECT * FROM `news` WHERE `title` = ? and `content` = ? and `category` = ? and `tags` = ? and `date` = ? and `time` = ?");
$stmt->bind_param('ssssss', $title, $content, $category, $tags, $date, $time);
$stmt->execute();
$curr_news_res = $stmt->get_result();
$curr_news_id = mysqli_fetch_assoc($curr_news_res)['id'];

$curr_news_res->close();
$stmt->close();

$short_content = mb_strimwidth($content, 0, 450, "...");
$news_link = 'http://' . $_SERVER['HTTP_HOST'] . "/details?id=$curr_news_id";
$email_content = "<h3>$title</h3>
<p style='margin: 10px, 0, 5px, 0;'>$short_content</p>
<a href='$news_link'>Читати далі...</a>";
send_notification($db, $title, $email_content);

header('Location: /admin');