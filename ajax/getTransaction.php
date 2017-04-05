<?php 
/*---------------------------------------

use on : /ajax/getPropSearch.php

---------------------------------------*/
session_start();
$testdata=0;
 header('Content-Type: application/json');
require ("auto_path.php");


switch ($_GET['type']){
	case 'transList':
		if ($testdata){
			$result_list= file_get_contents('../data/transresult.txt');
		}else{
		$para				=	$_POST;
//var_dump($para);
		$transListLoader	=	new webTransactions;
		$transListLoader->setTransactionsHeadLineLimit(20);
		$transListLoader->setDaybookSearchParameter($para);
		$result_list		=	$transListLoader->getDaybookTransactionList();
		
	}
		//echo var_dump($_POST);
	break;
	case 'transDetail':
		if ($testdata){
			$result_list= file_get_contents('../data/transDetail.txt');
		}else{
		// echo '123';
		$para				=	$_POST["mid"];

		$transListLoader	=	new webTransactions;
								$transListLoader->setTransactionsMemorialNo($para);
		$result_list		=	$transListLoader->getDaybookTransactionByMemorialNo();
		
	}
		//echo var_dump($_POST);
	break;
	case 'transHistory':
	if ($testdata){
			$result_list= file_get_contents('../data/transhistory.php');
		}else{
		$para				=	$_POST["mid"];

		$transListLoader	=	new webTransactions;
								$transListLoader->setTransactionsMemorialNo($para);
		$result_list		=	$transListLoader->getDaybookThisPassTransactionDetailByMemorialNo();
		
	}
	break;
	case 'indexTrans':
		if ($testdata){
			$result_list= file_get_contents('../data/transresult.txt');
		}else{
		$para				=	$_POST;

		$transListLoader		=	new webTransactions;
								$transListLoader->setTransactionsHeadLineLimit(20);
								$transListLoader->setDaybookSearchParameter($para);
		$result_list		=	json_decode($transListLoader->getDaybookTransactionList(),true);
		$temp=array();
		foreach($result_list['DAYBOOK_RESULT'] as $key=>$value){	
			$temp[$key]['ADDRESS']=$value['FULLADDR'];
			$temp[$key]['PRICE']=$value['PRICE'];
			$temp[$key]['UPLOADDATE']=$value['TRANS_DATE'];
		}
		$result_list=json_encode($temp);
		
	}
		//echo var_dump($_POST);
	break;
	case 'loadDist':
		$para				=	$_GET;
		$transListLoader 	=	new webTransactions;
		$transListLoader->setDaybookSearchParameter($para);
		$result_list			=	$transListLoader->getDaybookSearchDistrictList();
	break;
	case 'loadUsage':
	//echo 12313;
		$para				=	$_GET;
		$transListLoader 	=	new webTransactions;
		$transListLoader->setDaybookSearchParameter($para);
		$result_list			=	$transListLoader->getDaybookSearchUsageList();
	break;
	
	
}
echo $result_list;
?>