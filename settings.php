<?
/****************************************************************
*                           		settings.php		 								*
*                          -------------------			  					*
*     begin                : 04.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

header("If-Modified-Since: ".gmdate("D, d M Y H:i:s", time()-43200)." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s", time()+43200)." GMT"); // ƒата протухани€ (через 12 часов)
header("Cache-Control: private");

define('ARM_IN', true);
include("includes/all_includes.php");

$smarty->assign(array(
'PageTitle'		=>$lang['SETTINGS'],
'PageIcon'		=>'settings.png',
));

if (isset($_POST['SubPasswd']))
{
	$UserId = $_SESSION['userid'];
	if ($_POST['oldpaswwd'] != "" and $_POST['newpaswwd'] != "" and $_POST['retpaswwd'] != "")
	{
		$query = "select id from bcms_admins where id = ".$UserId." and password = '".md5($_POST['oldpaswwd'])."'";
		$sql->query($query);
		$Resource = $sql->fetchAll();
		if ($sql->numRows() == 0)
		{
			$MessErr = "Ёски пароль нотугри!";
			$MessType = 3;
		}
		if ($_POST['newpaswwd'] != $_POST['retpaswwd'])
		{
			$MessErr = "янги ва текширув пароллари хар хил!";
			$MessType = 3;
		}
	}
	else
	{
		$MessErr = "’амма майдонларни тулдиринг!";
		$MessType = 3;
	}

	if (isset($MessErr))
	{
		$smarty->assign(array(
		'ErrMessage' => isset($MessErr) ? $MessErr : "",
		));
	}
	else
	{
		$query = "update bcms_admins set password = '".md5($_POST['newpaswwd'])."' where id = ".$UserId;
		$sql->query($query);

		$MessErr = "—изнинг паролингиз алмаштирилди!";
		$MessType = 1;
	}
	$smarty->assign(array(
	'MESSAGE' => isset($MessErr) ? $MessErr : $lang['LINE_ADD_SUCCESS'],
	'MESSAGE_TYPE' => isset($MessType) ? $MessType : 1,
	));
}

$smarty->assign("base", $smarty->fetch("base.tpl"));
$smarty->assign("bottom", $smarty->fetch("bottom.tpl"));
$smarty->display("settings.tpl");
?>