<?php  
		include ("FileUploader.php");
			$allowedExtensions = array();	
			$sizeLimit = 20 * 1024 * 1024;
			$uploader = new FileUploader($allowedExtensions);
			$result = $uploader->handleUpload($_GET['link'],true);
			$link=$uploader->getLink();
			echo json_encode($link);
			//echo json_encode($uploader->returnDir("."));
			
			?>