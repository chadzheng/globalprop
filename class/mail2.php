<?php
// ini_set('display_errors', 1);

class sendmail{

//for magazine
private $email;
private $fname;
private $lname;

//corporate
private $name;
//private $email;
private $contact_no;
private $msg;


private $mail_type; //for source

//property detail
private $prop_id;


//check valid
private $check;
private $checkPoint;
private $group;
private $captcha_code;
private $check_captcha_code;
private $err_msg;



//career
private $file;
private $file1;

//list prop (postweb)
private $bedroom;
private $rental;
private $rental_type;
private $prop_addr;
private $area;
private $price;
private $others;
private $Features;
private $facili;
private $layout;
private $usage;
private $address;
private $district;
private $building;


private $rent;
private $description;
private $contact;
private $phone1;
private $CRequest_0;
private $CRequest_1;

//basice info
private $lang;
private $pageTitle;
private $subject;
private $htmlmsg;
private $senderemail;
private $toaddress;
private $toname;
private $toemail;
private $sendername;
private $showInMail;
private $showInMailProperty;
private $showAfter;


private $CAPTCHA;
private $href_prop;
private $useArray;
private $propInfo;

//-----------------initialize------------
	public function __construct(){
	
		$this->lang='c';
		
		$this->CAPTCHA['c']='驗證碼錯誤,請重新輸入';
		$this->CAPTCHA['e']='CAPTCHA not match, Please type again!';
		$this->propInfo['c']='物業資料';
		$this->propInfo['e']='Property Information';
		//$this->senderemail='royyau41@gmail.com';
		//$this->sendername='ASTBSL';
		//$this->toemail='royyau41@gmail.com';
		//$this->toname='ASTBSL,ASTBSL,ASTBSL';

		// $toaddress;
		 //$toname;
	}

	public function setPost($post)
	{
		if (is_array($post)) {
			foreach($post as $key => $value) {
						if (array_key_exists($key,get_object_vars($this)))
						{
							// echo $key.'   ';
							$this->$key = $value;
						}
				}
			}
	
	}
	
	

	public function sdmail(){
		
		
		if (true){
			switch ($this->mail_type)
			{
				case "propertyDetail":
				$this->showInMail();
				$this->propDeatailHtml();
				break;
				case "postweb":
				$this->showInMail();
				$this->postWebHtml();
				break;
				default:
				$this->showInMail();
				$this->setHtmlContent();
				
				
			}
			if ($result=$this->mail())
				{
					if( $this->file1['tmp_name']!=null){unlink('../'.$this->file1['name']);}
					return json_encode(array("error"=>'',"result"=>'1'));
				}
				else
				{
					if( $this->file1['tmp_name']!=null){unlink('../'.$this->file1['name']);}
					return json_encode(array("error"=>$result,"result"=>''));
				}
				break;
		}	
		else {
			$array=array("error"=>$err,"result"=>'');
			return json_encode($array);
		}
	}	

	
	//----------------------------------------------------------------------------------------------------------------
	
