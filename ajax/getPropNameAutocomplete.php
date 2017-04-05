<?php 
/*---------------------------------------

use on : /ajax/postPropSearch.php

---------------------------------------*/
require ("auto_path.php");
//$para				=	$_POST;

$pNameLoader		=	new resPropertyList;
						$pNameLoader->setBuildingSearchName($_POST['name']);
$search_list		=	$pNameLoader->getExistingBuildingName();


echo $search_list;
?>