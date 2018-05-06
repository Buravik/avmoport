<?
/****************************************************************
*                            	 check.php			 									*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/


if ( !defined('ARM_IN') )
die("Hacking attempt");


session_start();
if (array_key_exists('login', $_SESSION) and $_SESSION['login'] != "")
{
	$user_data = session_pagestart();
}
else {
	$user_data = 0;
	session_end();
}
?>