	private function showInMail(){
		switch ($this->mail_type){
			case 'career':
				$this->showInMail=array('name'=>'Name','email'=>'E-mail','contact_no'=>'Contact No','msg'=>'Message');
			break;
			case 'corporate':
				$this->showInMail=array('name'=>'Name','email'=>'E-mail','contact_no'=>'Contact No','msg'=>'Message');
			break;
			case 'business':
				$this->showInMail=array('name'=>'Name','email'=>'E-mail','contact_no'=>'Contact No','msg'=>'Message');
			break;
			case 'subscription':
				$this->showInMail=array('fname'=>'First Name','lname'=>'名字','email'=>'E-mail');
			break;
			case 'propertyDetail':
				switch($this->lang){
					case 'c':
					$this->showInMail=array('name'=>'Name','email'=>'E-mail','contact_no'=>'Contact No','msg'=>'Message','CRequest_0'=>'預約睇樓','CRequest_1'=>'室內相片');
					$this->showInMailProperty=array('PROPERTYNO'=>'樓盤編號','C_PREMISES'=>'物業名稱','C_USAGE'=>'物業用途','C_STREET'=>'街道','NAREA'=>'實用面積','GAREA'=>'建築面積','PRICE'=>'價錢','AVGPRICE'=>'平均售價','RENT'=>'租金','AVGRENT'=>'AverageRent','C_REMARKS'=>'簡介');
				
					break;
					case 'e':
					$this->showInMail=array('name'=>'Name','email'=>'E-mail','contact_no'=>'Contact No','msg'=>'Message','CRequest_0'=>'Request Appointment','CRequest_1'=>'Request inside pictures');
					$this->showInMailProperty=array('PROPERTYNO'=>'Property No','E_PREMISES'=>'Premises','E_USAGE'=>'Usage','E_STREET'=>'Street','NAREA'=>'Net Area','GAREA'=>'Gross Area','PRICE'=>'Price','AVGPRICE'=>'Average Price','RENT'=>'Rent','AVGRENT'=>'Average Rent','E_REMARKS'=>'Remarks');
				
					break;
					default:
					$this->showInMail=array('name'=>'姓名','email'=>'E-mail','contact_no'=>'電話','msg'=>'Message','request1'=>'預約睇樓','request2'=>'室內相片');
					$this->showInMailProperty=array('PROPERTYNO'=>'樓盤編號','C_PREMISES'=>'物業名稱','C_USAGE'=>'物業用途','C_STREET'=>'街道','NAREA'=>'實用面積','GAREA'=>'建築面積','PRICE'=>'價錢','AVGPRICE'=>'平均售價','RENT'=>'租金','AVGRENT'=>'AverageRent','C_REMARKS'=>'簡介');
				
					break;
				}
				
				$this->href_prop.=$this->prop_id;
			break;
			case 'postweb':
			switch($this->lang){
				case 'c':
				$this->showInMail=array('contact'=>'聯絡人','phone1'=>'聯絡電話','email'=>'Email');
				//$this->showAfter=array('rental'=>'rental_type');
				//$this->useArray=array('Features'=>'Features','facili'=>'Facilities','layout'=>'Layout');
				$this->showInMailProperty=array('usage'=>'分類','district'=>'地域','building'=>'物業名稱','address'=>'物業地址','area'=>'單位面積','price'=>'放盤價格','rent'=>'租價','description'=>'備註');
				break;
				case 'e':
				$this->showInMail=array('contact'=>'Contact','phone1'=>'Phone No','email'=>'Email');
				$this->showInMailProperty=array('usage'=>'Usage','district'=>'District','building'=>'Building Name','address'=>'Address','area'=>'Area','price'=>'Price','rent'=>'Rent','description'=>'Remarks');
				break;
			}
				
			break;
			default:
			$this->showInMail=array('name'=>'姓名','email'=>'E-mail','contact_no'=>'電話','msg'=>'Message','request1'=>'預約睇樓','request2'=>'室內相片');


			
		
		}
		
		return $this->showInMail;
	
	}
	
