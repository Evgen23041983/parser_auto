<?php

     $mysqli = false;
	 function connectDB () {
		 global $mysqli;
		 $mysqli = new mysqli("localhost", "root", "", "db");
		 $mysqli->query("SET NAMES 'utf8'");
	 }
	 
	 function closeDB ()  {
		 global $mysqli;
		 $mysqli->close ();
	 }
	function parsecategory()
	{
		global $mysqli;
		connectDB();
		$xml_file=file_get_contents ("https://www.gebrauchtwagen.de/sitemap.xml");
		$xml = simplexml_load_string($xml_file);

		foreach($xml->url as $item){
			$url=toArray($item->loc);
			$url=$url[0];
			;
			//$url=$item->loc;
			$cat_array = explode("/", $url);
			var_dump($cat_array[3]);
			
			$query = "SELECT category FROM category WHERE category =".$cat_array[3];
			$result = mysqli_query($mysqli, $query)  ;
			if ($result == false) {
				$query ="INSERT INTO category VALUES(NULL, '$cat_array[3]')";
				$result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli)); 
			}
		
			
	}



		closeDB();
	} 




  	function getNews($limit, $id){
		global $mysqli;
		connectDB();
		if($id)
			$where = "WHERE `auto_id` = ".$id;
		$result = $mysqli->query("SELECT * FROM `auto_1`$where ORDER BY `auto_id` DESC LIMIT $limit");		
		closeDB();
		if(!$id)
		    return resultToArray($result);
		else
            return $result->fetch_assoc();		
	}
    function resultToArray($result){
		$array = array();
		while(($row = $result->fetch_assoc()) != false)
			$array[] = $row;
		return $array;
	}
?>


