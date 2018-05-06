<?php
/****************************************************************
*                           		index.php				 								*
*                          -------------------			  					*
*     begin                : 04.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/
define('ARM_IN', true);

include("includes/all_includes.php");

if (isset($_POST['SubDesign']))
{
	$design_id = MyPiDeCrypt($_POST['SkinId']);
	set_cookie('design_id',MyPiCrypt($design_id));
}
if (isset($_SESSION['agentid']))
{
	$AgentInfo = getUserAgent($_SESSION['agentid']);
	$smarty->assign(array('AgentInfo'=>$AgentInfo));
}

/*if (!isset($_COOKIE['agent']))
{
getLastResAgent();
}
elseif (!isset($_COOKIE['resource']))
{
getLastRes($_COOKIE['agent']);
}*/

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
$smarty->assign('title', PROGRAM_NAME." • ".OWNER." • ".GetEmpName()." • ".$lang['MONTH'.date("n")]."&nbsp;".$lang['MONTH']."&nbsp;");
$smarty->assign('EmpName', GetEmpName());
$smarty->display("index.tpl");
?>