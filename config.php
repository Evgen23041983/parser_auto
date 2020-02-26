
<?php 
define("URL", 		'https://www.autobonus.lt/avto/poisk/'); //адрес сайта который будем парсить

//настройки подключения к БД чтобы записывать результаты парсинга
define("DB_HOST", 	"localhost");
define("DB_DATABASE", "db");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

//настройки скрипта
define("SAVEPATH", 			'img/'); //папка сохранения картинок
define("BASEPATH", 			'library'); //папка с php библиотеками
define("COOKIE_PATH", 		realpath(dirname(__FILE__).'/../')); //куда сохранять куки для авторизации

function del_postfix($name) { // убираем постфикс к картинке
	 
    $posv= strripos($name, '?');	
    if ($posv>0) { 
        $del = substr($name, $posv, strlen($name) );
        $name= substr_replace($name, '', $posv, strlen($name)) ;
    }
        
    return  $name;
}
//преобразовать SimpleXML в массив
function toArray(SimpleXMLElement $xml) {
   $array = (array)$xml;

   foreach ( array_slice($array, 0) as $key => $value ) {
       if ( $value instanceof SimpleXMLElement ) {
           $array[$key] = empty($value) ? NULL : toArray($value);
       }
   }
   return $array;
}