<?php
// require_once "View/Component/header.php";
// require_once "View/Component/headerWorkspace.php";

	require_once "rotas.php";
	spl_autoload_register(function($class){
		if(file_exists('Controller/' . $class . '.php'))
		{
			require_once 'Controller/' . $class . '.php';
		}
		else if(file_exists('Model/' . $class . '.class.php'))
		{
			require_once 'Model/' . $class . '.class.php';
		}
		else if(file_exists('Model/Composite/'. $class . '.class.php')) 
		{
			require_once 'Model/Composite/'. $class . '.class.php';
		}
		else if(file_exists('Model/DAO/'. $class . '.class.php')) 
		{
			require_once 'Model/DAO/'. $class . '.class.php';
		}
		else
		{
			die("Arquivo não existe " . $class);
		}
	});

	
	
	$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
	$uri = substr($uri, strpos($uri,'/',1));
	$route->verificar_rota($_SERVER["REQUEST_METHOD"],$uri);

?>