<?php
    require_once '../includes/db.php';
    require_once '../includes/functions.php';
	require_once '../includes/users/user_session.php';
	session_start();

    $news_id = $_GET['id'];

    if($_COOKIE["page_$news_id"] == null) {
        $news_views_query = mysqli_query($db, "SELECT views FROM news WHERE `id` = '$news_id'");
        $news_views_data = mysqli_fetch_assoc($news_views_query);

        $new_views_value = $news_views_data['views'] + 1;
        mysqli_query($db, "UPDATE news SET views = $new_views_value WHERE id = $news_id");
        setcookie("page_$news_id", true);
    }

    $news_query = mysqli_query($db, "SELECT * FROM news WHERE `id` = '$news_id'");
    $news_data = mysqli_fetch_assoc($news_query);

    $time = $news_data['time'];
    $title = $news_data['title'];
    $content = $news_data['content'];
    $tags = $news_data['tags'];
    $date = $news_data['date'];
    $time = $news_data['time'];
    $category = $news_data['category'];
    $img_path = $news_data['img_path'];
    $views = $news_data['views'];

    $time_arr = explode(':', $time);
    $time_hours_minutes = $time_arr[0] . ':' . $time_arr[1];

    $formated_date = implode('.', array_reverse(explode('-', $date)));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title><?php echo $title ?></title>
        <link rel="apple-touch-icon" sizes="57x57" href="../img/favicon/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="60x60" href="../img/favicon/apple-icon-60x60.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../img/favicon/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="../img/favicon/apple-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../img/favicon/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="../img/favicon/apple-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../img/favicon/apple-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="../img/favicon/apple-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-icon-180x180.png" />
        <link rel="icon" type="image/png" sizes="192x192" href="../img/favicon/android-icon-192x192.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="96x96" href="../img/favicon/favicon-96x96.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body>
        <?php require_once '../components/header.php' ?>
        <main class="main">
            <div class="container">
                <div class="main__inner">
                    <div class="news__content">
                    <?php
                        if(has_edit_access()) {
                    ?>
                        <div class="edit">
                            <div class="edit-btn" id="edit-btn">
                                <svg height="401pt" viewBox="0 -1 401.52289 401" width="401pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m370.589844 250.972656c-5.523438 0-10 4.476563-10 10v88.789063c-.019532 16.5625-13.4375 29.984375-30 30h-280.589844c-16.5625-.015625-29.980469-13.4375-30-30v-260.589844c.019531-16.558594 13.4375-29.980469 30-30h88.789062c5.523438 0 10-4.476563 10-10 0-5.519531-4.476562-10-10-10h-88.789062c-27.601562.03125-49.96875 22.398437-50 50v260.59375c.03125 27.601563 22.398438 49.96875 50 50h280.589844c27.601562-.03125 49.96875-22.398437 50-50v-88.792969c0-5.523437-4.476563-10-10-10zm0 0"/>
                                    <path d="m376.628906 13.441406c-17.574218-17.574218-46.066406-17.574218-63.640625 0l-178.40625 178.40625c-1.222656 1.222656-2.105469 2.738282-2.566406 4.402344l-23.460937 84.699219c-.964844 3.472656.015624 7.191406 2.5625 9.742187 2.550781 2.546875 6.269531 3.527344 9.742187 2.566406l84.699219-23.464843c1.664062-.460938 3.179687-1.34375 4.402344-2.566407l178.402343-178.410156c17.546875-17.585937 17.546875-46.054687 0-63.640625zm-220.257812 184.90625 146.011718-146.015625 47.089844 47.089844-146.015625 146.015625zm-9.40625 18.875 37.621094 37.625-52.039063 14.417969zm227.257812-142.546875-10.605468 10.605469-47.09375-47.09375 10.609374-10.605469c9.761719-9.761719 25.589844-9.761719 35.351563 0l11.738281 11.734375c9.746094 9.773438 9.746094 25.589844 0 35.359375zm0 0"/>
                                </svg>
                                <span>Редагувати</span>
                            </div>
                        </div>
                    <?php 
                        } 
                    ?>
                        <div class="upper-line">
                            <p class="date"><?php echo "$formated_date, $time_hours_minutes" ?></p>
                            <div class='views'>
                                <span><?php echo $views ?></span>
                                <svg
                                    version='1.1'
                                    id='Capa_1'
                                    xmlns='http://www.w3.org/2000/svg'
                                    xmlns:xlink='http://www.w3.org/1999/xlink'
                                    x='0px'
                                    y='0px'
                                    viewBox='0 0 511.999 511.999'
                                    style='enable-background: new 0 0 511.999 511.999'
                                    xml:space='preserve'
                                    >
                                    <g>
                                        <path
                                            d='M508.745,246.041c-4.574-6.257-113.557-153.206-252.748-153.206S7.818,239.784,3.249,246.035
                                            c-4.332,5.936-4.332,13.987,0,19.923c4.569,6.257,113.557,153.206,252.748,153.206s248.174-146.95,252.748-153.201
                                            C513.083,260.028,513.083,251.971,508.745,246.041z M255.997,385.406c-102.529,0-191.33-97.533-217.617-129.418
                                            c26.253-31.913,114.868-129.395,217.617-129.395c102.524,0,191.319,97.516,217.617,129.418
                                            C447.361,287.923,358.746,385.406,255.997,385.406z'
                                        />
                                    </g>
                                    <g>
                                        <path
                                            d='M255.997,154.725c-55.842,0-101.275,45.433-101.275,101.275s45.433,101.275,101.275,101.275
                                            s101.275-45.433,101.275-101.275S311.839,154.725,255.997,154.725z M255.997,323.516c-37.23,0-67.516-30.287-67.516-67.516
                                            s30.287-67.516,67.516-67.516s67.516,30.287,67.516,67.516S293.227,323.516,255.997,323.516z'
                                        />
                                    </g>
                                </svg>
                            </div>
                        </div>
                    <?php
                        if(has_edit_access()) {
                    ?>
                        <form action="/includes/news/edit_news.php" method="post" class="edit-form hidden" id="edit-form">
                            <input type="hidden" name="id" value="<?php echo $news_id; ?>">
                            <input type="hidden" name="category" value="<?php echo $category; ?>">
                            <textarea name="title" class="title"><?php echo $title ?></textarea>
                            <textarea name="text" class="news__content-text"><?php echo $content ?></textarea>
                            <div class="tags">
                                <p>Теги:</p>
                                <input name="tags" value="<?php echo $tags; ?>" class="tags__content">
                            </div>
                            <button class="btn">Підтвердити</button>
                        </form>
                    <?php 
                        } 
                    ?>
                        <div id="news-for-hide">
                            <h1 class="title"><?php echo $title ?></h1> 
                            <?php
                                if($img_path)
                                    echo "<img src='../img/news/$img_path' />";
                            ?>
                            <div class="news__content-text"><?php echo $content ?></div>
                            <hr class="line" />
                            <div class="tags">
                                <p>Теги:</p>
                                <?php
                                    $tags_arr = explode(',', $tags);

                                    for($i = 0; $i < count($tags_arr); $i++) {
                                        echo "<div class='tag'>$tags_arr[$i]</div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="other-news">
                            <?php
                                $exist_similar_news = false;
                                $similar_news = [];
                                $query = "SELECT * FROM news WHERE";

                                $tag_filters = [];
                                for($i = 0; $i < count($tags_arr); $i++) {
                                    $tag = trim($tags_arr[$i]);
                                    $tag_filters[] = " (id != $news_id and tags like '%$tag%')";
                                }
                                $query .= implode(' or ', $tag_filters);

                                $similar_news_query = mysqli_query($db, $query);
                                $similar_news_data = get_assoc_rows($similar_news_query);
                                $similar_news_count = count($similar_news_data);

                                $title = '';
                                $count = 0;
                                $additional_news = [];

                                if($similar_news_count > 0) {
                                    $title = 'Ще по темі';
                                    $count = count($similar_news_data) > 3 ? 4 : count($similar_news_data);
                                    $additional_news = $similar_news_data;
                                }
                                else {
                                    $title = 'Інші новини';

                                    $additional_news_query = mysqli_query($db, "SELECT * FROM news WHERE id != $news_id ORDER BY date DESC, time DESC");
                                    $additional_news = get_assoc_rows($additional_news_query);

                                    $count = count($additional_news) < 4 ? count($additional_news) : 4;
                                }
                            ?>
                            <p class="title"><?php echo $title ?></p>
                            <div class="content">
                                <?php
                                    for($i = 0; $i < $count; $i++) {
                                        $curr_additional_news = $additional_news[$i];
                                        $curr_additional_news_id = $curr_additional_news['id'];
                                        $curr_additional_news_title = $curr_additional_news['title'];

                                        echo "<a href='/details?id=$curr_additional_news_id' class='content__item'>$curr_additional_news_title</a>";
                                    }
                                ?>
                            </div>
                        </div>
                        
						<div class="comments">
							<p class="title">Коментарі</p>
                            <?php
                                if(is_logged_in()) {
                            ?>
                                <div class="add">
                                    <form action="/includes/users/add_comment.php" method="post">
                                        <input type="hidden" name="news_id" value="<?php echo $news_id; ?>">
                                        <textarea
                                            name="comment"
                                            placeholder="Введіть ваш коментар"
                                            required
                                        ></textarea>
                                        <button>Відправити</button>
                                    </form>
                                </div>
                            <?php
                                }
                            ?>
							<div class="content">
                                <?php
                                    $comments_query = mysqli_query($db, "SELECT * FROM `comments` WHERE `news_id` = '$news_id'");
                                    $comments_data = get_assoc_rows($comments_query);

                                    for($i = 0; $i < count($comments_data); $i++) {
                                        $curr_comment = $comments_data[$i];
                                        $curr_comment_text = $curr_comment['text'];

                                        $user_id = $curr_comment['user_id'];
                                        $user_query = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = $user_id");
                                        $curr_username = mysqli_fetch_assoc($user_query)['username'];

                                        echo "<div class='item'>
                                            <svg
                                                class='icon'
                                                version='1.1'
                                                id='Capa_1'
                                                xmlns='http://www.w3.org/2000/svg'
                                                xmlns:xlink='http://www.w3.org/1999/xlink'
                                                x='0px'
                                                y='0px'
                                                viewBox='0 0 53 53'
                                                style='enable-background: new 0 0 53 53'
                                                xml:space='preserve'
                                            >
                                                <path
                                                    style='fill: #e7eced'
                                                    d='M18.613,41.552l-7.907,4.313c-0.464,0.253-0.881,0.564-1.269,0.903C14.047,50.655,19.998,53,26.5,53
                                                    c6.454,0,12.367-2.31,16.964-6.144c-0.424-0.358-0.884-0.68-1.394-0.934l-8.467-4.233c-1.094-0.547-1.785-1.665-1.785-2.888v-3.322
                                                    c0.238-0.271,0.51-0.619,0.801-1.03c1.154-1.63,2.027-3.423,2.632-5.304c1.086-0.335,1.886-1.338,1.886-2.53v-3.546
                                                    c0-0.78-0.347-1.477-0.886-1.965v-5.126c0,0,1.053-7.977-9.75-7.977s-9.75,7.977-9.75,7.977v5.126
                                                    c-0.54,0.488-0.886,1.185-0.886,1.965v3.546c0,0.934,0.491,1.756,1.226,2.231c0.886,3.857,3.206,6.633,3.206,6.633v3.24
                                                    C20.296,39.899,19.65,40.986,18.613,41.552z'
                                                />
                                                <g>
                                                    <path
                                                        style='fill: #556080'
                                                        d='M26.953,0.004C12.32-0.246,0.254,11.414,0.004,26.047C-0.138,34.344,3.56,41.801,9.448,46.76
                                                        c0.385-0.336,0.798-0.644,1.257-0.894l7.907-4.313c1.037-0.566,1.683-1.653,1.683-2.835v-3.24c0,0-2.321-2.776-3.206-6.633
                                                        c-0.734-0.475-1.226-1.296-1.226-2.231v-3.546c0-0.78,0.347-1.477,0.886-1.965v-5.126c0,0-1.053-7.977,9.75-7.977
                                                        s9.75,7.977,9.75,7.977v5.126c0.54,0.488,0.886,1.185,0.886,1.965v3.546c0,1.192-0.8,2.195-1.886,2.53
                                                        c-0.605,1.881-1.478,3.674-2.632,5.304c-0.291,0.411-0.563,0.759-0.801,1.03V38.8c0,1.223,0.691,2.342,1.785,2.888l8.467,4.233
                                                        c0.508,0.254,0.967,0.575,1.39,0.932c5.71-4.762,9.399-11.882,9.536-19.9C53.246,12.32,41.587,0.254,26.953,0.004z'
                                                    />
                                                </g>
                                            </svg>
                                            <div class='right'>
                                                <p class='name'>$curr_username</p>
                                                <p class='text'>$curr_comment_text</p>
                                            </div>
                                        </div>";
                                    }
                                ?>
							</div>
						</div>
                    </div>
                    <?php require_once '../components/popular.php' ?>
                </div>
            </div>
        </main>
        <script src="../js/libs.min.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>
