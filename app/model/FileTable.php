<?php 
namespace App\Model;

 	class FileTable extends Sqlitev3 {
 					
 				public function __construct() {
 						parent::__construct();
 				}

 				public function getFileEncoded($id) {

 					$qq = $this->db->prepare('SELECT fileencoded FROM filelist WHERE f_id =:M');

 					$qq->execute(array(
 							'M' => $id
 					));

 					$res = $qq->fetchAll(\PDO::FETCH_ASSOC);
 					return $res;

 				}

 				public function getFileEncodedTag($tag) {

 					
 					$qq =$this->db->prepare('SELECT filelist.fileencoded FROM filelist INNER JOIN taglist ON filelist.id=taglist.id  WHERE taglist.tag =:tag');
 					$qq->execute([ 'tag' => $tag ]);

 					$res  = $qq->fetchAll(\PDO::FETCH_ASSOC);

 					return $res;

 				}

 				public function deleteFile($id)
 				{
 					$qq = $this->db->prepare('DELETE FROM filelist WHERE f_id =:Y');

 					$qq->execute(array(
 							'Y' => $id
 					));

 					return $qq->rowCount() > 0 ?  true :false;
 				}
 				

 				public function updateHardLinkPath($filetype , $filesize, $filename, $encoded){

 					$qq = $this->db->prepare('UPDATE filelist SET filetype =:filetype, filesize =:filesize , filename =:fileNewPath WHERE fileencoded =:fileencoded');
 					
 					$qq->execute([
 								'filetype' => $filetype,
 								'filesize' => $filesize,
 								'fileNewPath' => $filename,
 								'fileencoded' => $encoded
 								]);

 					return $qq->rowCount() > 0  ?  true : false;
 				}

 	}