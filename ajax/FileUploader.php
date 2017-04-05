<?php

/**
 * Handle file uploads via XMLHttpRequest		ashfkljashdfjkhasjdfhlakjsdfkjasdlkfjhalksdhflj	asdasdasfasfasgasdgdg
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
		//echo $path;
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }
}

class FileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;
	private $error;
	private $basename;
	function returnDir($location)
	{
	
	return scandir($location);
	}
	function checkDir(){
		return (is_dir($location));
	}
    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
/*         if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
        }        
 */    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
	
	function getError(){
		return $this->error['error'];
	}
    function getLink(){
	$pathinfo=pathinfo($this->file->getName());
	$pathinfo['basename']=$this->file->getName();
	return $pathinfo;
	}
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
 		 if (!is_dir($uploadDirectory))
		 {
			if (mkdir($uploadDirectory,0777,true))
			{
				chmod($uploadDirectory,0777);
			}
		 }
 	
        if (!is_writable($uploadDirectory)){
					$this->error['error'][]='Directory folder is not writeable';
            return false;
        }
        
        if (!$this->file){
            return false;
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
			$this->error['error'][]='File is empty';
            return false;
        }
        
        if ($size > $this->sizeLimit) {
					$this->error['error'][]='File is too large';

            return false;
        }
        
        $pathinfo = pathinfo($this->file->getName());
		$filename=$this->file->getName();
      // $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];
        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
			$this->error['error'][]='File has an invalid extension, it should be one of '. $these . '.';
            return false;
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename )) {
                $filename .= rand(10, 99);
            }
        }
        
        if ($this->file->save($uploadDirectory . $filename)){
            return true;
        } else {
			$this->error['error'][]='Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered';
            return false;
        }
        
    }    
}


class resizer	{
	private $picID;
	
	private $image;
	private $image_type;
	private $awidth;
	private $aheight;
	private $file;
	private $extension;
//	I define ARRAY WHICH WILL CONTAIN THE EXTENT PERMITTED
	var $_extensiones_pe = array( "jpg", "png","gif" ,'bmp');
	
	public function setPicId($id)
	{
		$this->picID=$id;
	}
	
	
//	FUNCTION TO SEARCH FOR THE EXTENSION


	private function searchExtension( $name )	{
		if( trim( $name ) != "" )	{
//			I define EXPLODE WITH EXTENSION
			$extension = explode( ".", $name );
			$this->extension = strtolower( end( $extension ) );
//			REFUND THE EXTENSION
			return $this->extension;
		} else	{
//			Return a FALSE (BOOLEAN)
			return false;
		}
	}
	
//	CREATE FUNCTION NAME
	private function createsName( $name, $dir )	{
//		IF YOU CAN STILL GET THE EXTENSION
		if( $extension = $this->searchExtension( $name ) )	{
			if( substr( $dir, 0, -1 ) != "/" )	$dir = $dir . "/";
			$a = 1;
//			FIND A LOOP TO NOT REPEAT NOMBE
			while( $a )	{
//				EL NUEVO name SERA EJ: xañomesdia.extension
				$new_name = $dir . $a . date( "Ymd" ) . '.' . $extension;
				if( file_exists( $new_name ) )	{
					$a++;
				} else	{
					$a = 0;
				}
			}
//			DEVUELVO EL name
			return $new_name;
			
		} else	{
//			DEVUELVO FALSE ( BOOLEAN )
			return false;
		}
	}

 
   function load($filename) {
	$this->file=$filename;
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {

         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {

         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($dir, $permissions=777) {
		$result1=array();
		if ($filename=$this->createsName($this->file,$dir))
		{
				switch ($this->extension)
				{
					case "jpg":
						imagejpeg( $this->image, $filename, 99 );
						break;
					case "jpeg":
						imagejpeg( $this->image, $filename, 99 );
						break;
					case "png":
						imagepng( $this->image, $filename, 9 );
					break;
					case "gif":
						imagepng( $this->image, $filename, 9 );
					break;
					default	:
					$result1['error']='Not suppport this type file('.$this->extension.')';
					return $result1;
				}
			  

				 chmod($filename,0777);
			  
				$result1['message']="File uploaded successfully";
				$result1['file']=$filename;
				$result1['error']="";
				return $result1;

		
		}
		else 
		{
					$result1['error']='123213123 suppport this type file('.$this->extension.')';
					return $result1;

		}
      /* if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      } */
    
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   
   function calRatio($width,$height){
	if (($this->getWidth()/$this->getHeight())>1	)
	$this->resizeToWidth($width);
	else 
	$this->resizeToHeight($height);
   }
   
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
	  $this->aheight=$height;
	  $this->awidth=$width;	  
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
	  $this->aheight=$height;
	  $this->awidth=$width;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
	  $this->aheight=$height;
	  $this->awidth=$width;
      $this->resize($width,$height);
   }
 function getAWidth(){
 return  $this->awidth;
 }
  function getAHeight(){
 return  $this->aheight;
 }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
	
	
	
	
}


