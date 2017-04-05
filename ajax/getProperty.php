<?php 
/*---------------------------------------

use on : /ajax/getPropSearch.php

---------------------------------------*/

$testdata=0;
ini_set('display_errors', 0);

require ("auto_path.php");


switch ($_GET['type']){
	case 'propertyList':
		if ($testdata){
			$search_list= file_get_contents('../data/propresult.txt');
		}else{
		$para				=	$_POST;
		$_SESSION['propertySearch']=$_POST;

		IF (isset($para['usage']))
		{
			if (gettype($para['usage'])=='array')
			{
				$para['usage']=implode(",",$para['usage']);
			}
		}
		
		$pListLoader		=	new resPropertyListNew;
								$pListLoader->setPropertyListQueryParameter($para);
		$search_list		=	$pListLoader->getPropertySearch();
	}
		//echo var_dump($_POST);
	break;
	case 'indexProp':
		if ($testdata){
			$search_list= file_get_contents('../data/indexprop.txt');
		}else 
		{
			$para				=	$_POST;
			$_SESSION['propertySearch']=$_POST;
// var_dump($_POST);
			$pListLoader		=	new resPropertyListNew;
					$pListLoader->setPropertyListQueryParameter($_POST);
			$search_list		=	($pListLoader->getIndexPropertyList());
			
		}

	break;
	case 'propertyDetail':
	if ($testdata){
			$search_list= file_get_contents('../data/propDetail.txt');
		}else{
		$pDetailLoader 	=	new resPropertyNew;
					$pDetailLoader->setPropertyNumber($_POST['id']);
		$search_list		=	$pDetailLoader->getPropertyDetail();
	}
	break;
	case 'propertyBuildingName':
	if ($testdata){
			$search_list= file_get_contents('../data/propDetail.txt');
		}else{
		$para				=	$_POST;
		$pDetailLoader 	=	new resPropertyListNew;
		$pDetailLoader->setPropertyListQueryParameter($para);
		$search_list		=	$pDetailLoader->getExistingBuildingName();
	}
	break;
	case 'street_search':
	if ($testdata){
			$search_list= file_get_contents('../data/propDetail.txt');
		}else{
		$para				=	$_POST;
		$pDetailLoader 	=	new resPropertyListNew;
		$pDetailLoader->setPropertyListQueryParameter($para);
		$search_list		=	$pDetailLoader->getSearchStreetList();
	}
	break;
	case 'distlist':
		$pDetailLoader 	=	new resPropertyListNew;
		$search_list		=	$pDetailLoader->getDistrictList();

	break;
	case 'usagelist':
		$pDetailLoader 	=	new resPropertyListNew;
		$search_list		=	$pDetailLoader->getUsageList();

	break;
	
}
echo $search_list;
?>