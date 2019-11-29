<?php 
namespace Abs;

use App\config;

/**
 * Class HardLink
 * @package Abs
 */
class HardLink {

 			use config;

                // path value. Exaple =  C:\bb\childControllers.txt
 				public $path;
 				public $tag;	

 				private $hardlinkPath;
 				private $n_hard_link; // for Windows Then Update for Unix
 				public $token; 
 				private $files;

 				function __construct() {
 				
 				}
 				
 				public function  initalize($path , $tag){
                   
                    $this->hardlinkPath = $this->getFolder();
                    $this->path = trim($path);
                    $this->tag = trim($tag);
                   
                    // benzersiz olan aynı klasör altında 2 dosyanın aynı isimde olamayacagıdır :)
                    $this->token = base64_encode($this->path);
                   
                    // C:\tags\base64 files..
                    $this->files = $this->hardlinkPath."\\".$this->token;
                   
                    $this->n_hard_link = str_replace('\\','\\\\', $this->files);
                    //str_rot13  özel karakterlerde patlar veriyor. \   Böyle bir dosya adı olusturulamaz.
                   
                    if(!is_dir($this->hardlinkPath))
                    {
                        mkdir($this->hardlinkPath , 0777);
                    }
                }
    
    /**
     * @return bool
     */
				public function checkPathAndBool()  {
 					 
 					 return  !file_exists($this->n_hard_link) && file_exists($this->path) ?   true : false ; 

 				}
    
    /**
     * @return bool
     */
 				public function checkType() {

 						if(is_file($this->path) || is_executable($this->path) || is_readable($this->path) || is_writable($this->path) || is_string(mime_content_type($this->path))) {

 								return true;
 								
 						}
 						
 						else
 						{ 
 								return false;
 						}
 				}
    
    /**
     *
     * @return bool
     */
 				public function createHardLink() {
 					return link($this->path , $this->n_hard_link);
 				}

 				public function removeHardLinkFile($path) {

 					//shell_exec("del /f ")
 				}
    
    /**
     * @param  string $fileencoded
     *
     * @return string
     */
 				public function findHardLinkPath($fileencoded){
                   
                    $path = $this->getFolder(). "\\".$fileencoded;
                    $n_hard_link = str_replace('\\', '\\\\', $path);
                    $arr = [];
                    // return hardlink's referance url
                    exec("fsutil hardlink list ". $n_hard_link , $arr);
                   
                    $matches = preg_grep('@^([^\$][0-9-a-zA-z-_\.]+)@' , $arr );
                   
                   
                    $originalPath = array_map(function($value){
                        $home = $this->homeDrive();
                        if(strncmp($this->folder , $value , strlen($this->folder)) !== 0) {
                            return $home.$value;
                        }
                        return;
                    }, $matches);
                   
                    $originalPath = implode($originalPath);
                    
                    return $originalPath;
 				
 				}
    
    /**
     * @param  string $filepath
     *
     * @return string
     */
 			 	public function _mime_content_type($filepath) {
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
				        $mimeType = finfo_file($finfo, $filepath);
				        finfo_close($finfo);

				        return $mimeType;


			     }
    
    /**
     * @param string $file
     * @param string $folder
     *
     * @return void
     */
			     public function openFileOrFolder($file , $folder = "") {
                
                     $explorer = $this->getExplorerExe();
                     
                     if(isset($folder) && $folder == "ok"){
                         $folderopen = dirname($file);
                         shell_exec("$explorer /n,/e, $folderopen");
                     }
                     else {
                         shell_exec("$explorer /n,/e, $file");
                     }
                
                 }
    
    /**
     * @param string $fileencoded
     *
     * @return  void
     */
                 public function  fileTagDelete($fileencoded){
    
                     $file = $this->getFolder() . "\\". $fileencoded;
    
                     unlink($file);
 			 	    
                 }
			 
			 

 	}