<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty crypt modifier plugin
 *
 * Type:     modifier<br>
 * Name:     crypt<br>
 * Author:   Botirjon G Olimov
 * Purpose:  crypt number
 * @param number
 * @return number
 */
/*function smarty_modifier_crypt($data)
{
	for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
		$c = 255 & ($key ^ ($c << 1));
		$table[$key] = $c;
		$key = 255 & ($key + 1);
	}
	$len = strlen($data);
	for($i = 0; $i < $len; $i++){
		$data[$i] = chr($table[ord($data[$i])]);
	}
	return base64_encode($data);
}*/

function smarty_modifier_crypt($data)
{
	if (is_numeric($data)) settype($data, "string");
	
	for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
		$c = 255 & ($key ^ ($c << 1));
		$table[$key] = $c;
		$key = 255 & ($key + 1);
	}
	$len = strlen($data);
	for($i = 0; $i < $len; $i++){
		$data[$i] = chr($table[ord($data[$i])]);
	}
	
	$data = base64_encode($data); 
	
	$data = str_replace('+', 'pp', $data);
	$data = str_replace('=', 'tt', $data);
	$data = str_replace('/', 'ss', $data);
	
	return $data;
}

?> 