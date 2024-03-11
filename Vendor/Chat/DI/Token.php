<?php

namespace Chat\DI;

class Token
{
	public static function token($len = 5)
	{
		$upper = implode('', range('A', 'Z')); // ABCDEFGHIJKLMNOPQRSTUVWXYZ
		$nums = implode('', range(0, 9)); // 0123456789

		$alphaNumeric = uniqid().$upper.$nums; // ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789
		$string = '';
		for($i = 0; $i < $len; $i++) {
		    $string .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
		}

		return $string;
	}
}

