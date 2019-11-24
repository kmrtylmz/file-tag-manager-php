<?php 
namespace Abs\base;
use Abs\interfaces\IController;


class baseController implements IController 
{ 

	public function view($fileName , $arg){

	
		// if(count($arg) > 1 ) {
		// 	extract($arg); // for string
		// }


		require_once __DIR__."/../../views/". $fileName . ".php";

		clearstatcache();
		exit;
	

	}

	public function model($modelobj, ...$arg) {

			$class = new \ReflectionClass('App\\model\\'.$modelobj);
			$instance = $class->newInstanceArgs($arg);
			return  $instance;
	}

}