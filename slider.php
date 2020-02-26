<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Responsive CSS3 Slider</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <?php	
    require_once "functions/functions.php";
	$news = getNews(1, $_GET["id"]);
	?>
      <link rel="stylesheet" href="css/style_1.css">

  
</head>

<body>
  <div class="container">
	

	<input type="radio" id="i1" name="images" checked/>
	<input type="radio" id="i2" name="images" />
	<input type="radio" id="i3" name="images" />
	<input type="radio" id="i4" name="images"  />
	
	<div class="slide_img" id="one">			
			
			<?php	echo '<img src="'.$news["auto_name"].'"> '?>
			
				<label class="prev" for="i4"><span></span></label>
				<label class="next" for="i2"><span></span></label>	
		
	</div>
	
	<div class="slide_img" id="two">
		
			<?php	echo '<img src="'.$news["auto_name"].'"> '?>		
			
				<label class="prev" for="i1"><span></span></label>
				<label class="next" for="i3"><span></span></label>
		
	</div>
			
	<div class="slide_img" id="three">
			<?php	echo '<img src="'.$news["auto_name"].'"> '?>
			
				<label class="prev" for="i2"><span></span></label>
				<label class="next" for="i4"><span></span></label>
	</div>


	<div class="slide_img" id="four">
			<?php	echo '<img src="'.$news["auto_name"].'"> '?>	
			
				<label class="prev" for="i3"><span></span></label>
				<label class="next" for="i1"><span></span></label>

	</div>

	<div id="nav_slide">
		<label for="i1" class="dots" id="dot1"></label>
		<label for="i2" class="dots" id="dot2"></label>
		<label for="i3" class="dots" id="dot3"></label>
		<label for="i4" class="dots" id="dot4"></label>
	</div>
		
</div>
  
  
</body>
</html>
