<?
/****************************************************************
*                           set_cookie_params.php								*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

if ( !defined('ARM_IN') )
die("Hacking attempt");
$session_id = session_id();
if (isset($_COOKIE[$session_id]['agent']))
	$_COOKIE['agent'] = $_COOKIE[$session_id]['agent'];
if (isset($_COOKIE[$session_id]['resource']))
	$_COOKIE['resource'] = $_COOKIE[$session_id]['resource'];
?>