<?
/****************************************************************
*                           		main.php				 								*
*                          -------------------			  					*
*     begin                : 04.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

header("If-Modified-Since: ".gmdate("D, d M Y H:i:s", time()-43200)." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s", time()+43200)." GMT"); // Дата протухания (через 12 часов)
header("Cache-Control: private");

define('ARM_IN', true);
include("includes/all_includes.php");

$smarty->assign(array(
'PageTitle'		=>$lang['MainPage'],
'PageIcon'	  =>"main.png",
'WelcomeMess'	=>$lang['WelcomeMess'],
));
$smarty->assign("base", $smarty->fetch("base.tpl"));
$smarty->assign("bottom", $smarty->fetch("bottom.tpl"));
$smarty->display("main.tpl");
?>