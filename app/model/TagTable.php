<?php 
namespace App\model;

	class TagTable extends Sqlitev3 { 

 			public function __construct(...$arg){
 					parent::__construct();
 			}

 			public function createTag($path , $tag , $filetype , $filesize , $encoded) { 

 						try {
 							
 					
 						$this->db->beginTransaction();
 				
 					    $rq = $this->db->prepare("INSERT INTO  taglist  (tag)  VALUES (:tag)");
 					    $rq->execute([ 'tag' => $tag ]);

						$id = $this->db->lastInsertId();

						// $stmt = $this->db->query("SELECT LAST_INSERT_ID()");
						// $id = $stmt->fetchColumn();
						 $qr = $this->db->prepare('INSERT INTO filelist (filename , filetype ,filesize , fileencoded, id) VALUES (:m,:e,:r,:t,:y)');

		 					$qr->execute([
		 							'm' => $path, 
		 							'e' => $filetype,
		 							'r' => $filesize,
		 							't' => $encoded,
		 							'y' => $id
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

 				  $qq =$this->db->prepare('SELECT * FROM filelist  INNER JOIN taglist  ON  filelist.id=taglist.id WHERE taglist.tag =:name');

 				  $qq->execute([
 				  			'name' => $tagName
 				  				]);
 				  $res  = $qq->fetchAll(\PDO::FETCH_ASSOC);

 				  return $res;
 			}



 	}