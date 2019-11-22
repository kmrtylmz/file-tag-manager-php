<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<title>Training</title>
	   <link rel = "icon" href =  
"https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" 
        type = "image/x-icon"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<style>
	body {
		background-color: #2C3A49;
		
	}
	.custom-file-input ~ .custom-file-label::after {
    content: "Select File";
	}
	.custom-file-label , input[file="text"] {
		border-radius: 0!important;
	}
	table {
		position: relative;
	}
	table tbody {
	  border-bottom: 75px solid white;
	}
	.form-control:focus , .form-control:hover {
			border-color:initial;
			outline: 0;
			box-shadow: initial;
	}

	tr:nth-child(even) , th {
		background-color: #F9F9F9;
		color:grey;
	}
	td:nth-child(2) {
		font-style: italic;
	}
	tbody::after{
			position: absolute;
			right:25px;
			bottom: -15px;
			font-weight: bolder;
			content: "Total Count : <? echo $a=1; ?>";
	}

</style>
<body>
	<div class="container-fluid ">
	<div class="row">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mt-4"  method="POST">
				 <div class="form-row pl-3">
					<div class="custom-file col-9 ">

							      <div class="input-group">
							        <div class="input-group-prepend">
							          <span class="input-group-text">/</span>
							        </div>
							        <input type="text" class="form-control" id="path" name="path" placeholder="Paste File Path" required>
					
							      </div>
			<!-- 		  <input type="file" class="custom-file-input bg-info " id="customFile" >
					  <label class="custom-file-label" for="customFile">File Name..</label> -->
					</div>
					<div class="col-2">
						    <input type="text" name="tag" class="form-control" id="tag" placeholder="#tag" required>
					</div>

		<div class="col-1 ">
	
				<button type="submit"  class=" pl-5 pr-5 btn btn-danger">Ready</button>
			</div>	
				</div>	
		</form>
		</div>



		<div class="row">
			<div class="col">
				<div class="progress mt-4">
				  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
				  </div>
				</div>
			</div>
		</div>
		
		<div class="row justify-content-start mt-5">
			<div class="col-4 input-group input-group-sm mt-5">
			   <input type="text" class="form-control" placeholder="Enter #tag " name="search" id="search" aria-label="Enter Tag Name" aria-describedby="basic-addon2" x-webkit-speech>
			  <div class="input-group-append">
			    <button class="btn btn-danger " type="button"><i class="fas fa-search"></i></button>
			  </div>
			</div>
		</div>

		

<div class="row  p-3">
	<div class="table-responsive-xl">
	<table class="table  table-light mt-3 table-sm">
  <thead>
    <tr>
      <th scope="col-1">Open </th>
      <th scope="col-7">File Path</th>
      <th scope="col-2">Type</th>
      <th scope="col-1">Size</th>
      <th scope="col-1">Delete</th>
    </tr>
  </thead>
  <tbody>
 
  
 	<?php 

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
 							$tag , 
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


 	}
 		if($_POST) {

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

		

 			//shell_exec("ln" .$path. "{$_ENV['HOMEDRIVE']}\keywords\\".$keyword);



 			/* readlink -f "abc.txt"
				/c/abc.txt

				ls -i /c/abc.txt
				24488322973942798 /c/abc.txt


				find ./ -inum 2533274790487458 | head -n2
				./abc.txt
				./bb/mert.txt
				}
*/
 		}

 	//print_r($_ENV);?>
 
 <tr>
 	<td><img src="images/filem.ico" alt=""></td>
 	<td>C:\xampp\htdocs\phpdesktop-chrome-57.0-rc-php-7.1.3C:\xampp\htdocs\phpdesktop-chrome-57.0-rc-php-7.1.3</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="images/delete.ico" alt=""></td>
 </tr>
 <tr>
 	<td><img src="images/filem.ico" alt=""></td>
 	<td>C:\xampp\htdocs\phpdesktop-chrome-57.0-rc-php-7.1.3</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="images/delete.ico" alt=""></td>

 </tr>
  <tr>
 	<td><img src="images/filem.ico" alt=""></td>
 	<td>C:\Riot Games\Riot Client\RiotClientServices.exe</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="images/delete.ico" alt=""></td>

 </tr>

  </tbody>
</table>
</div>
</div>

<div class="fixed-bottom text-right p-1 bg-light">
	Copyright @ <?=date('Y') ?>
</div>

</div>

</body>
</html>



        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script>

			$("input[type='text']").on("change" , function(e){
				$(".progress-bar").width("50%");               
			});
	
 			
	
      
        </script>	







