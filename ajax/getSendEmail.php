<?php 


session_start();
/*---------------------------------------

use on : /ajax/postPropSearch.php

---------------------------------------*/
require ("../include/mail.php");
$mail	=	new sendmail();
if (isset($_POST['msg']))
$_POST['msg']=nl2br($_POST['msg']);
$mail->setPost($_POST);
$mailresult		=	$mail->sdmail();
echo $mailresult;
?>	