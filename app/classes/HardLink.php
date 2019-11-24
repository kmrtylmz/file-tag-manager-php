<?php 
namespace Abs;

use App\config;


class HardLink {

 			use config;


 				public $path;
 				public $tag;

 				private $hardlinkPath;
 				private $fileName; // for different extension
 				private $hardLink; // hardlink store
 				private $n_hard_link; // for Windows

 				function __construct($path , $tag) {

 					$this->hardlinkPath = $this->getFolder();
 					$this->path = trim($path);
 					$this->tag = $tag;
 					$this->fileName = basename($path);
 					$this->hardLink = $this->hardlinkPath."\\".$this->fileName;
 					$this->n_hard_link = str_replace('\\','\\\\', $this->hardLink);
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

 				public function findHardLinkPath(){

					 $arr = [];
					// return hardlink's referance url
					 exec("fsutil hardlink list ". $this->n_hard_link , $arr);

					$matches = preg_grep('@^([^\$][0-9-a-zA-z-_\.]+)@' , $arr );

						$originalpath = array_filter($matches , function($value){
						
							 if(strncmp($this->folder , $value , strlen($this->folder)) !== 0) {
							 		return $value; 
								}
								return;
						});
						
						return implode("" , $originalpath);
 				}

 			 	function _mime_content_type($filename) {
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
				        $mimeType = finfo_file($finfo, $filename);
				        finfo_close($finfo);

				        return $mimeType;


			 }

 	}