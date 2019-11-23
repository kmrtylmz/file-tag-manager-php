<?php
namespace App\controller;

use Abs\HardLink;
use Abs\base\baseController;

class HardLinkController extends baseController {

		public function __construct(...$arg) 
		{
				//
		}


		public function create($arr) {

				extract($arr);

				$path = "C:\Riot Games\Riot Client\RiotClientServices.exe";

				$tag = "lol";	

 				$a = new HardLink($path , $tag);

 				 if($a->checkType()->checkPathAndBool())
 				 {
 				 	$a->createHardLink();//True

 				 	//$db = new TagTable();

 				     echo $db->createTag($a->path , $a->tag) == true ? $db->kill() : false;


 				 }
 				 else {
 						$paths =  $a->findHardLinkPath();

 						$this->view("index", compact($paths));
 						
 				}
				
		}

}