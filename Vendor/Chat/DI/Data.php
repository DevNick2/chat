<?php

namespace Chat\DI;

use DateTime;

class Data
{
	public static function dateFormat($date)
	{			
		if(preg_match("/-/", $date))
		{
			$date = new DateTime($date);
		}

		if(preg_match("/\//", $date))
		{
			$date = new DateTime(str_replace("/", "-", $date));
		}


		return $date;
	}
}

