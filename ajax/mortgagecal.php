<?php
session_start();
require_once("../include/mortgage.php");

$mg = new mortgage();

$mg->list_mortgage();
$mg->cal_sec_mort_premium();
$mg->cal_stamp_duty();
$mg->cal_commission();
$mg->cal_totalpayment();
$mg->cal_totalinterest();
$mg->cal_deposit();

$mg->getPeriodList();
$mg->cal_monthlypayment();
$mg->cal_principal();

//get from url
$mg->getPrice();
$mg->getPercent();
$mg->getPrincipal();
$mg->getRate();
$mg->getPeriod();

//get result from server
$rTableArr		=	array();
$dTableArr		=	array();
$output			=	array();
	$rTableArr["MONTHLY_PAYMENT"]	=	$mg->getMonthlyPayment();
	$rTableArr["TOTAL_INTEREST"]	=	$mg->getTotalInterest();
	$rTableArr["TOTAL_PAYMENT"]		=	$mg->getTotalPayment();
	$rTableArr["DEPOSIT"]			=	$mg->getDeposit();
	$rTableArr["STAMP_DUTY"]		=	$mg->getStampDuty();
	$rTableArr["COMMISSION"]		=	$mg->getCommission();
	$rTableArr["MORTGAGE_PREMIUM"]	=	$mg->get2ndMortgagePremium();
	
	$dTableArr["PERIOD_LIST"]		=	$mg->getPeriodList();
	$dTableArr["PAYMENT_LIST"]		=	array();
	foreach($mg->getPaymentList() as $key=>$val){
		$tempArr["RATE"]	=	$key;
		$tempArr["PAYMENT"]	=	array();
		foreach ($val	as 	$key2	=>	$val2){
			array_push($tempArr["PAYMENT"],$val2);
		}
		array_push($dTableArr["PAYMENT_LIST"],$tempArr);
	}
	
$output["ROUGH_DATA"]	=	$rTableArr;
$output["DETAIL_DATA"]	=	$dTableArr;
echo json_encode($output);
?>