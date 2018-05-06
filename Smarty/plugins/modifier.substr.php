<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty strip modifier plugin
 *
 * Type:     modifier<br>
 * Name:     strip<br>
 * Purpose:  Replace all repeated spaces, newlines, tabs
 *           with a single space or supplied replacement string.<br>
 * Example:  {$var|strip} {$var|strip:"&nbsp;"}
 * Date:     September 25th, 2002
 * @link http://smarty.php.net/manual/en/language.modifier.strip.php
 *          strip (Smarty online manual)
 * @author   Monte Ohrt <monte@ispi.net>
 * @version  1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_substr($text)
{
    $MyTextLen = strlen(stristr($text,'Task'));
	$NeedLen = strlen($text)-$MyTextLen;
    return nl2br(substr($text,0,$NeedLen));
    //return $NeedLen;
}

/* vim: set expandtab: */

?>