	private function checkValid()
	{
			require_once("Securimage.php");
			require_once("Validator.php");
			$Form	=	new Validator;
			foreach ($this->check as $index =>$f_arr){
				
				// ||($f_arr['group']!='undefined'&&$f_arr['checkalone'])
				if (($f_arr['group']=='undefined'))		{
					
					$Form	->	ValidField($this->$f_arr['field'],$f_arr['check'],$f_arr['err_msg']);
				}else {
					if (in_array($f_arr['group'],$this->group)){
						break;
					}else {
						$this->group[]=$f_arr['group'];
						$this->checkPoint=false;
						foreach ($this->check as $group_index =>$group_field){
							
							if ($f_arr['group']==$group_field['group'])
								if ($Form	->	fastValidField($this->$group_field['field'],$group_field['check'],$group_field['err_msg'])){
								
									$this->checkPoint=true;
									break;
								}
						}
						if (!$this->checkPoint){
							$Form	->	ValidField($this->$f_arr['field'],$f_arr['check'],$f_arr['err_msg']);
						}
						
					}
				}
				
			}
			#check captcha code
			if ($this->check_captcha_code){
			
			$img = new Securimage();
			$valid_code= $img->check($this->captcha_code);#valid- true or flase
			 if(!$valid_code)
				$Form	->	ValidField("",'email','<font color="red">'.$this->CAPTCHA[$this->lang].'</font>');

			}
			# check form valid 
			 
			//return ("");
			Return ($Form->getValidErrMsg());
	}
	
	
	private function setHtmlContent(){
	ob_start();
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta http-equiv="X-UA-Compatible" content="IE=edge" >	


				<!--<script type="text/javascript" src="./js/imageResize.js"></script>-->
				<title> </title>
			</head>

			<body >
				<div style="width:600px;margin:0 auto;border:1px solid #BFBFBF">
					<div class='title' style='height: 36px;
												line-height: 36px;
												vertical-align: middle;
												border: 1px solid #BFBFBF;
												background: #F1F1F1;
												margin-bottom: 10px;
												padding-left: 10px;
												color: #555;
												font-size: 14px;
												'><?php if ($this->pageTitle)echo $this->pageTitle; else echo $this->subject?></div>
			<div class='clear'></div>
			<div class='content' style='font-size: 14px;'>
				<table style=' line-height:150%'>
				<?php foreach ($this->showInMail as $key =>$val)
				{?>
					<tr valign='top'>
						<td><?php echo $val?></td>
						<td>:</td>
						<td><?php echo $this->$key?>
								<?php if (array_key_exists($key,$this->showAfter)){
											echo "   ".$this->{$this->showAfter[$key]};
										}
										?></td>
					</tr>
				<?php }?>
				</table>
			</div>

			</body>
			</html>
	
	
	<?php 
	$this->html = ob_get_clean();
	
	}

