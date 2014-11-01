<?php 
abstract class AppController{
	
	abstract public function index();

	public function __construct(){
		$nameController = get_class($this);
		$this->$nameController = new ClassPDO();
	}

	protected function set($name = null, $value = array()){
		$GLOBALS[$name] = $value;
	}

	protected function redirect($url = array()){
		$path = "";
		if($url["controller"]){
			$path .= $url["controller"];
		}
		if($url["action"]){
			$path .= "/".$url["action"];
		}
		header("LOCATION: http://localhost/app/".$path);
	}
}