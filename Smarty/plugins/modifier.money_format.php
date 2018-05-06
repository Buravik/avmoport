<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty replace modifier plugin
 *
 * Type:     modifier<br>
 * Name:     replace<br>
 * Purpose:  simple search/replace
 * @link http://smarty.php.net/manual/en/language.modifier.replace.php
 *          replace (Smarty online manual)
 * @param string
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_money_format($amount)
{
	return number_format($amount, 0, ',', ' ');
}

/* vim: set expandtab: */

?>
