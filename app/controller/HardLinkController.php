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

			$files = $this->Obj->getSearch($tags["search"]);	
			$x = false;
				if(count($files)>0) {

					$filesArr = array_column($files, 'fileencoded');
					$filesOld = array_column($files, 'filename');
					$filesType = array_column($files, 'filetype');
					$filesSize = array_column($files, 'filesize');
					

					foreach ($filesArr as $key => $value) {						
					
					$path = $this->getFolder(). "\\".$value;
					$n_hard_link = str_replace('\\', '\\\\', $path);
					 $arr = [];
					// return hardlink's referance url
					 exec("fsutil hardlink list ". $n_hard_link , $arr);

					$matches = preg_grep('@^([^\$][0-9-a-zA-z-_\.]+)@' , $arr );

				
						$originalpath = array_map(function($value){ 
							$home = $this->homeDrive();
							 if(strncmp($this->folder , $value , strlen($this->folder)) !== 0) {
							 	 	return $home.$value;
								}
								return;
						},$matches);
						
						$originalpathArr[] = implode($originalpath);
						}

						
					foreach ($originalpathArr as $key => $newpath) {
						
						$filetype = mime_content_type($newpath);

					    $filesize = filesize($newpath). 'bytes';


					    if(!file_exists($filesOld[$key]) || $filesType[$key] !== $filetype || $filesSize[$key] !== $filesize)
					    {
					    		 $this->fileTableObj->updateHardLinkPath( $filetype , $filesize , $newpath, $filesArr[$key]);
								 $x=true;    				
						}
						else {
								continue;
						}

					}

					if($x){
						$newFiles = $this->Obj->getSearch($tags["search"]);
						echo json_encode($newFiles);
					}
					else{
						echo json_encode($files);
					}
				}

		
		}

		public function getMore($append) {
					
				$arr = json_decode($append['data'], true);

			
				echo json_encode($this->Obj->getAllTag($arr['start'],$arr['append']));

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

			 	$arr = $this->fileTableObj->getFileEncoded($f_id);
	
				 //	$try = new HardLink()	! düzeltilecek..
			 	$file = $this->getFolder() . "\\". $arr[0]['fileencoded'];

			 	unlink($file);

			 	$this->fileTableObj->deleteFile($f_id);

			 	echo "Tags altından ve Db den silindi..";
				
		}

		public function tagDelete($tag) {

				$arr = $this->fileTableObj->getFileEncodedTag($tag['data']); 
				
				if(count($arr) > 0) {
				for($i=0; $i < count($arr); $i++ ) {
					$file = $this->getFolder() . "\\". $arr[$i]['fileencoded'];
					unlink($file);
				}
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

 				 		if($this->Obj->createTag($a->path , $a->tag , $mime , $filesize , $a->token)) { //True

 				 				if($a->createHardLink()){
 				 				$_SESSION['completed'] = 1;
 				 				header('Location:/');
 				 				} 
 				 				else {
 				 				$_SESSION['filefail'] = 1;
 				 				header('Location:/');
 				 				} 								 			
 				 		   }
 				 		else {
 				 				$_SESSION['dbfail'] = 1;
 				 				header('Location:/');
 				 		}

					}
					else {

							$_SESSION['taggedError'] = 1;
							header('Location:/');
					}
 				 }
 				 else {
						$_SESSION['typefail'] = 1;
 						header("Location:/");
 				}		
			}


}