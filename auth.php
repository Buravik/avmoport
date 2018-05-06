<?
/****************************************************************
*                           		auth.php		 										*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

include_once("includes/error_reporting.php");
define('ARM_IN', true);

require_once("includes/constants.php");
require_once("includes/dbphpbb.php");
require_once("includes/set_language.php");
require_once("includes/functions.php");
require_once("includes/sessions.php");
if (isset($_POST['login']) and isset($_POST['password']))
{
	$error = Logon($_POST['login'], $_POST['password']);
	if (count($error) > 1)
	{
		session_start();
		setcookie('login', $_POST['login'], time()+30*24*60*60, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE);
		$user_data = session_begin($_POST['login'], md5($_POST['password']));
		$_SESSION['programid'] = PROGRAM_ID;
		$_SESSION['userid'] = $error['id'];
		$_SESSION['region_dep'] = $error['region_dep'];
		$_SESSION['distcity_dep'] = $error['distcity_dep'];
		
		
		$Roles = explode(",",$error['role_menu']);
		$Objects = explode(",",$error['role_object']);
		$RoleArr = array();
		foreach ($Roles as $rid => $rval)
		{
			$RoleArr[$rval] = 1;
		}
		
		$sql->query("SELECT id,keyword FROM bcms_s_accessobj");
		$Obj = $sql->fetchAll();
		foreach ($Obj as $id => $val)
		{
			$ObKeyArr[$val['id']] = $val['keyword'];
		}
		$ObjArr = array();
		foreach ($Objects as $oid => $oval)
		{
			$ObjArr[$ObKeyArr[$oval]] = 1;
		}
		
		ksort($RoleArr);
		ksort($ObjArr);
		
		$_SESSION['roles'] = $RoleArr;
		$_SESSION['objects'] = $ObjArr;
		
		session_write_close();
		header("Location: index.php?nocap");
	}
	else {
		header('Location: login.php?sysmess='.base64_encode($error));
	}
}
else exit;
?>