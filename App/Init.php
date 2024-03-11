<?php
/*
*
*	Mark 2 v 1.0
*	Todos os direitos reservados a Sithtech
* 	
*	Arquivo de configuração inicial do sistema
*
*/ 

namespace App;

use Chat\Init\Bootstrap;

ini_set('display_errors', true);
ini_set('session.use_strict_mode', true);
error_reporting(E_ALL);

set_time_limit(0);
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

// Constantes de rotas
define('BASEURL', dirname(__FILE__));
define('PATH', '/Chat/');
define('BUNDLES', PATH .'App/Bundles/');
define('IMG', PATH .'App/Public/Imagens/');
define('LOG', BASEURL.'/Logs/');
define('NOMESISTEMA', 'Chat');

// Bundles
define('POLYFILL', BUNDLES . 'babelpolyfill.bundle.js');
define('COREJS', BUNDLES . 'core.bundle.js');
define('STYLE', BUNDLES. 'style.bundle.js');
define('CSS', BUNDLES . 'core.css');

class Init extends Bootstrap
{      

    protected function initRoutes()
    {          
        $ar['index'] = array('route'=>''.PATH.'','controller'=>'IndexController','action'=>'IndexAction');

        $this->setRoutes($ar);
    }
}
