<?php
require("include/mortgage.php");

$mg2 = new mortgage();
$mg2->cal_mortgage_full_list();

?>
<style>
<!--
form { margin: 0px; padding: 0px; }
table.list {
    table-layout: fixed;
    border-collapse: collapse;
    width: 100%;
}
td.listHead {
    font-weight: bold;
    font-size: 110%;
    height: 30px;
    padding: 3px 5px 0px 5px;
    border-bottom: 3px solid #00355c;
    vertical-align: bottom;
    text-align: center;
}
.col1, .col2, .col3, .col4, .col5 { text-align: center; padding: 3px 5px 0px 5px; }
.col1 { width: 12%; }
.col2 { width: 22%; }
.col3 { width: 22%; }
.col4 { width: 22%; }
.col5 { width: 22%; }
.inputBox { width: 150px; }
-->
</style>
<div style="">
    <table class="list" width="50%">
        <col class="col1"></col>
        <col class="col2"></col>
        <col class="col3"></col>
        <col class="col4"></col>
        <col class="col5"></col>
        <tr>
        	<td class="listHead">����</td>
            <td class="listHead">�Q���Ѵ��B</td>
            <td class="listHead">�����Ѵ��B</td>
            <td class="listHead">�����Ѵ�</td>
            <td class="listHead">�����ٴھl�B</td>
        </tr>

		<?php  $ttt = $mg2->getFullPaymentList();
            foreach($ttt as $key => $value){
        ?>
        <tr>
        	<td class="col1"><?php echo $key+1; ?></td>
		<?php
			foreach($value as $key2 => $value2){ 
        ?>
           <td class="col2">$<?php echo number_format($value2,2,'.',','); ?></td>
		<?php
         	}
        ?>
		</tr>
<?php if((($key+1)%12)==0) { ?>
   <tr><td colspan="5"><hr></td></tr>
<?php }
  }
?>
	</table>
    <div style="clear:both;"></div>
        <div align=right>
            <form>
                <input type="button" value="���L" onClick="window.print()" />
            </form>
        </div>
    <div style="clear:both;"></div>
</div>