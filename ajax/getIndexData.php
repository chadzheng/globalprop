<?php
/*---------------------------------------

use on : index.php

---------------------------------------*/
require ("auto_path.php");
$iLoader		=	new resPropertyList;
/*$iLoader		->	getEnglishUsageOption();
$iLoader		->	getChineseUsageOption();
$iLoader		->	getEnglishDistrictOption();
$iLoader		->	getChineseDistrictOption();*/

$iLoader		->	setPropertyHeadLineLimit(15);
$result	=	$iLoader		->	getPropertyHeadLine();
echo $result;
?>