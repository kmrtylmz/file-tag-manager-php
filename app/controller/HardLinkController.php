<?php
namespace App\controller;

use Abs\HardLink;
use Abs\base\baseController;

class HardLinkController extends baseController {

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

			$arr = $this->Obj->getSearch($tags["search"]); // Request key);

			echo json_encode($arr);

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

 				 			$db =$this->Obj->createTag($a->path , $a->tag , $mime , $filesize);
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