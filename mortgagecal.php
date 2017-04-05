
<?php
header('Content-type: text/plain; charset=Big5');
 
require("include/mortgage.php");

$mg = new mortgage;

$mg->list_mortgage();
$mg->cal_sec_mort_premium();
$mg->cal_stamp_duty();
$mg->cal_commission();
$mg->cal_totalpayment();
$mg->cal_totalinterest();
$mg->cal_deposit();
$vb2 = $mg->getPeriodList();
$mg->cal_monthlypayment();
$mg->cal_principal();
//get from url
$mg->getPrice();
$mg->getPercent();
$mg->getPrincipal();
$mg->getRate();
$mg->getPeriod();

?>

			<table id="roughTable" class="size2" cellpadding="2" style="padding:10px 10px 24px 10px;padding:10px 10px 2px 10px\0; ">
                <tr align="left">
                    <td valign="bottom" align="left" width="125" >
					
					<span class="style6"><strong>�C��Ѵ��B:</strong></span> </td>
                    <td valign="bottom" width=""><strong>$<?php echo $mg->getMonthlyPayment(); ?></strong> </td></tr>
                <tr align="left">
                    <td valign="bottom" width=""><span class="style6"><strong>�����Q���@:</strong> </span></td>
                    <td valign="bottom" width=""><strong>$<?php echo $mg->getTotalInterest();?></strong></td></tr>
                <tr align="left">
                    <td valign="bottom" width=""><span class="style6"><strong>�����Ѵڦ@:</strong></span></td>
                    <td valign="bottom" width=""><strong>$<?php echo $mg->getTotalPayment();?></strong></td></tr>
                <tr align="left">
                    <td valign="bottom" width=""><span class="style6"><strong>����:</strong> </span></td>
                    <td valign="bottom" width=""><strong>$<?php echo $mg->getDeposit();?></strong></td></tr>
                
                <tr align="left">
                    <td valign="bottom" width=""><span class="style6"><strong>�g������:</strong> </span></td>
                    <td valign="bottom" width=""><strong>$<?php echo $mg->getCommission();?></strong></td></tr>
                <tr align="left">
                    <td valign="middle" width=""><span class="style6"><strong>�L��|:</strong> </span></td>
                    <td valign="bottom" width=""><select style="width:100px;color:red;" onchange="getval(this);">
                                 							  <option id="" value="<?php echo $mg->getStampDutyDSD();?>"><stong>DSD</strong></option>
                                                              <option id="" value="<?php echo $mg->getStampDuty();?>"><stong>SD</strong></option>
                             							  </select>
                                                          <strong><span id="ds">$<?php echo $mg->getStampDutyDSD();?></span></strong></td></tr>     	  
                <!--<tr align="left">
                    <td valign="bottom" width=""><span class="style6"><strong>�����O�I:</strong> </span></td>
                    <td valign="bottom" width=""><strong>$<?php echo $mg->get2ndMortgagePremium();?></strong></td></tr>
                <tr align="left">
                    <td width="">&nbsp; </td>
                    <td valign="bottom" width=""><font size=2><strong>(�@���I�M�O�I�O�p��)</strong></font></td>
                </tr>-->
            </table>
			
			
			<table id="detailTable" align="left" cellspacing="0" bgcolor="#eeeeee" width="100%" border="1" >
                <tr valign="top" bgcolor="#fafafa">
                    <td align="center"  colspan="1" valign="bottom"><b>�Q�v</b></td>
            
                    <?php
                        foreach($vb2 as $key2) {
                    ?>
            
                    <td align="center"><b><?php echo $key2;?>�~</b></td>
            
                    <?php } ?>
                </tr>
            
                <?php
                    foreach($mg->getPaymentList() as $key => $value){
                ?>
            
                <tr valign="top" bgcolor="#fafafa">
                    <td height="28" align="center"  ><?php echo $key/100; ?>%</td>
            
                    <?php
                        foreach($value as $key2 => $value2){
                            if($key2==$mg->getPeriod() || ($key/100)==$mg->getRate()){
                    ?>
            
                    <td align="center" bgcolor="#fffdd7"><?php echo $value2; ?></td>
                    <?php
                            }else{
                    ?>
                    <td align="center" ><?php echo $value2; ?></td>
                    <?php }
                        }
                    ?>
                </tr>
            <?php } ?>
            </table>

