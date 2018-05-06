<?
/****************************************************************
*                           		menu.php				 								*
*                          -------------------			  					*
*     begin                : 01.03.2010 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

header("If-Modified-Since: ".gmdate("D, d M Y H:i:s", time()-43200)." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s", time()+43200)." GMT"); // Дата протухания (через 12 часов)
header("Cache-Control: private");

define('ARM_IN', true);
include("includes/all_includes.php");

$query = "select r.role_menu as menu from bcms_admins a inner JOIN bcms_roles r on a.menu = r.id
where a.id = ".$_SESSION['userid'];
$sql->query($query);
$usermenu = $sql->fetchAssoc();


$query = "SELECT t.*, t.name1 as name
FROM bcms_menu t  where t.parent = 0
and t.id IN (".$usermenu['menu'].")
ORDER BY t.ord";

$sql->query($query);
$menu = $sql->fetchAll();
$menu_arr = array();

foreach ($menu as $value)
{

	$submenu = build_menu_array($menu, $value['id']);
	if (empty($submenu))
	{
		array_push($menu_arr, array('text'	=>	$value['name'], 'link'	=>	$value['url']."?mid=".MyPiCrypt($value['id']), 'target' => $value['target']));
	}
	else
	{
		if ($value['url'] == "")
		{
			array_push($menu_arr, array('text'	=>	$value['name'], 'link'	=>	'', 'submenu'	=>	$submenu));
		}
		else
		{
			array_push($menu_arr, array('text'	=>	$value['name'], 'link'	=>	$value['url']."?mid=".MyPiCrypt($value['id']), 'submenu'	=>	$submenu));
		}
	}
}

$menu_string = smarty_function_menu(array("data" => $menu_arr), $smarty);
$smarty->assign(array(
'valMenu' => $menu_string,
'SkinId'  => ""
));
$smarty->display("menu.tpl");
?>