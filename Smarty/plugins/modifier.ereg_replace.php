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
 * Name:     ereg_replace<br>
 * Purpose:  simple search/replace
 * @link http://smarty.php.net/manual/en/language.modifier.ereg_replace.php
 *          replace (Smarty online manual)
 * @param string
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_ereg_replace($string, $search, $replace)
{
    return ereg_replace($search,$replace,$string);
}

/* vim: set expandtab: */

?>
