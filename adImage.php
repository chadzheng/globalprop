<?php
require ("./ajax/auto_path.php");
$img = new resAdvertisingList;
$img->setAdvImageNumber($_GET['id']);
header("Content-type:image/jpeg"); 
ibase_blob_echo($img->getAdvImage());

?>