<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty filesize modifier plugin
 *
 * Type:     modifier<br>
 * Name:     filesize<br>
 * Date:     Mar 20, 2008
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * @author   Botirjon Olimov <batirdjan@gmail.com>
 * @version 1.0
 * @param string
 * @return string
 */
function smarty_modifier_filesize($file)
{
	return round(filesize('nodeimages/'.$file)/1024,1)." kb";
}

/* vim: set expandtab: */

?>
