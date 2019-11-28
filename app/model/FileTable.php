<?php 
namespace App\Model;
/**
 * Class FileTable
 * @package App\Model
 */
 	class FileTable extends Sqlitev3 {
        /**
         * FileTable constructor.
         *
         * @param mixed ...$arg
         */
 				public function __construct(...$arg) {
 						parent::__construct();
 				}
       
        /**
         * @param int $id
         *
         * @return array
         */
 				public function getFileEncoded($id) {

 					$qq = $this->db->prepare('SELECT fileencoded FROM filelist WHERE f_id =:M');

 					$qq->execute(array(
 							'M' => $id
 					));

 					$res = $qq->fetchAll(\PDO::FETCH_ASSOC);
 					return $res;

 				}
       
        /**
         * @param string $tag
         *
         * @return array
         */
 				public function getFileEncodedTag($tag) {

 					
 					$qq =$this->db->prepare('SELECT filelist.fileencoded FROM filelist INNER JOIN taglist ON filelist.id=taglist.id  WHERE taglist.tag =:tag');
 					$qq->execute([ 'tag' => $tag ]);

 					$res  = $qq->fetchAll(\PDO::FETCH_ASSOC);

 					return $res;

 				}
       
        /**
         * @param int $id
         *
         * @return bool
         */
 				public function deleteFile($id)
 				{
 					$qq = $this->db->prepare('DELETE FROM filelist WHERE f_id =:Y');

 					$qq->execute(array(
 							'Y' => $id
 					));

 					return $qq->rowCount() > 0 ?  true :false;
 				}
       
        /**
         * @param string $filetype
         * @param string $filesize
         * @param string $filename
         * @param string $encoded
         *
         * @return bool
         */
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