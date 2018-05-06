<?
define('ARM_IN', true);
include("includes/error_reporting.php");
include("includes/constants.php");
include("includes/DB.php");

$sql = new DB(HOST, USERNAME, PASSWORD, SYSTEM_BASE);
$sql->open();
$sql->query('SET NAMES cp1251;');
$phpSelf = explode("/",$_SERVER['PHP_SELF']);

$addPath = "/".$phpSelf[1]."/"	;
$PicAddPath = "/".$phpSelf[1]."/";

$_SESSION['AddPath'] = $addPath;
setcookie('AddPath',$addPath);

$_SESSION['PicAddPath'] = $PicAddPath;
setcookie('PicAddPath',$PicAddPath);

define("SMARTY_DIR",$_SERVER["DOCUMENT_ROOT"]."/Smarty/");

require(SMARTY_DIR."Smarty.class.php");
require_once("includes/set_language.php");
$slang = 1;
$sql->query('SELECT name'.$slang.' name, keyword from bcms_s_dictionary');
$Dictionary = $sql->fetchAll();

foreach ($Dictionary as $id => $value)
{
	$Dict[$value['keyword']] = $value['name'];
}
$smarty = new Smarty;
$smarty->assign(array(
'MESSAGE'	=>	(isset($_GET['sysmess'])) ? base64_decode($_GET['sysmess']) : "",
'MESSAGE_TYPE'	=>	3,
'Dict'				=> $Dict
));

$smarty->display("login.tpl");
?>