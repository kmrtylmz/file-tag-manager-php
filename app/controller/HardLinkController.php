<?php
namespace App\controller;

use Abs\HardLink;
use Abs\base\baseController;
use App\config;

class HardLinkController extends baseController {

	use config;

		private $Obj;
		private $fileTableObj;
		public function __construct(...$arg) 
		{
				$this->Obj = $this->model('TagTable');
				$this->fileTableObj = $this->model('FileTable');
		}

	
		public function show () { 
			
				$arrTags = $this->Obj->getAllTag();

				$this->view('index' , $arrTags);
		}

		public function search($tags) {


			echo json_encode($this->Obj->getSearch($tags["search"]));

		}

		public function open($file) {

				$explorer = $_ENV["SYSTEMROOT"] . '\\explorer.exe';

				 parse_str($file['data']);

				 if(isset($folder)){		// !! düzeltilecek Hardlink.php e taşı..
				 		$folderopen = dirname($file);
				 		shell_exec("$explorer /n,/e, $folderopen");
				 }  
				 else {
				 	shell_exec("$explorer /n,/e, $file");
				 }  
				 echo "OK";
		}

		public function delete($data) {

				parse_str($data['data']);

			 	

			 	$arr = $fileTableObj->getFileEncoded($f_id);
	
				 //	$try = new HardLink()	! düzeltilecek..
			 	$file = $this->getFolder() . "\\". $arr[0]['fileencoded'];

			 	unlink($file);

			 	$fileTableObj->deleteFile($f_id);
			 	$fileTableObj->kill();

			 	echo "Tags altından ve Db den silindi..";
				
		}

		public function tagDelete($tag) {

				$arr = $this->fileTableObj->getFileEncodedTag($tag['data']); 
				
				print_r($arr[0]);

				for($i=0; $i < count($arr); $i++ ) {
					$file = $this->getFolder() . "\\". $arr[$i]['fileencoded'];
					unlink($file);
				}
	
				 
				$a = $this->Obj->deleteTag($tag['data']);

				
				echo "Tags altından dosyalar silindi ve Db den silindi.";
			
		}


		public function create($arr) {	// Arg

				extract($arr);								
				$path = str_replace('"' , null , $path);

 				$a = new HardLink($path , $tag);
			
 				 if($a->checkType())
 				 {	

 				 	if($a->checkPathAndBool()) {
						$mime = $a->_mime_content_type($path);
						$filesize = filesize($path). 'bytes';

 				 		if($a->createHardLink()) { //True


 				 				$db =$this->Obj->createTag($a->path , $a->tag , $mime , $filesize , $a->token);
 				 				if($db){
 				 			
 				 				header('Location:/?success');
 				 				} 
 				 				else {
 				 				header('Location:/?fail');
 				 				}
 				 				
 				 				// $this->view('index' , compact("check")); 				 			
 				 		   }

 				 		else {
 				 			echo "False.. Not Create Tag.";
 				 		}

					}

					else {

						$paths =  $a->findHardLinkPath();

 						$this->view("index", compact($paths));
					}

 				 }
 				 else {
 				 		
 					
						$_SESSION['wpath'] = 1;
 						header("Location:/");
 						

 				}		
			}


}