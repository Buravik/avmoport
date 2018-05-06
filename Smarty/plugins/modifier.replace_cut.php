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
 * Name:     replace_cut<br>
 * Purpose:  simple search/replace
 * @link http://smarty.php.net/manual/en/language.modifier.replace_cut.php
 * @param string
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_replace_cut($string,$searchtext)
{

	$Len = strlen($string);
	$position = strpos(strtolower($string),strtolower($searchtext));

	if ($position > 130)
	{
		$StartPos = $position-130;
	}
	else
	{
		$StartPos = 0;
	}
	$MyString = substr($string,$StartPos,255);
	return preg_replace("~($searchtext)~iUs", '<font color="red"><b>$1</b></font>', $MyString);
}

/* vim: set expandtab: */

?>
