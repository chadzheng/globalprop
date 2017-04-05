<?php
/*---------------------------------------

use on : index.php

---------------------------------------*/
require ("auto_path.php");
ini_set('display_errors', 0);
switch ($_GET['type']){
	case 'indexNews':
	$pListLoader		=	new resCompanyNews;
								
	$search_list		=	$pListLoader->getTheCompanyNews();
	break;
	default:
	break;
	
}
echo $search_list;
?>