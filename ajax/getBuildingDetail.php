<?php 
require ("auto_path.php");

$bDetailLoader 	=	new resProperty;
					$bDetailLoader->setPropertyNumber($_GET['id']);
$bDetail		=	$bDetailLoader->getPropertyBuildingDetail();

echo $bDetail;
?>