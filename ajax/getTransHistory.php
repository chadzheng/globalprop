<?php 
/*---------------------------------------

use on : /ajax/getTransHistory.php

---------------------------------------*/
require ("auto_path.php");
$para				=	$_POST["mid"];

$transListLoader	=	new webTransactions;
						$transListLoader->setTransactionsMemorialNo($para);
$transHistory		=	$transListLoader->getDaybookThisPassTransactionDetailByMemorialNo();

echo $transHistory;
?>