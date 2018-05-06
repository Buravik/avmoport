<?
/****************************************************************
*                           get_ajax_info1.php	 								*
*                          -------------------			  					*
*     begin                : 01.01.2010 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/
define('ARM_IN', true);
include("includes/all_includes.php");

switch ($_GET['case'])
{
	case "formbuilder":
		$query = "select * from ".$_GET['tid']." t where id = ".$_GET['rowid'];
		break;
}

$sql->query($query);
$Result = $sql->fetchAssoc();
if (count($Result) > 1)
{
	$ReturnRow = "1";
	foreach ($Result as $ind => $val)
	{
		$ReturnRow .= "<&sep&>".$val;
	}
	echo $ReturnRow;
	//echo iconv("cp1251", "UTF-8", $ReturnRow);
}
else
{
	echo 0;
}
?>