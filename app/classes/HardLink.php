<?php 
namespace Abs;

use App\config;


class HardLink {

 			use config;


 				public $path;	// olusturulacak olan path değeri. C:\bb\mert.txt
 				public $tag;	

 				private $hardlinkPath;
 				private $n_hard_link; // for Windows Then Update for Unix
 				public $token; 
 				private $files;

 				function __construct($path , $tag) {

 					$this->hardlinkPath = $this->getFolder();
 					$this->path = trim($path);
 					$this->tag = trim($tag);
 				

 					$this->token = base64_encode($this->path); // benzersiz olan aynı klasör altında 2 dosyanın aynı isimde olamayacagıdır :)

 					$this->files = $this->hardlinkPath."\\".$this->token;  // C:\tags\base64 files..

					$this->n_hard_link = str_replace('\\','\\\\', $this->files);

 					//str_rot13  özel karakterlerde patlar veriyor. \   Böyle bir dosya adı olusturulamaz.

 					if(!is_dir($this->hardlinkPath))
 					{
				 	 mkdir($this->hardlinkPath , 0777);
					}

 				}


				public function checkPathAndBool()  {
 					 
 					 return  !file_exists($this->n_hard_link) && file_exists($this->path) ?   true : false ; 

 				}

 				public function checkType() {

 						if(is_file($this->path) || is_executable($this->path) || is_readable($this->path) || is_writable($this->path)) {

 								return true;

 						}

 						else
 						{ 
 								return false;
 						}
 				}

 				public function createHardLink() {
 					return link($this->path , $this->n_hard_link);
 				}

 				public function removeHardLinkFile($path) {

 					//shell_exec("del /f ")
 				}

 				public function findHardLinkPath(){

					//  $arr = [];
					// // return hardlink's referance url
					//  exec("fsutil hardlink list ". $this->n_hard_link , $arr);

					// $matches = preg_grep('@^([^\$][0-9-a-zA-z-_\.]+)@' , $arr );

					// 	$originalpath = array_filter($matches , function($value){
						
					// 		 if(strncmp($this->folder , $value , strlen($this->folder)) !== 0) {
					// 		 		return $value; 
					// 			}
					// 			return;
					// 	});
						
					// 	return implode("" , $originalpath);
 				}

 			 	function _mime_content_type($filepath) {
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
				        $mimeType = finfo_file($finfo, $filepath);
				        finfo_close($finfo);

				        return $mimeType;


			 }

 	}