<?php

/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
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
    function save($path) { echo $path.'aaaa'; exit;
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

class qqFileUploader {
    private $allowedExtensions = array();
    //private $sizeLimit = 10485760;
    private $sizeLimit = 1073741824;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 1073741824){        
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
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
        }        
    }
    
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
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
	
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }
        
        if(!$replaceOldFile){ 
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                //$filename .= rand(10, 99);
				unlink($uploadDirectory . $filename . '.' . $ext);
            }
        }
        
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)){
			//return array('success'=>true);
			
			//$transfer = $this->transferFile($filename . '.' . $ext);
			//$transfer = true;
			//if($transfer) {
				//unlink($uploadDirectory . $filename . '.' . $ext);
				return array('success'=>'true');
			/*} else {
				return array('error'=>'Could not transfer file');
			}*/
            
        } else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
        
    }
	
	function transferFile($filename) { echo "string";exit();
		$uploadFile = '../../vod/temp/'.basename($filename);
		$handle    = fopen('../../vod/temp/'.$filename, "r");
		$data      = fread($handle, filesize($filename));
		$POST_DATA = array(
		   //'file' => base64_encode($data)
		   'fileName' => basename($uploadFile),
           'fileData' => base64_encode(file_get_contents($uploadFile))
		);
		
		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "http://127.0.0.1/makasar/admin/handle.php");
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_POSTFIELDS, $POST_DATA);
		
		$response = curl_exec($c);

		curl_close($c);
		//fclose($fp); 
		
		if ($response) return true;
		return false;
	}

	
}

/*
ini_set('memory_limit', '512M');
ini_set('upload_max_filesize', '1024M');
ini_set('post_max_size', '1024M');
ini_set('max_input_time', 600);
ini_set('max_execution_time', 600);
*/
include('../config.php');
// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array();
// max file size in bytes
$sizeLimit = 1024 * 1024 * 1024;
//echo $config['vod_server'].$config['vod_path'].'/temp/'; exit;
$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload('../vod/movies/', TRUE);
	
// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
