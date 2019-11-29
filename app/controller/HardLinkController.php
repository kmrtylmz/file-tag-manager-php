<?php
namespace App\controller;

use Abs\HardLink;
use Abs\base\baseController;
use App\config;

/**
 * Class HardLinkController
 * @package App\controller
 */
class HardLinkController extends baseController {

	use config;

		private $TableObj;
		private $fileTableObj;
        private $hardLink;
        
    /**
     * HardLinkController constructor.
     *
     * @param mixed ...$arg  MUST
     *
     * @throws \ReflectionException
     */
		public function __construct(...$arg)
		{
				$this->TableObj = $this->model('TagTable');
				$this->fileTableObj = $this->model('FileTable');
                $this->hardLink = new HardLink();
		}
    
    /**
     * @return void
     */
		public function show () { 
			
				$arrTags = $this->TableObj->getAllTag();

				$this->view('index' , $arrTags);
		}
    
    /**
     * @param  array $append
     */
		public function getMore($append) {
					
				$arr = json_decode($append['data'], true);

			
				echo json_encode($this->TableObj->getAllTag($arr['start'],$arr['append']));

		}
    
    /**
     * @param array $fileUrl
     */
		public function open($fileUrl) {

				 parse_str($fileUrl['data'] , $arr);
				 
				$this->hardLink->openFileOrFolder($arr['file'], $arr['folder']);
				
		}
    
    /**
     * @param array $data
     */
		public function fileDelete($data) {

				parse_str($data['data'] ,$arrs);

			 	$arr = $this->fileTableObj->getFileEncoded($arrs['f_id']);
	
			 	$this->hardLink->fileTagDelete($arr[0]['fileencoded']);

			 	$this->fileTableObj->deleteFile($arrs['f_id']);
			 	
				
		}
    
    /**
     * @param array $tag
     */
		public function tagDelete($tag) {

				$arr = $this->fileTableObj->getFileEncodedTag($tag['data']); 
				
				if(count($arr) > 0) {
				for($i=0; $i < count($arr); $i++ ) {
					$this->hardLink->fileTagDelete($arr[0]['fileencoded']);
				}
				}
				 
			 $this->TableObj->deleteTag($tag['data']);
				
		}
    
    /**
     * @param array $tags
     */
    public function search($tags) {
        
        $files = $this->TableObj->getSearch($tags["search"]);
        $x = false;
        if(count($files)>0) {
            
            $filesArr = array_column($files, 'fileencoded');
            $filesOld = array_column($files, 'filename');
            $filesType = array_column($files, 'filetype');
            $filesSize = array_column($files, 'filesize');
            
            foreach ($filesArr as $key => $value) {
                $originalPathArr[] =  $this->hardLink->findHardLinkPath($value);
            }
            
            foreach ($originalPathArr as $key => $newpath) {
                
                $filetype = mime_content_type($newpath);
                
                $filesize = filesize($newpath). 'bytes';
                
                if(!file_exists($filesOld[$key]) || $filesType[$key] !== $filetype || $filesSize[$key] !== $filesize) {
                    $this->fileTableObj->updateHardLinkPath( $filetype , $filesize , $newpath, $filesArr[$key]);
                    $x=true;
                }
                else {
                    continue;
                }
            }
            if($x){
                $newFiles = $this->TableObj->getSearch($tags["search"]);
                echo json_encode($newFiles);
            }
            else{
                echo json_encode($files);
            }
        }
        
        
    }
    
    /**
     * @param array $arr
     */
		public function create($arr) {

				extract($arr);	// path, tag
            
                $filters = [ '"' , "?", "*" , "|" , "<" , ">" , "\\" ,":"];
    
				$path = str_replace($filters , null , $path);
				
 				$this->hardLink->initalize($path, $tag);
			
 				 if($this->hardLink->checkType())
 				 {	

 				 	if($this->hardLink->checkPathAndBool()) {
						$mime = $this->hardLink->_mime_content_type($path);
						$filesize = filesize($path). 'bytes';

 				 		if($this->TableObj->createTag($this->hardLink->path , $this->hardLink->tag , $mime , $filesize , $this->hardLink->token)) { //True

 				 				if($this->hardLink->createHardLink()){
 				 		        	$this->redirect("completed");
 				 				} 
 				 				else {
 				 				$this->redirect("filefail");
 				 				} 								 			
 				 		   }
 				 		else {
 				 				$this->redirect("dbfail");
 				 		}
					}
					else {
							$this->redirect("taggedError");
					}
 				 }
 				 else {
					$this->redirect("typefail");
 				
 				}		
			}
			
			
			


}