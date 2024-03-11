<?php

namespace Chat\DI;

use DateTime;

class Log
{
	public static function GerarLog(int $level, $dataHora, $msg, $ip)
	{			
		$levels = array(
			'INFO',
			'WARNING',
			'ERROR'
		);

		$arquivo = LOG.'log.txt';

		$string = "\n${dataHora} [{$levels[$level]}]: {$msg} - {$ip}";

		return file_put_contents($arquivo, $string, FILE_APPEND);
	}
}

