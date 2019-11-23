<?php 
require "vendor/autoload.php";

use App\Router;
//ob_start()

Router::run('/', "HardLinkController@create");

Router::run('/ad' , 'HardLinkController@create', 'post|get');


Router::run('/uye' , 'HardLinkController@create', 'post|get');



 	 		/*if($_POST) {

 				extract($_POST);
 				$a = new HardLink($path , $tag);

 				if($a->checkType()->checkPathAndBool())
 				{
 					$a->createHardLink();//True

 					$db = new TagTable();

 				    echo $db->createTag($a->path , $a->tag) == true ? $db->kill() : false;


 				}
 				else {
 						echo $a->findHardLinkPath();
 						
 				}
				clearstatcache();	
 			}
 			*/
/*
 	trait config  { 
 			
 				protected $sqlitePath = 'database/taglog.db';
 				protected $folder = "\\tags";

 				public function getFolder() {
 					return "{$_ENV['HOMEDRIVE']}\\tags";
 				}


 			}

 	class Sqlitev3 {

 		 	use config;

 			protected $db;

 			public function __construct(){
 				if($this->db == null) {
 				   $this->db = new PDO("sqlite:".$this->sqlitePath);
 				   $this->db -> query("SET CHARACTER SET utf8");

				   }
 				return $this->db;
 				
 			}



 	}		

 	class TagTable extends Sqlitev3 { 

 			public function __construct(){
 					parent::__construct();
 			}

 			public function createTag($path , $tag) { 
 					$qq = $this->db->prepare('INSERT INTO taglist (tag , filename) VALUES ( ? , ? )');

 					$qq->execute([
 							$tag, 
 							$path
 					]);


 					return $qq->rowCount() > 0 ?  true :false;
 			}

 			public function selectTag($tag) { 

 				$sql = "SELECT COUNT(*) FROM taglist WHERE tag = {$tag}";
						if ($rq = $this->db->query($sql)) {
						  if ($q->fetchColumn() > 0) {
						  		$qq = $this->db->prepare('SELECT * FROM taglist WHERE tag = :tag' );
				 					$qq->execute([
				 							'tag' => $tag
				 					]);

				 					$res = $qq->fetchAll(PDO::FETCH_ASSOC);

				 					return $res;
						  }
						  else{
						  			return false;
						  }
						}
 				
 					return true;
 			}

 			public function deleteTag($tag) { 
 					$qq = $this->db->prepare('DELETE FROM taglist WHERE tag = ?');

 					$qq->execute(array(
 							$tag , 
 							$path
 					));

 					return $qq->rowCount() > 0 ?  true :false;
 			}

 			public function kill() {
 					 $this->db = null;
 					 return true;
 			}

 	}

 	class HardLinkTable {
 		// Then Update..
 	}

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
 					$this->path = $path;
 					$this->tag = $tag;
 					$this->fileName = basename($path);
 					$this->hardLink = $this->hardlinkPath."\\".$this->fileName;
 					$this->n_hard_link = str_replace('\\','\\\\', $this->hardLink);
 					if(!is_dir($this->hardlinkPath))
 					{
				 	 mkdir($this->hardlinkPath , 0777);
					}

 				}


				function checkPathAndBool()  {
 					 
 					 return  !file_exists($this->n_hard_link) && file_exists($this->path) ?   true : false ; 

 				}

 				function checkType() {

 						if(is_file($this->path) || is_executable($this->path) || is_readable($this->path)) {

 								return $this;

 						}

 						else
 						{ 
 								return;
 						}
 				}

 				function createHardLink() {
 					return link($this->path , $this->n_hard_link);
 				}

 				function findHardLinkPath(){

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
 				
 				//	clearstatcache();


 	} */

 		

				/*if(is_file($path) || is_executable($path) || is_readable($path)) {



  				 $fileName = basename($path); // for different extension
  			
				 $hardLink = $dir."\\".$fileName;  // hardlink store

				 $n_hard_link =  replacePath($hardLink); // for Windows
				 
			     if(!file_exists($n_hard_link) && file_exists($path)){ 

  						link($path , $n_hard_link);
  						//lstat for inode return 0.
					
				}
				else {

					
					$arr=[];
							// return hardlink's referance url
						 exec("fsutil hardlink list ". $n_hard_link , $arr);

							$matches = preg_grep('@^([^\$][0-9-a-zA-z-_\.]+)@' , $arr );

								$folder = "\\tags";

								$originalpath = array_filter($matches , function($value) use ($folder){
								
									 if(strncmp($folder , $value , strlen($folder)) !== 0) {
									 		return $value; 
										}
										return;
								});
								
								$a = implode("" , $originalpath);
								echo $a;
								

							
						
					  	
					}
					
				
				
					}
				
				 */

		

 			//shell_exec("ln" .$path. "{$_ENV['HOMEDRIVE']}\keywords\\".$keyword); // hardlink olusturur.

 			/* readlink -f "abc.txt"  // olusan hardlinkin pathi alınır.
				/c/abc.txt

				ls -i /c/abc.txt       // pathine göre inode numarası listelenir.
				24488322973942798 /c/abc.txt  // gelen deger parse


				find ./ -inum 2533274790487458 | head -n2  // dosyalarda inode göre aranır.
				./abc.txt
				./bb/mert.txt
				}
*/
 		

 	//print_r($_ENV);?>
 






