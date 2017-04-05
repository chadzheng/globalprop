<?php 
//require ("/data/includes/ast_ind/classLoader.php");
/*---------------------------------------

use on : /ajax/loadTransDistList.php

---------------------------------------*/
require ("auto_path.php");
//$para				=	$_POST;

$pNameLoader		=	new resTransactions;
						$pNameLoader->setDaybookSearchBuildingName($_POST['name']);
$search_list		=	$pNameLoader->getDaybookSearchBuildingList();


echo $search_list;
?>