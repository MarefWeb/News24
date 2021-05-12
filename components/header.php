<header class="header">
	<div class="container">
		<div class="header__inner">
			<div class="left-side">
				<div class="logo">
					<svg
						id="Capa_1"
						enable-background="new 0 0 512 512"
						height="512"
						viewBox="0 0 512 512"
						width="512"
						xmlns="http://www.w3.org/2000/svg"
					>
						<g id="XMLID_666_">
							<path
								id="XMLID_697_"
								d="m277.949 254.093v-90.585c17.023-6.157 29.223-22.479 29.223-41.6 0-24.384-19.838-44.223-44.223-44.223s-44.223 19.838-44.223 44.223c0 19.121 12.2 35.442 29.223 41.6v90.585h-247.949v257.903h512v-257.903zm-15-146.408c7.843 0 14.223 6.38 14.223 14.223s-6.38 14.223-14.223 14.223-14.223-6.38-14.223-14.223c.001-7.842 6.38-14.223 14.223-14.223zm219.051 374.311h-452v-197.903h452z"
							/>
							<path
								id="XMLID_702_"
								d="m110.44 316.895h-30v132.299h65.852v-30h-35.852z"
							/>
							<path id="XMLID_703_" d="m176.54 315.933h30v132.385h-30z" />
							<path
								id="XMLID_706_"
								d="m431.56 417.851h-42.748v-20.725h39.595v-30h-39.595v-20.725h42.748v-30h-72.748v131.45h72.748z"
							/>
							<path
								id="XMLID_710_"
								d="m224.758 315.725 45.046 130.505h26.068l44.045-130.505h-32.354l-25.025 75.378-26.038-75.378z"
							/>
							<path
								id="XMLID_711_"
								d="m311.889 183.821 21.213 21.213 10.606-10.607c39.987-39.987 39.987-105.051 0-145.039l-10.606-10.607-21.213 21.213 10.606 10.606c28.29 28.291 28.29 74.322 0 102.613z"
							/>
							<path
								id="XMLID_712_"
								d="m182.19 194.427 10.606 10.607 21.213-21.213-10.606-10.606c-28.29-28.291-28.29-74.322 0-102.613l10.606-10.606-21.213-21.213-10.606 10.606c-39.987 39.987-39.987 105.051 0 145.038z"
							/>
							<path
								id="XMLID_713_"
								d="m371.515 211.992-10.606 10.606 21.213 21.213 10.606-10.607c61.369-61.369 61.369-161.225 0-222.595l-10.607-10.605-21.213 21.213 10.606 10.606c49.673 49.673 49.673 130.497.001 180.169z"
							/>
							<path
								id="XMLID_714_"
								d="m143.777 243.812 21.213-21.213-10.606-10.606c-24.062-24.062-37.314-56.055-37.314-90.084s13.252-66.022 37.314-90.084l10.606-10.606-21.213-21.215-10.606 10.607c-29.729 29.729-46.102 69.255-46.102 111.297 0 42.043 16.373 81.569 46.102 111.297z"
							/>
						</g>
					</svg>
					<p>Новини24</p>
				</div>
			</div>
			<div class="right-side">
				<form action="/index.php" class="search" method="get">
					<input
						type="text"
						placeholder="Введіть запит"
						name="search"
						id="query"
					/>
					<button>
						<svg
							version="1.1"
							id="Capa_1"
							xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink"
							x="0px"
							y="0px"
							width="612.01px"
							height="612.01px"
							viewBox="0 0 612.01 612.01"
							style="enable-background: new 0 0 612.01 612.01"
							xml:space="preserve"
						>
							<g>
								<g id="_x34__4_">
									<g>
										<path
											d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
											C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
											l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
											c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
											S377.82,467.8,257.493,467.8z"
										/>
									</g>
								</g>
							</g>
						</svg>
					</button>
				</form>
			</div>
		</div>
	</div>
	<div id="prenav"></div>
	<div class="nav" id="nav">
		<div class="container">
			<div class="nav__inner">
				<a href="/" class="nav__link">Головна</a>
				
				<?php
					$categories_query = mysqli_query($db, "SELECT * FROM categories");
					$categories_data = get_assoc_rows($categories_query);

					for($i = 0; $i < count($categories_data); $i++) {
						$curr_category = $categories_data[$i];
						$curr_category_id = $curr_category['id'];
						$curr_category_name = $curr_category['name'];

						echo "<a href='/?category=$curr_category_id' class='nav__link'>$curr_category_name</a>";
					}
				?>
			</div>
		</div>
	</div>
</header>