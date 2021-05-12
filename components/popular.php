<div class="popular">
	<p class="title">Популярні новини</p>
	<?php
		$popular_news_query = mysqli_query($db, "SELECT * FROM news ORDER BY views DESC");
		$popular_news_data = get_assoc_rows($popular_news_query);
		$count = count($popular_news_data) > 5 ? 6 : count($popular_news_data);

		for($i = 0; $i < $count; $i++) {
			$curr_popular_news = $popular_news_data[$i];
			$curr_popular_news_id = $curr_popular_news['id'];
			$curr_popular_news_title = $curr_popular_news['title'];
			$curr_popular_news_views = $curr_popular_news['views'];

			echo "<div class='news__item'>
				<a href='/details?id=$curr_popular_news_id' class='news__item-title'>$curr_popular_news_title</a>
				<div class='views'>
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
					<span>$curr_popular_news_views</span>
				</div>
			</div>";
		}
	?>
</div>