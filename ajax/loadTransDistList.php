<?php
//require ("/data/includes/ast_ind/classLoader.php");
/*---------------------------------------

use on : /ajax/loadTransDistList.php

---------------------------------------*/
require ("auto_path.php");
$pListLoader 	=	new resTransactions;
$dist			=	$pListLoader->getDaybookSearchDistrictList();


echo $dist;
?>