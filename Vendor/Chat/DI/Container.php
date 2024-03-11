<?php

namespace Chat\DI;
use PDO;
class Container
{
	public static function conn($name, $dbname)
	{
		$padrao=array(
						"host" => "192.168.1.16",
						"user" => "sithtech",
						"pass" => "CrusaderDB1@",
						"dbname" => $dbname,
						"options" => array(
											PDO::MYSQL_ATTR_LOCAL_INFILE => true,
											PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
											PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
										)
					);

		$str_class = "\\App\\Models\\".ucfirst($name);
		
		$camelCase = ucfirst($str_class);
		
		$class = new $camelCase(\App\Models\Conexao::getInstancia($padrao)); // Aqui que chama a conexão

		return $class;
	}
}