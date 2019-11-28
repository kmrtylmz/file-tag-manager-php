<?php 
namespace App\model;
/**
 * Class TagTable
 * @package App\model
 */
	class TagTable extends Sqlitev3 {
        /**
         * TagTable constructor.
         *
         * @param mixed ...$arg
         */
 			public function __construct(...$arg){
 					parent::__construct();
 			}
        
        /**
         * @param string $path
         * @param string $tag
         * @param string $filetype
         * @param string $filesize
         * @param string $encoded
         *
         * @return bool
         */
 			public function createTag($path , $tag , $filetype , $filesize , $encoded) { 

 						try {
 						
 						$this->db->beginTransaction();
 						
 					    if ($db_id = $this->selectTagRowId($tag)) {
 					    	  	$id = $db_id; 
 					    }

 					    else {

 					     $rq = $this->db->prepare('INSERT INTO taglist (tag)  VALUES (:tag)');
 					    $rq->execute([ 'tag' => $tag ]);
 						$id = $this->db->lastInsertId();
						
						 }

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
 						 catch (\Exception $e) {
 							$this->db->rollBack();

 							return false;
 						}

 					
 			}
        
        /**
         * @param string $tag
         *
         * @return bool|rowId
         */
 			public function selectTagRowId($tag) {

 				$sql = "SELECT COUNT(*) as count , id FROM taglist WHERE tag =:tag";
				$qq  = $this->db->prepare($sql);
				$qq->execute(array('tag' => $tag));
				$res = $qq->fetch(\PDO::FETCH_ASSOC);
				$qq->closeCursor();

				return	$res['count'] == 1 ?   $res['id']  : false;
						
 			}
        
        /**
         * @param int $start
         * @param int $limit
         *
         * @return array
         */
 			public function getAllTag($start = 0 , $limit = 7) {

 				$qq = $this->db->prepare("SELECT tag FROM taglist ORDER BY id DESC LIMIT {$start}, {$limit}");
 				$qq->execute();
 				$res = $qq->fetchAll(\PDO::FETCH_ASSOC);

				return $res;

 			}
        
        /**
         * @param string $tagName
         *
         * @return array
         */
 			public function getSearch($tagName) { 

 				  $qq =$this->db->prepare('SELECT * FROM filelist  INNER JOIN taglist  ON  filelist.id=taglist.id WHERE taglist.tag =:name');

 				  $qq->execute([
 				  			'name' => $tagName
 				  				]);
 				  $res  = $qq->fetchAll(\PDO::FETCH_ASSOC);

 				  return $res;
 			}
        
        /**
         * @param string $tag
         *
         * @return bool
         */
 			public function deleteTag($tag){

 					$qq = $this->db->prepare('DELETE FROM filelist WHERE id IN (Select id FROM taglist WHERE tag =:tag)');
 					
 					$qq->execute([ 
 						'tag' => $tag 
 					]);

					$qr = $this->db->prepare('DELETE FROM taglist WHERE tag = :tag');
					$qr->execute([
						'tag' => $tag
					]);
 					

 					return $qq->rowCount() > 0 ? true : false;
 			}


 	}