<?php
namespace Abs\interfaces;


interface IController {

	public function view($fileName , $arg);
	public function model($modelobj);
}