<?
/****************************************************************
*                           		logout.php				 							*
*                          -------------------			  					*
*     begin                : 04.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

include_once("includes/error_reporting.php");
define('ARM_IN', true);

include_once("includes/sessions.php");

session_start();
session_end();

header("Location: login.php");
?>