<?php
	require_once 'includes/db.php';
	require_once 'includes/functions.php';
	require_once 'includes/users/user_session.php';
	session_start();

	$query = "SELECT * FROM news";

	$category = $_GET['category'];
	$search = $_GET['search'];
	$date = $_GET['date'];
	$begin_date = $_GET['begin-date'];
	$finish_date = $_GET['finish-date'];
	$last_days = $_GET['last-days'];

	if($category || $search || $date || $begin_date || $finish_date || $last_days) {
		$query .= ' WHERE';

        $filters = [];
		
		if($category)
			$filters[] = " category = $category";
		if($search)
			$filters[] = " title like '%$search%' or content like '%$search%'";
		if($date)
			$filters[] = " date = '$date'";
		if($begin_date && $finish_date)
			$filters[] = " date >= '$begin_date' and date <= '$finish_date'";
		if($last_days) {
			$date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - $last_days, date('Y')));
			$filters[] = " date >= '$date'";
		}

        $query .= implode(' and ', $filters);
	}
	
	$query .= " ORDER BY date DESC, time DESC";
	
	$news_query = mysqli_query($db, $query);
	$news_data = get_assoc_rows($news_query);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Новини24</title>
		<link
			rel="apple-touch-icon"
			sizes="57x57"
			href="img/favicon/apple-icon-57x57.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="60x60"
			href="img/favicon/apple-icon-60x60.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="72x72"
			href="img/favicon/apple-icon-72x72.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="76x76"
			href="img/favicon/apple-icon-76x76.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="114x114"
			href="img/favicon/apple-icon-114x114.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="120x120"
			href="img/favicon/apple-icon-120x120.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="144x144"
			href="img/favicon/apple-icon-144x144.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="152x152"
			href="img/favicon/apple-icon-152x152.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="img/favicon/apple-icon-180x180.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="192x192"
			href="img/favicon/android-icon-192x192.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="img/favicon/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="96x96"
			href="img/favicon/favicon-96x96.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="img/favicon/favicon-16x16.png"
		/>
		<link rel="preconnect" href="https://fonts.gstatic.com" />
		<link
			href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<?php require_once 'components/header.php' ?>
		<main class="main">
			<div class="container">
				<div class="main__inner">
					<div class="news">
						<div class="filters">
							<button class="content-btn btn btn_main">Фільтри</button>
							<div class="filters__content">
								<form action="index.php" method="get" class="date">
									<p>За датою:</p>
									<div class="field">
										<input type="date" name="date" required />
										<button class="btn submit">Ок</button>
									</div>
								</form>
								<form action="index.php" method="get"  class="date">
									<p>В проміжку між:</p>
									<div class="field">
										<input type="date" name="begin-date" required />
										<p>і</p>
										<input type="date" name="finish-date" required />
										<button class="btn submit">Ок</button>
									</div>
								</form>
								<form action="index.php" method="get"  class="date">
									<p>За останні:</p>
									<div class="field">
										<input type="number" name="last-days" placeholder="Введіть кількість днів" required />
										<button class="btn submit">Ок</button>
									</div>
								</form>
							</div>
						</div>
						<p class="title">
							<?php
								function format_date($str) {
									$monthes = ['01' => 'січня', '02' => 'лютого', '03' => 'березня', '04' => 'квітня', '05' => 'травня', '06' => 'червня',
									'07' => 'липня', '08' => 'серпня', '09' => 'вересня', '10' => 'жовтня', '11' => 'листопада', '12' => 'грудня'];

									$date_arr = explode('-', $str);
									$formated_date = $date_arr[2] . ' ' . $monthes[$date_arr[1]] . ' ' . $date_arr[0];

									return $formated_date;
								}

								if($begin_date && $finish_date) {
									$start = format_date($begin_date);
									$end = format_date($finish_date);
									echo "Новини в проміжку з $start по $end";
								}
								else if($last_days)
									echo "Новини за останні $last_days дн.";
								else if($date)
									echo format_date($date);
								else
									echo 'Останні новини';
							?>
						</p>
						
						<?php
							$last_date = '';

							for($i = 0; $i < count($news_data); $i++) {
								$curr_news = $news_data[$i];
								$curr_news_id = $curr_news['id'];
								$curr_news_title = $curr_news['title'];

								$curr_news_time = $curr_news['time'];
								$curr_news_date = $curr_news['date'];
								
								$curr_news_date_formated = format_date($curr_news_date);
								$curr_news_time_arr = explode(':', $curr_news_time);
								$curr_news_time_hours_minutes = $curr_news_time_arr[0] . ':' . $curr_news_time_arr[1];


								if($last_date == '' )
									$last_date = $curr_news_date;
								else if($last_date != $curr_news_date) {
									echo "<div class='time-devider'>
										<span class='line'></span>
										<span class='divide'>$curr_news_date_formated</span>
										<span class='line'></span>
									</div>";

									$last_date = $curr_news_date;
								}

								echo "<div class='news__item'>
									<p class='time'>$curr_news_time_hours_minutes</p>
									<a href='/details?id=$curr_news_id' class='news__item-title'>$curr_news_title</a>
								</div>";
							}
						?>
					</div>
					<?php require_once 'components/popular.php' ?>
				</div>
			</div>
		</main>
		<script src="js/libs.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
