<?php 
namespace App\model;
use App\config;

 	class Sqlitev3 {

 		 	use config;

 			protected $db;

 			public function __construct(){
 				if($this->db == null) {
 				   $this->db = new \PDO("sqlite:".$this->sqlitePath);
 				   $this->db -> query("SET CHARACTER SET utf8");

				   }
 				return $this->db;
 				
 			}

 			public function __destruct() {
 				
 				$this->db = null;
 			}



 	}	