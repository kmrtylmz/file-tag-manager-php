<?php 
namespace Abs\base;
use Abs\interfaces\IController;

/**
 * Class baseController
 * @package Abs\base
 */
class baseController implements IController 
{
    /**
     * @param string $fileName
     * @param array $arg
     *
     * @return mixed|void
     */
	public function view($fileName , $arg){

		ob_start();

		require_once __DIR__."/../../views/". $fileName . ".php";

		ob_end_flush();
		clearstatcache();
  
		exit;
	}
    
    /**
     * @param string $modelobj
     * @param mixed ...$arg
     *
     * @return object
     *
     * @throws \ReflectionException
     */
	public function model($modelobj, ...$arg) {

			$class = new \ReflectionClass('App\\model\\'.$modelobj);
			$instance = $class->newInstanceArgs($arg);
			return  $instance;
	}

}