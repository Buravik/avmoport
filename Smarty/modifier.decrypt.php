<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty decrypt modifier plugin
 *
 * Type:     modifier<br>
 * Name:     decrypt<br>
 * Author:   Botirjon G Olimov
 * Purpose:  decrypt number crypted by crypt plugin
 * @param number
 * @return number
 */
function smarty_modifier_decrypt($data)
{
	$data = base64_decode($data);
	for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
		$c = 255 & ($key ^ ($c << 1));
		$table[$c] = $key;
		$key = 255 & ($key + 1);
	}
	$len = strlen($data);
	for($i = 0; $i < $len; $i++){
		$data[$i] = chr($table[ord($data[$i])]);
	}
	return $data;
}

?> 