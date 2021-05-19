<?php
    require_once '../includes/db.php';
    require_once '../includes/functions.php';
	require_once '../includes/users/user_session.php';
	session_start();

	if(has_admin_panel_access() == false)
		header('Location: /');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Адмін панель</title>
        <link
			rel="apple-touch-icon"
			sizes="57x57"
			href="../img/favicon/apple-icon-57x57.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="60x60"
			href="../img/favicon/apple-icon-60x60.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="72x72"
			href="../img/favicon/apple-icon-72x72.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="76x76"
			href="../img/favicon/apple-icon-76x76.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="114x114"
			href="../img/favicon/apple-icon-114x114.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="120x120"
			href="../img/favicon/apple-icon-120x120.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="144x144"
			href="../img/favicon/apple-icon-144x144.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="152x152"
			href="../img/favicon/apple-icon-152x152.png"
		/>
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="../img/favicon/apple-icon-180x180.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="192x192"
			href="../img/favicon/android-icon-192x192.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="../img/favicon/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="96x96"
			href="../img/favicon/favicon-96x96.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="../img/favicon/favicon-16x16.png"
		/>
		<link rel="preconnect" href="https://fonts.gstatic.com" />
		<link
			href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<main class="main">
			<div class="container">
				<div class="main-top">
					<a href="/includes/users/logout.php">Вийти з облікового запису</a>
					<h1 class="main-title">Адмін панель</h1>
					<a href="/">Повернутися на головну</a>
				</div>
				<button class="access-manage__btn manage-btn" data-target="users">
					Розмежування доступу
				</button>
				<div class="access-manage manage-content" id="users">
					<div class="table-wrapper">
						<table class="table">
							<tr>
								<td class="nickname">Нікнейм</td>
								<td class="access">Статус</td>
								<td>Змінити статус</td>
							</tr>
							<?php
								$user_id = $_SESSION['id'];
								$users_query = mysqli_query($db, "SELECT * FROM `users` WHERE `id` != '$user_id'"); 
								$users_data = get_assoc_rows($users_query);

								for($i = 0; $i < count($users_data); $i++) {
									$curr_user = $users_data[$i];
									$curr_user_id = $curr_user['id'];
									$curr_user_username = $curr_user['username'];
									$curr_user_status_id = $curr_user['status'];
									$curr_user_status_query = mysqli_query($db, "SELECT * FROM `statuses` WHERE `id` = '$curr_user_status_id'");
									$curr_user_status_data = mysqli_fetch_assoc($curr_user_status_query);
									$curr_user_status_name = $curr_user_status_data['status'];
									$curr_user_admin_panel_access = $curr_user_status_data['admin_panel_access'] == 1 ? true : false;
									$curr_user_edit_access = $curr_user_status_data['edit_access'] == 1 ? true : false;

									$btns = "";
									
									if($curr_user_admin_panel_access == false)
										$btns .= "<a href='/includes/users/change_user_access.php?access=3&user=$curr_user_id' class='btn'>Зробити адміністратором</a>";
									if($curr_user_edit_access == false)
										$btns .= "<a href='/includes/users/change_user_access.php?access=2&user=$curr_user_id' class='btn'>Зробити редактором</a>";
									if($curr_user_admin_panel_access || $curr_user_edit_access)
										$btns .= "<a href='/includes/users/change_user_access.php?access=1&user=$curr_user_id' class='btn'>Зробити користувачем</a>";

									echo "<tr><td class='id'>$curr_user_id</td>
									<td class='username'>$curr_user_username</td>
									<td class='status-name'>$curr_user_status_name</td>
									<td>
										<div class='btns'>$btns</div>
									</td></tr>";
								}
							?>
						</table>
					</div>
				</div>
				<button class="categories-manage__btn manage-btn" data-target="categories">
					Управління категоріями
				</button>
				<div class="categories-manage manage-content" id="categories">
					<div class="table-wrapper">
						<table class="table">
							<tr>
								<td class="title">Назва</td>
								<td></td>
							</tr>
							<?php
								$categories_query = mysqli_query($db, "SELECT * FROM categories"); 
								$categories_data = get_assoc_rows($categories_query);

								for($i = 0; $i < count($categories_data); $i++) {
									$curr_category = $categories_data[$i];
									$curr_category_id = $curr_category['id'];
									$curr_category_name = $curr_category['name'];

									echo "<tr><td class='id'>$curr_category_id</td>
									<td class='category-name'>$curr_category_name</td>
									<td>
										<div class='btns'><a href='/includes/categories/remove_category.php?id=$curr_category_id' class='btn'>Видалити</a></div>
									</td></tr>";
								}
							?>
						</table>
					</div>
					<form action="/includes/categories/add_category.php" method="get" class="form category active" id="addCategory">
						<p class="form__title">Додати категорію</p>
						<div class="form__inner">
							<input
								type="text"
								class="category-name"
								name="name"
								id="name"
								placeholder="Введіть назву категорії"
							/>
							<button class="btn">Підтвердити</button>
						</div>
					</form>
				</div>
				<button class="news-manage__btn manage-btn active" data-target="news">
					Управління статтями
				</button>
				<div class="news-manage manage-content active" id="news">
					<div class="filters">
						<p class="filters__title">Фільтри</p>
						<form action="content.php" method="get" class="filters__content">
							<div class="row">
								<div class="field">
									<p class="mini-title">За ключовою фразою</p>
									<input
										type="text"
										placeholder="Введіть запит"
										name="search"
										id="query"
										class="search"
									/>
								</div>
								<div class="field">
									<p class="mini-title">За датою:</p>
									<input type="date" name="date" />
								</div>
							</div>
							<div class="categories">
								<p class="title">Категорії</p>
								<div class="categories__content">
									<?php
										for($i = 0; $i < count($categories_data); $i++) {
											$curr_category = $categories_data[$i];
											$curr_category_id = $curr_category['id'];;
											$curr_category_name = $curr_category['name'];
											
											echo "<label for='cat_$curr_category_id' class='category'>
												<input type='checkbox' value='$curr_category_id' name='category[]' id='cat_$curr_category_id' />
												<p>$curr_category_name</p>
											</label>";
										}
									?>
								</div>
							</div>
							<button class="btn">Підтвердити</button>
						</form>
					</div>
					<div class="table-wrapper">
						<table class="table">
							<tr>
								<td class="title">Заголовок</td>
								<td class="title">Зміст</td>
								<td class="title">Категорія</td>
								<td class="title">Теги</td>
								<td></td>
							</tr>
							<?php
								function get_category($db, $id) {
									$query = mysqli_query($db, "SELECT name FROM categories WHERE id = '$id'");
									return mysqli_fetch_assoc($query)['name'];
								}

								function add_filters_to_query($elems, $name_in_bd) {
									if($elems) {
										$elems_for_query = [];
								
										foreach($elems as $elem) {
											$elems_for_query[] = "`$name_in_bd` = '$elem'";
										}
								
										return implode(' or ', $elems_for_query);
									}
								}

								$search_filter = $_GET['search'];
								$date_filter = $_GET['date'];
								$categories_filter = $_GET['category'];

								$query = "SELECT * FROM news";

								if($search_filter || $date_filter || $categories_filter) {
									$query .= " WHERE ";
							
									$filters = [];
									if($search_filter)
										$filters[] = "title like '%$search_filter%' or content like '%$search_filter%'";
									if($date_filter)
										$filters[] = "date = '$date_filter'";
									if(add_filters_to_query($categories_filter, 'category'))
										$filters[] = add_filters_to_query($categories_filter, 'category');
							
									$query .= implode(' and ', $filters);
								}

								$query .= " ORDER BY date DESC, time DESC";

								$news_query = mysqli_query($db, $query); 
								$news_data = get_assoc_rows($news_query);

								for($i = 0; $i < count($news_data); $i++) {
									$curr_news = $news_data[$i];
									$curr_news_id = $curr_news['id'];
									$curr_news_title = $curr_news['title'];
									$curr_news_content = $curr_news['content'];
									$curr_news_short_content = mb_strimwidth($curr_news['content'], 0, 300, "...");
									$curr_news_category = $curr_news['category'];
									$curr_news_category_text = get_category($db, $curr_news['category']);
									$curr_news_tags = $curr_news['tags'];

									echo "<tr>
										<td class='id'>$curr_news_id</td>
										<td class='news-title'>$curr_news_title</td>
										<td class='short-text'>$curr_news_short_content</td>
										<td class='text'>$curr_news_content</td>
										<td class='category'>$curr_news_category</td>
										<td class='category_text'>$curr_news_category_text</td>
										<td class='tags'>$curr_news_tags</td>
										<td>
											<div class='btns'>
												<button class='btn editBtn' data-target='editForm'>
													Редагувати
												</button>
												<a href='/includes/news/remove_news.php?id=$curr_news_id' class='btn'>Видалити</a>
											</div>
										</td>
									</tr>";
								}
							?>
						</table>
					</div>
					<form action="/includes/news/add_news.php" method="post" enctype="multipart/form-data" class="form active" id="createForm">
						<p class="form__title">Створити статтю</p>
						<div class="form__inner">
							<label for="title" class="form__block">
								<p class="title">Заголовок статті</p>
								<input type="text" class="news-title" name="title" id="title" required />
							</label>
							<div class="form__block">
								<p class="title">Текст статті <span>(використовуйте html теги для форматування)</span></p>
								<textarea name="content" class="text" id="text" required></textarea>
							</div>
							<div class="form__block categories">
								<p class="title">Категорія</p>
								<div class="content">
									<input type='radio' name='category' value='-' class='hidden-radio' required>
									<?php
										$first = true;

										for($i = 0; $i < count($categories_data); $i++) {
											$curr_category = $categories_data[$i];
											$curr_category_id = $curr_category['id'];
											$curr_category_name = $curr_category['name'];

											echo "<label for='category_$curr_category_id' class='category'>
												<input type='radio' name='category' value='$curr_category_id' id='category_$curr_category_id'>
												<p>$curr_category_name</p>
											</label>";
										}
									?>
								</div>
							</div>
							<label for="tags" class="form__block">
								<p class="title">Теги до статті <span>(запис через " , ")</span></p>
								<input type="text" name="tags" class="tags" id="tags" required />
							</label>
							<div class="upload-image form__block">
								<label for="create-uploaded-image" class="title">Завантажити зображення</label>
								<input
									type="file"
									name="image"
									placeholder="Зображення для статті"
									class="image"
									id="create-uploaded-image"
								/>
							</div>
							<button class="btn">Підтвердити</button>
						</div>
					</form>
					<form action="/includes/news/edit_news.php" method="post" enctype="multipart/form-data" class="form" id="editForm">
						<p class="form__title">Редагувати статтю</p>
						<div class="form__inner">
							<input type="hidden" name="id" class="id" />
							<label for="title" class="form__block">
								<p class="title">Заголовок статті</p>
								<input type="text" name="title" class="news-title" id="title" required />
							</label>
							<div class="form__block">
								<p class="title">Текст статті <span>(використовуйте html теги для форматування)</span></p>
								<textarea name="text" class="text" id="text" required></textarea>
							</div>
							<div class="form__block categories">
								<p class="title">Категорія</p>
								<div class="content">
									<?php
										$first = true;

										for($i = 0; $i < count($categories_data); $i++) {
											$curr_category = $categories_data[$i];
											$curr_category_id = $curr_category['id'];
											$curr_category_name = $curr_category['name'];

											echo "<label for='categor_$curr_category_id' class='category'>
												<input type='radio' name='category' value='$curr_category_id' id='categor_$curr_category_id'>
												<p>$curr_category_name</p>
											</label>";
										}
									?>
								</div>
							</div>
							<label for="tags" class="form__block">
								<p class="title">Теги до статті <span>(запис через " , ")</span></p>
								<input type="text" name="tags" class="tags" id="tags" required />
							</label>
							<div class="upload-image form__block">
								<label for="edit-uploaded-image" class="title"
									>Завантажити зображення</label
								>
								<input
									type="file"
									name="image"
									placeholder="Зображення для статті"
									class="image"
									id="edit-uploaded-image"
								/>
							</div>
							<button class="btn">Підтвердити</button>
						</div>
					</form>
				</div>
			</div>
		</main>
		<script src="js/libs.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
