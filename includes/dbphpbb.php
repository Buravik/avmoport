<?php
/****************************************************************
*                            	 dbphpbb.php  			 							*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/
 
require_once dirname(__FILE__) . '/DB.php';
$sql = new DB(HOST, USERNAME, PASSWORD, SYSTEM_BASE);
$sql->open();
?>