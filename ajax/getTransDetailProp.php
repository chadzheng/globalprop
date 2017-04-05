<?php 
/*---------------------------------------

use on : /ajax/loadTransDistList.php

---------------------------------------*/
require ("auto_path.php");

$para				=	$_POST["mid"];

$transListLoader	=	new webTransactions;
						$transListLoader->setTransactionsMemorialNo($para);
$transDetail		=	$transListLoader->getDaybookTransactionByMemorialNo();

echo $transDetail;
?>