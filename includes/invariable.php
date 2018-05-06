<?
/****************************************************************
*                            	 invariable.php			 							*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

if ( !defined('ARM_IN') )
die("Hacking attempt");


if (isset($_COOKIE['design_id']))
{
	$DesignId = $_COOKIE['design_id'];
	$SkinId = $lang['DESIGN'.$DesignId];
}
else
{
	$DesignId = 1;
	$SkinId = $lang['DESIGN'.$DesignId];
	set_cookie('design_id',$DesignId);
}
$smarty->assign(array('SkinId'=>$SkinId));
$smarty->assign(array(
"TITLE"					=>	$smarty->assign('title', GetEmpName()."&nbsp;&nbsp;".$lang['MONTH'.date("n")]."&nbsp;".$lang['MONTH']."&nbsp;"),
));

?>