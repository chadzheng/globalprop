<?php
$allowedOrigin = array(
	'http://192.168.0.40:9000',
	"http://localhost:9000"
);
if (in_array($http_origin,$allowedOrigin)){
		header("Access-Control-Allow-Origin: ". $http_origin);
	}
require ("./ajax/auto_path.php");
$img = new imageLoader;
$img->setImageNumber($_GET['id']);
header("Content-type:image/jpeg"); 
ibase_blob_echo($img->getThumbNailImage());
?>