<?php
    require_once '../includes/db.php';
    require_once '../includes/functions.php';

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
                    </div>
                    <?php require_once '../components/popular.php' ?>
                </div>
            </div>
        </main>
        <script src="../js/libs.min.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>
