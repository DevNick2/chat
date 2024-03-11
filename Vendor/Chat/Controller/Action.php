<?php

namespace Chat\Controller;

class Action
{
	protected $view;
	protected $action;
			
	public function __construct()
	{
		$this->view = new \stdClass;
	}

	public function render($action, $header=true, $footer=true)
	{
		$this->action = $action;
		
		if($header === true && $footer === true && file_exists("Vendor/Chat/AddOns/Header.phtml") && file_exists("Vendor/Chat/AddOns/Footer.phtml"))
		{			

			include_once "Vendor/Chat/AddOns/Header.phtml";

			$this->content();
	
			include_once "Vendor/Chat/AddOns/Footer.phtml";
		}
		else
		{
			$this->content();
		}		
		
	}

	public function content()
	{
		$atual = get_class($this);
		$singleClassName = str_replace("App\\Controllers", "", $atual);
		$removeController = str_replace("Controller", "", $singleClassName);
		$removeBarra = str_replace("\\", "/", $removeController);

		$camelCase = ucfirst($this->action);
		
		$url = 'App/Views'.$removeBarra.'/'.$camelCase.'.phtml';

		if(!file_exists($url))
		{
			include_once 'App/Views/Erros/404.phtml';		
		}
		else
		{
			include_once $url;		
		}
	}
}