<?
/****************************************************************
*                           get_ajax_info.php		 								*
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
	case "structure":
		$query = "select t.menu_id,t.parent_id, t.name_e, t.name_r, t.name_u,procname,ord,target 
				  from bcms_menu t where menu_id = ".$_GET['menu_id'];
		break;

	case "forms":
		$query = "select t.menu_id,t.parent_id, t.name_e, t.name_r, t.name_u,tablename,ord,MenuId,BuildType,PicPath
				  from bcms_formtypes t where menu_id = ".$_GET['menu_id'];
		break;

	case "test_bank":
		$query = "select * from v_questions t where test_id = ".$_GET['test_id'];
		break;

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
		$ReturnRow .= "/".$val;
	}
	echo $ReturnRow;
	//echo iconv("cp1251", "UTF-8", $ReturnRow);
}
else
{
	echo 0;
}
?>