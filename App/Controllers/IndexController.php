<?php
namespace App\Controllers;

use Chat\Controller\Action;
use Chat\DI\Container;
use DateTime;

class IndexController extends Action
{
	public function IndexAction()
	{
		$this->render('Index');
	}
}