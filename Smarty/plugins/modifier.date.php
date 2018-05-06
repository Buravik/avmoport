<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     nl2br<br>
 * Date:     Feb 26, 2003
 * Purpose:  convert \r\n, \r or \n to <<br>>
 * Input:<br>
 *         - contents = contents to replace
 *         - preceed_test = if true, includes preceeding break tags
 *           in replacement
 * Example:  {$text|nl2br}
 * @link http://smarty.php.net/manual/en/language.modifier.nl2br.php
 *          nl2br (Smarty online manual)
 * @version  1.0
 * @author   Monte Ohrt <monte@ispi.net>
 * @param string
 * @return string
 */
function smarty_modifier_date($string)
{
	$MonArr['01'] = "€нвар€";
	$MonArr['02'] = "‘еврал€";
	$MonArr['03'] = "марта";
	$MonArr['04'] = "апрел€";
	$MonArr['05'] = "ма€";
	$MonArr['06'] = "июн€";
	$MonArr['07'] = "июл€";
	$MonArr['08'] = "августа";
	$MonArr['09'] = "сент€бр€";
	$MonArr['10'] = "октр€бр€";
	$MonArr['11'] = "но€бр€";
	$MonArr['12'] = "декабр€";
	
	$MyArray = explode("-",$string);
	
	return $MyArray[2]." ".$MonArr[$MyArray[1]]." ".$MyArray[0];
}

/* vim: set expandtab: */

?>
