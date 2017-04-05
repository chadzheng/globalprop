<?php 
//require ("/data/includes/ast_ind/classLoader.php");
/*---------------------------------------

use on : /ajax/postPropSearch.php

---------------------------------------*/
require ("auto_path.php");

$pNameLoader		=	new resTransactions;
						$pNameLoader->setDaybookSearchStreetName($_POST['name']);
$search_list		=	$pNameLoader->getDaybookSearchStreetList();


echo $search_list;
?>