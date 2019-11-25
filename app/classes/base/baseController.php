<?php 
namespace Abs\base;
use Abs\interfaces\IController;


class baseController implements IController 
{ 

	public function view($fileName , $arg){

		ob_start();

		require_once __DIR__."/../../views/". $fileName . ".php";

		ob_end_flush();
		clearstatcache();
		
		exit;
	

	}

	public function model($modelobj, ...$arg) {

			$class = new \ReflectionClass('App\\model\\'.$modelobj);
			$instance = $class->newInstanceArgs($arg);
			return  $instance;
	}

}