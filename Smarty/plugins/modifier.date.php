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
	$MonArr['01'] = "������";
	$MonArr['02'] = "�������";
	$MonArr['03'] = "�����";
	$MonArr['04'] = "������";
	$MonArr['05'] = "���";
	$MonArr['06'] = "����";
	$MonArr['07'] = "����";
	$MonArr['08'] = "�������";
	$MonArr['09'] = "��������";
	$MonArr['10'] = "��������";
	$MonArr['11'] = "������";
	$MonArr['12'] = "�������";
	
	$MyArray = explode("-",$string);
	
	return $MyArray[2]." ".$MonArr[$MyArray[1]]." ".$MyArray[0];
}

/* vim: set expandtab: */

?>
