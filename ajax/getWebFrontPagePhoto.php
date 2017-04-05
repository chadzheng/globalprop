<?php
require ("auto_path.php");

$pListLoader 	=	new resPropertyListNew;
$usage			=	$pListLoader->getWebFrontPagePhoto();


echo $usage;
?>