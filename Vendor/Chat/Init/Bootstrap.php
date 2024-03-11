<?php

namespace Chat\Init;



abstract class Bootstrap  
{	
	private $routes;

	public function __construct()
	{
		$this->initRoutes();

		$this->run($this->getUrl());
	
	}

	abstract protected function initRoutes();

	protected function run($url)
	{			

		array_walk($this->routes, function($route) use($url)
		{			
		 	$path = $url['path'];
		 	$contadorBarras = substr_count($path, "/");
		 	
		 	if($contadorBarras > 3)
		 	{
			 	$pathAbsoluto = explode("/", $path);
			 	unset($pathAbsoluto[0]); // Removendo o elemento vazio 
			 			 	
			 	$i=1; // Contador das barras

		 		foreach($pathAbsoluto as $key => $value)
		 		{	
				 	if($i > 2) // Ou seja, maior que o permitido para as urls
				 	{
				 		$queryStrings[] = $pathAbsoluto[$i];

				 		unset($pathAbsoluto[$i]);
			 		}

			 		$i++;
			 	}
			 	
			 	$queryStrings[$queryStrings[0]] = explode("-", $queryStrings[1]); // Agpra tem chave => valor ou seja, variavel => valor

			 	for($i=0;$i<count($queryStrings);$i++)
			 		unset($queryStrings[$i]); // Removendo todos os indices que são inteiros

			 	$path = "/".implode("/", $pathAbsoluto); // Retornando o path da solicitação e usar no redirect
		 		
		 	}
		 	else
		 	{
		 		$queryStrings = false;
		 	}
		 	

				if($path == $route['route'])
		 		{
		 			
		 			if(in_array('query', array_keys($url)))
					{
						parse_str($url['query'], $arr);
					}
					else
					{
						$arr = false;	
					} 
		 			
		 			$class = "App\\Controllers\\".ucfirst($route['controller']);

		 			$controller = new $class($arr,$queryStrings);

			 			$action = $route['action'];
		 					 			
		 				$controller->$action();
				}
		 });
	}

	protected function setRoutes(array $routes)
	{
		$this->routes=$routes;
	}

	protected function getUrl()
	{
		$url = parse_url($_SERVER["REQUEST_URI"]);
		
		return $url;
	}
}