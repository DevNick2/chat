<?php

namespace Chat\DI;

class Hash
{
	public static function hash($pass)
	{

		$lmin = 'abcdefghijklmnopqrstuvwxyz';
				
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				
		$num = '1234567890';
				
		$simb = '!@#$%*-';

		$caracteres = '';

		$caracteres .= $lmin;

		$caracteres .= $lmai;

		$caracteres .= $num;

		$caracteres .= $simb;

		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		$hash = hash('sha512', $pass);
		
		return $hash;

	}
}

