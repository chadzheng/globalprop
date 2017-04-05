<?php
require ("auto_path.php");

$pListLoader 	=	new resAdvertisingList;
$usage			=	$pListLoader->getAdvList();


echo $usage;
?>