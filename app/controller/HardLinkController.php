<?php
namespace App\controller;

use Abs\HardLink;
use Abs\base\baseController;
use App\config;

class HardLinkController extends baseController {

	use config;

		private $Obj;

		public function __construct(...$arg) 
		{
				$this->Obj = $this->model('TagTable');
		}

		public function show () { 
			
				$arrTags = $this->Obj->getAllTag();
				$this->Obj->kill();

				$this->view('index' , $arrTags);
		}

		public function search($tags) {


			echo json_encode($this->Obj->getSearch($tags["search"]));
			$this->Obj->kill();

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

			 	$fileTableObj =	$this->model('FileTable');

			 	$arr = $fileTableObj->getFileEncoded($f_id);
			 	// $b = array("file" => "ceza" , "b" => "a");
			 	// print_r($b);
			// //	$try = new HardLink()	! düzeltilecek..
			 	$file = $this->getFolder() . "\\". $arr[0]['fileencoded'];

			 	unlink($file);

			 	$fileTableObj->deleteFile($f_id);
			 	$fileTableObj->kill();

			 	echo "Tags altından ve Db den silindi..";
				
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
 				 				$this->Obj->kill();
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
 						header("Location:/?wpath");
 				}		
			}


}