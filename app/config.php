<?php 
namespace App;


 	trait config  { 
 			
 				protected $sqlitePath = 'database/taglog.db';
 				protected $folder = "\\tags";

 				public function getFolder() {
 					return "{$_ENV['HOMEDRIVE']}\\tags";
 				}


 			}
