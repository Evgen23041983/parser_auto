<!DOCTYPE html>
<html>
<head>

    <?php	
    require_once "functions/functions.php";
	$news = getNews(1, $_GET["id"]);
    $title= $news["auto_name"];	 
	require_once "blocks/head.php";
?>
 
 
</head>
<body>


    <?php require_once "blocks/header.php"?>
	
		 

 <?php
		    	
		echo '
			<div id="bigArticle">
		<h2>'.$news["auto_name"].'</h2>
		<div id="wrapper">
		 <div id="leftCol">
		 <div class="slides">
    <ul> <!-- Слайды -->
        <li><img src="'.$news["auto_bigImage"].'" alt="image01" />
            <div>Описание #1</div>
        </li>
        <li><img src="'.$news["auto_bigImage"].'" alt="image02" />
            <div>Описание #2</div>
        </li>
        <li><img src="'.$news["auto_bigImage"].'" alt="image03" />
            <div>Описание #3</div>
        </li>
        <li><img src="'.$news["auto_bigImage"].'" alt="image04" />
            <div>Описание #4</div>
        </li>
    </ul>
</div>

		 
	   </div>
						';			 
?>	  
		     
		 </div>	
           <?php require_once "blocks/rightCol.php"?>		 
	</div>	 
     
	 <?php require_once "blocks/footer.php"?>	
	 

	 

	
</body>
</html>