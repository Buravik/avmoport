<?
if (!defined('ARM_IN'))
{
	die("Hacking attempt");
}

require_once dirname(__FILE__) . '/error_reporting.php';
require_once dirname(__FILE__) . '/constants.php';
require_once dirname(__FILE__) . '/DB.php';
$sql = new DB(HOST, USERNAME, PASSWORD, SYSTEM_BASE);
$sql->open();
$sql->query('SET NAMES cp1251;');
require_once("sessions.php");
require_once("check.php");
require_once("set_cookie_params.php");

if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') == FALSE)
{
	$user_data = 0;
}
   
if ($user_data == 0)
{
	print "<script> if (window.parent.parent) win=window.parent.parent; else win=window.parent; win.location.href='login.php'; </script>";
	exit;
}

if (!isset($_COOKIE['AddPath']) and $_COOKIE['AddPath'] == "")
{
	$phpSelf = explode("/",$_SERVER['PHP_SELF']);

	$addPath = "/".$phpSelf[1]."/";
	$PicAddPath = "/".$phpSelf[1]."/";

	$_SESSION['AddPath'] = $addPath;
	setcookie('AddPath',$addPath);

	$_SESSION['PicAddPath'] = $PicAddPath;
	setcookie('PicAddPath',$PicAddPath);
}
else
{
	$addPath = $_COOKIE['AddPath'];
	$PicAddPath = $_COOKIE['PicAddPath'];
}
define("SMARTY_DIR",$_SERVER["DOCUMENT_ROOT"]."/Smarty/");
require(SMARTY_DIR."Smarty.class.php");
$smarty = new Smarty;

require_once("set_language.php");
require_once("language/lang_".$slang.".php");
//$slang = 2;
require_once("functions.php");

if (isset($_GET['mid']))
{
	$MenuId = MyPiDeCrypt($_GET['mid']);
	
	if (!isset($_SESSION['roles'][$MenuId]))
	{
		print "<script> if (window.parent.parent) win=window.parent.parent; else win=window.parent; win.location.href='main.php'; </script>";
		exit;
	}
}

$smarty->assign(array('Lang'=>$lang));

$error = Logon($user_data['login'], $user_data['password']);

include_once("invariable.php");



if (count($error) > 1)
{
	session_end();
	echo '<script>window.alert("'.str_replace("\n", " ", addslashes(GetOraError($sql->getError()))).'"); window.parent.location.href="login.php";</script>';
	exit;
}



?>