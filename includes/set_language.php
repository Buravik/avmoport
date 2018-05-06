<?
/****************************************************************
*                           set_language.php		 								*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/
if ( !defined('ARM_IN') )
	die("Hacking attempt");

if (!isset($_COOKIE['MY_LANGUAGE']))
	setcookie("MY_LANGUAGE", '1', time()+COOKIE_EXPIRE_TIME, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE);

if (@$_COOKIE['MY_LANGUAGE'] == '1')
	$slang = '1';
else if (@$_COOKIE['MY_LANGUAGE'] == '2')
	$slang = '2';
else if (@$_COOKIE['MY_LANGUAGE'] == '3')
	$slang = '3';
else
	$slang = '3';
?>