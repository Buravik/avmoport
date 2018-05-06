<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier<br>
 * Name:     cat<br>
 * Date:     Feb 24, 2003
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * Example:  {$var|cat:"foo"}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte@ispi.net>
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_prices($price)
{
	$PriceArr = explode(",",$price);
	$RetVal = "";
	if ($PriceArr[0] != "")
	{
	$RetVal = (isset($PriceArr[0])) ? "<td bgcolor=d7d7d7 align=center class=PriceStyle>".$PriceArr[0]."$</td>" : "<td bgcolor=d7d7d7 align=center>&nbsp;</td>";
	$RetVal .= (isset($PriceArr[1])) ? "<td bgcolor=cfcdcd align=center class=PriceStyle>".$PriceArr[1]."$</td>" : "<td bgcolor=cfcdcd align=center>&nbsp;</td>";
	$RetVal .= (isset($PriceArr[2])) ? "<td bgcolor=bfbebe align=center class=PriceStyle>".$PriceArr[2]."$</td>" : "<td bgcolor=bfbebe align=center>&nbsp;</td>";
	}
	else
	{
	$RetVal = "<td bgcolor=e4e4e4 colspan=3></td>";
	}
	return $RetVal;
}

/* vim: set expandtab: */

?>
