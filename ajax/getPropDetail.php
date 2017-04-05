<?php 
/*---------------------------------------

use on : /ajax/postPropSearch.php

---------------------------------------*/
require ("auto_path.php");

$pDetailLoader 	=	new resProperty;
					$pDetailLoader->setPropertyNumber($_GET['id']);
$pDetail		=	$pDetailLoader->getPropertyDetail();

echo $pDetail;
?>