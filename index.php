<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__) . DS);
define('APP_PATH', ROOT);

function __autoload($classname) {
    $filename = "class/". $classname .".php";
    include_once($filename);
}

$error = new Errors();

//include_once APP_PATH . DS .'Class' . DS . 'pdo.php';
include_once APP_PATH . DS .'Controllers' . DS . 'AppController.php';
include_once APP_PATH . DS .'Class' . DS . 'password.php';

//print_r(get_required_files());

if (isset($_GET['url'])) {
	$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
	$url = explode("/", $url);
	$url = array_filter($url);

	$controller = array_shift($url);
	$action = array_shift($url);
	$args = $url;
}

if(!isset($controller)){
	$controller = "users";
}

if (!isset($action)) {
	$action = "index";
}

if(empty($args)){
	$args = array(0 => null);
}

if($action=="login" or $action=="index"){
	
}else{
	Authorization::logged();
}

$path =   APP_PATH."Controllers". DS .$controller."Controller.php";
$view =   APP_PATH."Views". DS .$controller. DS .$action.".php";
$header = APP_PATH."Views". DS ."layouts". DS ."default". DS ."header.php";
$footer = APP_PATH."Views".DS."layouts". DS ."default". DS. "footer.php";

if(file_exists($path)){
	include_once($path);
	$className = trim($controller, 's');
	$ob = new $className();
	if(isset($args)){
		$ob->$action($args[0]);
	}else{
		$ob->$action();	
	}
	
	if(file_exists($view)){
		include_once($header);
		include_once($view);
		include_once($footer);
	}else{
		echo "La vista para la acción $action no existe";
	}	
}else{
	echo "El controlador $controller no existe";
}