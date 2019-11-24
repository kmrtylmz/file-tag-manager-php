<?php 
namespace App\model;

	class TagTable extends Sqlitev3 { 

 			public function __construct(...$arg){
 					parent::__construct();
 			}

 			public function createTag($path , $tag , $filetype , $filesize) { 

 						try {
 							
 					
 						$this->db->beginTransaction();
 				
 					    $rq = $this->db->prepare("INSERT INTO  taglist  (tag)  VALUES (:tag)");
 					    $rq->execute([ 'tag' => $tag ]);

						$id = $this->db->lastInsertId();

						// $stmt = $this->db->query("SELECT LAST_INSERT_ID()");
						// $id = $stmt->fetchColumn();
						 $qr = $this->db->prepare('INSERT INTO filelist (filename , filetype ,filesize , id) VALUES (:p,:f,:ft,:i)');

		 					$qr->execute([
		 							':p' => $path, 
		 							':f' => $filetype,
		 							'ft' => $filesize,
		 							'i' => $id
		 					]);

		 				$this->db->commit();

		 					return true;
						}
 						 catch (Exception $e) {
 							$this->db->rollBack();

 							return false;
 						}
 					

 					

 					
 			}

 			public function selectTag($tag) { 

 				$sql = "SELECT COUNT(*) FROM taglist WHERE tag = {$tag}";
						if ($rq = $this->db->query($sql)) {
						  if ($rq->fetchColumn() > 0) {
						  		$qq = $this->db->prepare('SELECT * FROM taglist WHERE tag = :tag' );
				 					$qq->execute([
				 							'tag' => $tag
				 					]);

				 					$res = $qq->fetchAll(\PDO::FETCH_ASSOC);

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


 			public function getAllTag() {

 				$qq = $this->db->prepare("SELECT tag FROM taglist LIMIT 20");
 				$qq->execute();
 				$res = $qq->fetchAll(\PDO::FETCH_ASSOC);

				return $res;

 			}

 			public function getSearch($tagName) { 

 				  $qq =$this->db->prepare('SELECT filename FROM taglist WHERE tag = ? ');

 				  $qq->execute([
 				  			$tagName
 				  				]);
 				  $res  = $qq->fetchAll(\PDO::FETCH_ASSOC);

 				  return $res;
 			}

 	}