	private function propDeatailHtml()
	{
	
		//require ("../ajax/auto_path.php");

		$pDetailLoader 	=	new resPropertyNew;
							$pDetailLoader->setPropertyNumber($this->prop_id);
		$pDetail		=	json_decode($pDetailLoader->getPropertyDetail(),true);

		$pDetail=$pDetail[0];
		// $this->toemail[]=$pDetail['CONTACTEMAIL'];
		ob_start();
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<meta http-equiv="X-UA-Compatible" content="IE=edge" >	


					<!--<script type="text/javascript" src="./js/imageResize.js"></script>-->
					<title> </title>
				</head>

				<body >
				<div style="width:600px;margin:0 auto;border:1px solid #BFBFBF">
						<div class='title' style='height: 36px;
													line-height: 36px;
													vertical-align: middle;
													border: 1px solid #BFBFBF;
													background: #F1F1F1;
													margin-bottom: 10px;
													padding-left: 10px;
													color: #555;
													font-size: 14px;
													'><?php if ($this->pageTitle)echo $this->pageTitle; else echo $this->subject?></div>
					<div class='clear'></div>
					<div class='content' style='font-size: 14px;'>
						<table style=' line-height:150%'>
						<?php foreach ($this->showInMail as $key =>$val)
								if ($this->$key){
						{?>
							<tr valign='top'>
								<td><?php echo $val?></td>
								<td>:</td>
								<td><?php echo $this->$key?></td>
							</tr>
						<?php }}?>
							<tr>
								<td colspan='3'>The Client interest the property below </td>
							</tr>

						</table>
						
						
					</div>
				</div>
				<div style="width:600px;margin:0 auto;border:1px solid #BFBFBF">
						<div class='title' style='height: 36px;
													line-height: 36px;
													vertical-align: middle;
													border: 1px solid #BFBFBF;
													background: #F1F1F1;
													margin-bottom: 10px;
													padding-left: 10px;
													color: #555;
													font-size: 14px;
													'><?php echo ($this->lang=='c'?$pDetail['C_PREMISES']:$pDetail['E_PREMISES']);?></div>
				<div class='clear'></div>
				<div class='content' style='font-size: 14px;'>
					<table style=' line-height:150%'>
					<?php foreach ($this->showInMailProperty as $key =>$val)
					 if ($pDetail[$key]){
					{?>
						<tr valign='top'>
							<td><?php echo $val?></td>
							<td>:</td>
							<td><?php echo $pDetail[$key]?></td>
						</tr>
					<?php }}?>
						<tr>
							<td>Link</td>
							<td>:</td>
							<td><?php echo $this->href_prop?></td>

					</table>
					
				</div>
				</div>

				</body>
				</html>
		
		
		<?php 
		$this->html = ob_get_clean();
		
		
	}
	private function postWebHtml()
	{
	
		//require ("../ajax/auto_path.php");

		ob_start();
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<meta http-equiv="X-UA-Compatible" content="IE=edge" >	


					<!--<script type="text/javascript" src="./js/imageResize.js"></script>-->
					<title>Amazing </title>
				</head>

				<body >
				<div style="width:600px;margin:0 auto;border:1px solid #BFBFBF">
						<div class='title' style='height: 36px;
													line-height: 36px;
													vertical-align: middle;
													border: 1px solid #BFBFBF;
													background: #F1F1F1;
													margin-bottom: 10px;
													padding-left: 10px;
													color: #555;
													font-size: 14px;
													'><?php if ($this->pageTitle)echo $this->pageTitle; else echo $this->subject?></div>
					<div class='clear'></div>
					<div class='content' style='font-size: 14px;'>
						<table style=' line-height:150%'>
						<?php foreach ($this->showInMail as $key =>$val)
						{?>
							<tr valign='top'>
								<td><?php echo $val?></td>
								<td>:</td>
								<td><?php echo $this->$key?></td>
							</tr>
						<?php }?>
							

						</table>
						
						
					</div>
				</div>
				<div style="width:600px;margin:0 auto;border:1px solid #BFBFBF">
						<div class='title' style='height: 36px;
													line-height: 36px;
													vertical-align: middle;
													border: 1px solid #BFBFBF;
													background: #F1F1F1;
													margin-bottom: 10px;
													padding-left: 10px;
													color: #555;
													font-size: 14px;
													'><?php echo $this->propInfo[$this->lang];?></div>
				<div class='clear'></div>
				<div class='content' style='font-size: 14px;'>
					<table style=' line-height:150%'>
					<?php foreach ($this->showInMailProperty as $key =>$val){
						if ($this->$key)
					{?>
						<tr valign='top'>
							<td><?php echo $val?></td>
							<td>:</td>
							<td><?php echo $this->$key?> 
									<?php if (array_key_exists($key,$this->showAfter)){
											echo "   ".$this->{$this->showAfter[$key]};
										}
										?>
									</td>
						</tr>
					<?php }}?>
					<?php foreach ($this->useArray as $key =>$val)
										{?>
						<tr valign='top'>
							<td><?php echo $val?></td>
							<td>:</td>
							<td><?php echo implode(",",$this->$key);?>
									</td>
						</tr>
					<?php }?>
						<!--<tr>
							<td>Others</td>
							<td>:</td>
							<td><?php echo $this->others?></td>
						</tr>-->

					</table>
					
				</div>
				</div>

				</body>
				</html>
		
		
		<?php 
		$this->html = ob_get_clean();
		
		
	}
	private function mail()
	{
 
		include_once("PHPMailer_v5.1/class.phpmailer.php");
		include_once("PHPMailer_v5.1/language/phpmailer.lang-en.php");    
		$mail= new PHPMailer();    
		$mail->CharSet = "utf-8"; 
		$mail->Encoding = "base64";
		$mail->From = $this->senderemail;       
		$mail->FromName = $this->sendername;  
		$mail->Subject = $this->subject;       
		// var_dump($this->toemail);
		if( $this->file1['name']!=null){
			if (move_uploaded_file($this->file1['tmp_name'],'../'.$this->file1['name']))
			$mail->AddAttachment('../'.$this->file1['name']);     
		}

		$mail->Body = $this->html;       
		$mail->IsHTML(true);    
		$this->toemail=explode(',',$this->toemail);
		$this->toname=explode(',',$this->toname);
			foreach ($this->toemail as $key =>$val)
			{
					$mail->AddAddress($val,$this->toname[$key]); 
			}

		return ($mail->Send());

		
	}


}
?>