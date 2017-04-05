<?php

class mortgage
{
   private $price;
   private $percent;
   private $rate;
   private $period;
   private $principal;
   private $pmt;
   private $all_period;
   private $all_rate;
   private $payment_list;
   private $payment;
   private $sec_mortgage_premium;
   private $stamp_duty;
   private $stamp_duty_dsd;
   private $deposit;
   private $commission;
   private $totalpayment;
   private $totalinterest;
   private $fulllist;
   private $monthlypayment;
   private $principal_price;

    function __construct() {
        $this->getPostData();
    }

   public function setPrice($input) {
      $this->price = $input;
   }
   public function setPeriod($input) {
      $this->period = $input;
   }
   public function setRate($input) {
      $this->rate = $input;
   }
   public function setPercent($input) {
      $this->percent = $input;
   }


   public function getPrice() {
       return $this->price;
   }
   public function getPercent() {
       return $this->percent;
   }
   public function getRate() {
       return $this->rate;
   }
   public function getPeriod() {
       return $this->period;
   }


//   List out the relationship table between Rate & Period
   public function getPaymentList() {
       return $this->payment_list;
   }
//   List out the Rate List
   public function getRateList() {
       return $this->all_rate;
   }
//   List out the Period List
   public function getPeriodList() {
       return $this->all_period;
   }
//   2nd Mortgage Premium
   public function get2ndMortgagePremium() {
       return number_format($this->sec_mortgage_premium,2,'.',',');
   }
//   Stamp Duty
   public function getStampDuty() {
       return number_format($this->stamp_duty,2,'.',',');
   }
//   Stamp Duty DSD
   public function getStampDutyDSD() {
       return number_format($this->stamp_duty_dsd,2,'.',',');
   }    
//   Deposit
   public function getDeposit() {
       return number_format($this->deposit,2,'.',',');
   }
//   Commission
   public function getCommission() {
       return number_format($this->commission,2,'.',',');
   }
//   Full Payment (Loan + Interest)
   public function getTotalPayment() {
       return number_format($this->totalpayment,2,'.',',');
   }
//   Total Interest
   public function getTotalInterest() {
       return number_format($this->totalinterest,2,'.',',');
   }
//   List out the Payment in detail
   public function getFullPaymentList() {
       return $this->fulllist;
   }
//   Payment per month
   public function getMonthlyPayment() {
       return number_format($this->monthlypayment,2,'.',',');
   }
//   Principal
   public function getPrincipal() {
	   $this->cal_principal();
       return $this->principal_price;
   }



   private function cal_mortgage($rate_in,$period_in){
      $principal = $this->price * $this->percent / 100;
      $rate = $rate_in / 100 / 12;
      $period = $period_in * 12;
      $payment = round(($principal * $rate * pow(1+$rate,$period)) / (pow(1+$rate,$period) - 1),2);
	
      return $payment;
   }

   public function list_mortgage(){
      $this->all_period = array(5,10,15,20,25,30);
      if (!in_array($this->period,$this->all_period)){
         $this->all_period[] = $this->period;
         sort($this->all_period);
      }

      $this->all_rate = array(2.00,2.25,2.50,2.75,3.00,3.25,3.50,3.75,4.00,4.25,4.50,4.75,5.00,5.25,5.50,5.75,6);
      if (!in_array($this->rate,$this->all_rate)){
         $this->all_rate[] = $this->rate;
   	      sort($this->all_rate);
      }

      foreach ($this->all_rate as $row) {
         foreach ($this->all_period as $col) {
            $this->payment_list[$row*100][$col] = $this->cal_mortgage($row,$col);
         }
      }
	  
   }


