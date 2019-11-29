<?php
namespace Abs\interfaces;

/**
 * Interface IController
 * @package Abs\interfaces
 */
interface IController {
    
    /**
     * @param string $fileName
     * @param array $arg
     *
     * @return mixed
     */
	public function view($fileName , $arg);
    
    /**
     * @param $modelObj
     * @param mixed ...$arg
     *
     * @return mixed
     */
	public function model($modelObj, ...$arg);
}