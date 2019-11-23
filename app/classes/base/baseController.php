<?php 
namespace Abs\base;
use Abs\interfaces\IController;


class baseController implements IController 
{ 

	public function view($fileName , $arg){

	

		extract($arg);

		require_once __DIR__."/../../views/". $fileName . ".php";

		clearstatcache();
		exit;
	

	}

	public function model($modelobj) {

			return new $modelobj();
	}

}