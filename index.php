<!DOCTYPE html>
<html>
<head>
	<?php
	set_include_path(get_include_path().PATH_SEPARATOR.'library/'); 
	set_include_path(get_include_path().PATH_SEPARATOR.'phpQuery/'); 
	
	require('config.php');
	require_once "functions/functions.php";
	
	spl_autoload_register(function ($class_name) {
		require_once $class_name . '.php';
	});
	
	
	
    $title= "Авто";	 
	require_once "blocks/head.php";
	$news = getNews(10,$id);
	
	?>
	
</head>
<body>
    <?php require_once "blocks/header.php"?>
	<div id="wrapper">
	     <div id="leftCol"> 
		 
		<?php

		$pageText =new Curl();
		$page=$pageText->get_page(URL);
														//Открываем сайт
		$cat_auto_page = phpQuery::newDocument($page); 
		$cats_auto = $cat_auto_page->find('#ls-filter-makes > li > a');
		$cats = 0;
		foreach ($cats_auto as $link) 
		{
			
			$cat_href=pq($link)->attr('href');
			$cat_name=pq($link)->text();  //категория автомобиля
			//записываем категорию авто
			connectDB();
			$query = "SELECT category FROM model_cat WHERE category =".$cat_name;
			$result = mysqli_query($mysqli, $query);
			
			if ($result == false) 
			{
				$query ="INSERT INTO model_cat VALUES(NULL, '$cat_name')";
				$result = mysqli_query($mysqli, $query);
			}
			closeDB();	//Открываем страницу марки автомобиля
			$page_cat=$pageText->get_page("https://www.autobonus.lt".$cat_href);
			$page_cat = phpQuery::newDocument($page_cat);
			
			$result = $page_cat->find(' span.result-count');
			$result_count = pq($result)->html();
			$k = (int)substr($result_count,1,-1)/20;
							
			for ($i=0; $i < 1; $i++) 
			{
				$c = $i * 20;
				//Открываем все страницы марки автомобиля
				$page_cat=$pageText->get_page("https://www.autobonus.lt".$cat_href."&ord=date&asc=desc&curr=".$c);
				$page_cat = phpQuery::newDocument($page_cat);
				
				$year = $page_cat->find('div.description > div.item-description');
				
				$models_auto = $page_cat->find(' div.all-ads-block > a');
				
				foreach ($models_auto as $link)
				{
					$model_href=pq($link)->attr("href"); //Ссылка на авто
					
					$year=pq($link)->find('p.primary')->text();
					$model_year = explode(" ", $year); // Год выпуска
					
					$model_des = pq($link)->find('p.secondary')->text();
					
					$a = explode("|", $model_des); 
					$model_v = explode(" ", $a[0]);
					
					$model_price = pq($link)->find('div.item-price')->text();
					
					$model_name = pq($link)->find('div.item-title')->text();
										
					$model_city = pq($link)->find('div.city')->text();
										
						//Открываем страницу автомобиля
						$page_auto=$pageText->get_page($model_href);
						$page_auto = phpQuery::newDocument($page_auto); 
												
						$list = $page_auto->find('div#trans-content');  //Доп информация
						$list_auto=pq($list)->text();
												
						$image = $page_auto->find('div#big-photo > img');  //большая картинка
						$img_big_auto=pq($image)->attr('src');
						
						$images = $page_auto->find('div.mini-photos-container > div.photo > img');
						
							foreach ($images as $link) 
							{
								$img_small_auto=pq($link)->attr('src');  //маленькие картинки
								connectDB();
								$query = "SELECT `auto_path` FROM `img` WHERE `auto_path` =".$img_small_auto;
								$result = mysqli_query($mysqli, $query);
								if ($result == false) {
									$query ="INSERT INTO img VALUES(NULL, '$model_name', '$img_small_auto')";
									$result = mysqli_query($mysqli, $query);
								}
								closeDB();
							}
						
							//записываем данные авто в базу
							connectDB();
							
							$query = "SELECT `auto_link` FROM `auto_1` WHERE (`auto_link` = `$model_href`)";
							$result = mysqli_query($mysqli, $query);
							
							if ( $result ==  $mysqli->query($query  )) {
								$query ="INSERT INTO auto_1 VALUES(NULL,  '$cat_name', '$model_href', '$model_name', '$model_price', '$model_year[0]', '$model_city', '$model_v[0]', '$list_auto', '$model_des', '$img_big_auto')";
								$result = mysqli_query($mysqli, $query); 
							}
							closeDB();
							
				} 
			}
					
			$cats++;
			if ($cats>0) break;//для тестов

		}
		


		
		
		     for ($i = 0; $i < count($news); $i++) {
				 
				 echo "<div class=\"article\">";
				 echo '<img src="'.$news[$i]["auto_bigImage"].'" alt="Статья '.$news[$i]["auto_id"].'" title="Статья '.$news[$i]["auto_id"].'">
				<h2>'.$news[$i]["auto_name"].'</h2>
				<p>'.$news[$i]["auto_year"].'</p>
				<p>'.$news[$i]["auto_description"].'</p>
				<p>'.$news[$i]["auto_city"].'</p>
				<a href="/article.php?id='.$news[$i]["auto_id"].'">
				    <div class="more">'.$news[$i]["auto_price"].'</div>
				</a>
				<br>	
						
		     </div>	';
			 
				 echo "<div class=\"clear\"><br></div>";
			 }
			 
		?>	 
		     
		 </div>	
           <?php require_once "blocks/rightCol.php"?>		 
	</div>	 
     
	 <?php require_once "blocks/footer.php"?>	
	 


	
</body>
</html>