   public function cal_sec_mort_premium(){
      $principal = $this->price * $this->percent / 100;

      $sec_mort_rate = array();
      $sec_mort_rate[1] = array(10 => 0.55, 15 => 0.60, 20 => 0.65 , 25 => 0.70 , 30 => 0.75);
      $sec_mort_rate[2] = array(10 => 1.00, 15 => 1.15, 20 => 1.40 , 25 => 1.50 , 30 => 1.65);
      $sec_mort_rate[3] = array(10 => 1.55, 15 => 1.80, 20 => 2.15 , 25 => 2.30 , 30 => 2.40);
      $sec_mort_rate[4] = array(10 => 2.15, 15 => 2.50, 20 => 2.98 , 25 => 3.35 , 30 => 2.55);
      $sec_mort_rate[5] = array(10 => 2.48, 15 => 2.88, 20 => 3.38 , 25 => 3.78 , 30 => 3.98);
/*
       foreach($sec_mort_rate as $key => $value)
       {
        foreach($value as $key2 => $value2)
        {
           echo $key.",".$key2."¦~=";
           echo $sec_mort_rate[$key][$key2]." . . . ";
        }
        echo "<br>";
      }
*/
      switch($this->period)
      {
          case $this->period<=10:
              $cal_period = 10;
              break;
          case $this->period>10 && $this->period<=15:
              $cal_period = 15;
              break;
          case $this->period>15 && $this->period<=20:
              $cal_period = 20;
              break;
          case $this->period>20 && $this->period<=25:
              $cal_period = 25;
              break;
          case $this->period>25 && $this->period<=30:
              $cal_period = 30;
              break;
      }

      switch($this->percent)
      {
          case $this->percent>70 && $this->percent<=75:
              $cal_rate = 1;
              break;
          case $this->percent>75 && $this->percent<=80:
              $cal_rate = 2;
              break;
          case $this->percent>80 && $this->percent<=85:
              $cal_rate = 3;
              break;
          case $this->percent>85 && $this->percent<=90:
              $cal_rate = 4;
              break;
          case $this->percent>90 && $this->percent<=95:
              $cal_rate = 5;
              break;
      }

      $this->sec_mortgage_premium = round($principal * $sec_mort_rate[$cal_rate][$cal_period] / 100, 1);
   }

   public function cal_stamp_duty(){
      switch($this->price)
      {
          case $this->price>0 && $this->price<=2000000:
              $cal_stamp_duty = 100;
              break;
          case $this->price>2000000 && $this->price<=2351760:
              $cal_stamp_duty = 100 + ($this->price - 2000000) * 0.1;
              break;
          case $this->price>2351760 && $this->price<=3000000:
              $cal_stamp_duty = $this->price * 0.015;
              break;
          case $this->price>3000000 && $this->price<=3290320:
              $cal_stamp_duty = 45000 + ($this->price - 3000000) * 0.1;
              break;
          case $this->price>3290320 && $this->price<=4000000:
              $cal_stamp_duty = $this->price * 0.0225;
              break;
          case $this->price>4000000 && $this->price<=4428570:
              $cal_stamp_duty = 90000 + ($this->price - 4000000) * 0.1;
              break;
          case $this->price>4428570 && $this->price<=6000000:
              $cal_stamp_duty = $this->price * 0.03;
              break;
          case $this->price>6000000 && $this->price<=6720000:
              $cal_stamp_duty = 180000 + ($this->price - 6000000) * 0.1;
              break;
          case $this->price>6720000:
              $cal_stamp_duty = $this->price * 0.0375;
              break;
      }
      switch($this->price)
      {
	      case $this->price>0 && $this->price<=2000000:
              $cal_stamp_duty_dsd = $this->price * 0.015;
              break;
          case $this->price>2000000 && $this->price<=2176470:
              $cal_stamp_duty_dsd = 30000 + ($this->price - 2000000) * 0.2;
              break;
          case $this->price>2176470 && $this->price<=3000000:
              $cal_stamp_duty_dsd = $this->price * 0.03;
              break;
          case $this->price>3000000 && $this->price<=3290330:
              $cal_stamp_duty_dsd = 90000 + ($this->price - 3000000) * 0.2;
              break;
          case $this->price>3290330 && $this->price<=4000000:
              $cal_stamp_duty_dsd = $this->price * 0.045;
              break;
          case $this->price>4000000 && $this->price<=4428580:
              $cal_stamp_duty_dsd = 180000 + ($this->price - 4000000) * 0.2;
              break;
          case $this->price>4428580 && $this->price<=6000000:
              $cal_stamp_duty_dsd = $this->price * 0.06;
              break;
          case $this->price>6000000 && $this->price<=6720000:
              $cal_stamp_duty_dsd = 360000 + ($this->price - 6000000) * 0.2;
              break;
          case $this->price>6720000 && $this->price<=20000000:
              $cal_stamp_duty_dsd = $this->price * 0.075;
              break;
          case $this->price>20000000 && $this->price<=21739130:
              $cal_stamp_duty_dsd = 1500000 + ($this->price - 20000000) * 0.2;
              break;
          case $this->price>21739130:
              $cal_stamp_duty_dsd = $this->price * 0.085;
              break;
	  }	  
      if ($this->price=="") {
         $cal_stamp_duty = 0;
         $cal_stamp_duty_dsd = 0;
	  }	
      $this->stamp_duty = round($cal_stamp_duty,1);
	  $this->stamp_duty_dsd = round($cal_stamp_duty_dsd,1);	  
   }


