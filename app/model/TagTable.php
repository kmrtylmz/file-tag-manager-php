<?php 
namespace App\model;

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