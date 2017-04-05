<?php 


session_start();
//ini_set('display_errors',1);
require ("auto_path.php");

if (!isset($_POST['toemail']))$_POST['toemail']='royyau@astsl.com.hk';
if (!isset($_POST['toname']))$_POST['toname']='royy';
if (!isset($_POST['senderemail']))$_POST['senderemail']='royyau@astsl.com.hk';
if (!isset($_POST['sendername']))$_POST['sendername']='roy';

$_POST['href_prop']='http://'.$_SERVER['HTTP_HOST'].str_replace("ajax/getSendEmail2.php", "propDetail.php?id=", $_SERVER['PHP_SELF']);


//ini_set('display_errors',1);

/*---------------------------------------

use on : /ajax/postPropSearch.php

---------------------------------------*/
//require ("../include/mail2.php");


include __DIR__.'../class/mail2.php');

$mail	=	new sendmail();
if (isset($_POST['msg']))
$_POST['msg']=nl2br($_POST['msg']);
$_POST['file1']=$_FILES["file1"];
// var_dump($_POST);
$mail->setPost($_POST);
$mailresult		=	$mail->sdmail();
echo $mailresult;
// var_dump ($_FILES["file1"]);
// var_dump($_POST);
?>	