   public function cal_principal() {
       $this->principal_price = round($this->price * ($this->percent/100),0);
   }


   public function cal_deposit() {
       $this->deposit = round($this->price * (1-$this->percent/100),0);
   }


   public function cal_commission() {
       $this->commission = round($this->price * 1/100,0);
   }


   public function cal_totalpayment() {
      $this->totalpayment = $this->payment_list[$this->rate * 100][$this->period] * 12 * $this->period;
   }


   public function cal_monthlypayment(){
      $this->monthlypayment = $this->payment_list[$this->rate * 100][$this->period];
   }


   public function cal_totalinterest() {
      $this->totalinterest = ($this->payment_list[$this->rate * 100][$this->period] * 12 * $this->period) - $this->price + $this->price * (1-$this->percent/100);
   }


   private function getPostData() {
      if ($_GET) {
         $this->price			= $_GET['price'];
         $this->percent			= $_GET['mortgagerate'];
         $this->rate 			= $_GET['rate'];
         $this->period			= $_GET['period'];
      } else {
         if ($_POST) {
            $this->price		= $_POST['price'];
            $this->percent		= $_POST['mortgagerate'];
            $this->rate			= $_POST['rate'];
            $this->period		= $_POST['period'];
         }
      }
   }


    public function cal_mortgage_full_list() {
        $price			= $this->price;
        $mortgageRate	= $this->percent;
        $principal		= $price * ( $mortgageRate / 100 );
        $rate			= $this->rate;
        $period			= $this->period;

        $pmt = $rate/100/12 * (
                   (  0 + pow( ( 1+($rate/100/12) ), ($period*12) ) * $principal ) /
                   ( -1 + pow( ( 1+($rate/100/12) ), ($period*12) ) )
               );

        for ($i=0; $i < ($period*12); $i++) {
            $ratePayment = ( ($i==0) ? $principal : $fullpaymentlist[($i-1)]['remain'] ) * ($rate /100 / 12);

            $principalPayment = $pmt - $ratePayment;

            $remainPayment = ( ($i==0) ? $principal : $fullpaymentlist[($i-1)]['remain'] ) - $principalPayment;

            $fullpaymentlist[] = array(
                                            'rate'      => $ratePayment,
                                            'principal' => $principalPayment,
                                            'pmt'       => $pmt,
											'remain'    => $remainPayment

            );
        }

       $this->fulllist = $fullpaymentlist;
/*
       foreach($fullpaymentlist as $key => $value) {
          foreach($value as $key2 => $value2) {
             echo $key.", ".$key2."=".round($value2,2)." ___ ";
         }
         echo "<br>";
       }
*/
    }


}
?>