<?
/****************************************************************
*                            	 functions.php			 							*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

if ( !defined('ARM_IN') )
die("Hacking attempt");

#function1
function MyPiCrypt ($data)
{
	for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
		$c = 255 & ($key ^ ($c << 1));
		$table[$key] = $c;
		$key = 255 & ($key + 1);
	}
	$len = strlen($data);
	for($i = 0; $i < $len; $i++){
		$data[$i] = chr($table[ord($data[$i])]);
	}

	$data = base64_encode($data);
	$data = str_replace('+', 'pp', $data);
	$data = str_replace('=', 'tt', $data);
	$data = str_replace('/', 'ss', $data);

	return $data;
}

function MyPiDeCrypt ($data)
{
	$data = str_replace('pp', '+', $data);
	$data = str_replace('tt', '=', $data);
	$data = str_replace('ss', '/', $data);
	$data = base64_decode($data);

	for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
		$c = 255 & ($key ^ ($c << 1));
		$table[$c] = $key;
		$key = 255 & ($key + 1);
	}
	$len = strlen($data);
	for($i = 0; $i < $len; $i++){
		$data[$i] = chr($table[ord($data[$i])]);
	}
	return $data;
}

function Logon($login, $password)
{
	global $sql;
	$query = "SELECT a.*, r.`role_menu`, r.`role_object` FROM bcms_admins a
					LEFT JOIN bcms_roles r ON r.`id` = a.`menu`
					where a.username = '".$login."' and a.password = '".md5($password)."'";
	$sql->query($query);
	$userdata = $sql->fetchAssoc();
	if ($userdata['id'] != "")
	{
		return $userdata;
	}
	else
	{
		return "Логин или пароль не правилно!";
	}
}

function GetEmpName()
{
	global $sql;
	$query = "SELECT name FROM bcms_admins where id = ".$_SESSION['userid'];
	$sql->query($query);
	$userdata = $sql->fetchAssoc();
	return $userdata['name'];
}

function drop_cookie($name)
{
	$session_id = session_id();
	if (is_array($name))
	{
		foreach ($name as $key => $val)
		{
			setcookie($key, '', time()-COOKIE_EXPIRE_TIME, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE);
		}
	}
	else
	setcookie($session_id."[".$name."]", '', time()-COOKIE_EXPIRE_TIME, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE);
}

function set_cookie($name, $value = null)
{
	$session_id = session_id();
	if (is_array($name))
	{
		foreach ($name as $key => $val)
		{
			setcookie($session_id."[".$key."]", $val, time()+COOKIE_EXPIRE_TIME, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE);
		}
	}
	else
	{
		setcookie($session_id."[".$name."]", $value, time()+COOKIE_EXPIRE_TIME, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE);
	}
}

function discard_cookies()
{
	drop_cookie($_COOKIE);
	foreach ($_COOKIE as $key => $value)
	{
		drop_cookie($key);
	}
}
function smarty_function_menu_render_element($element,$level)
{
	global $key;
	$_output = '';
	$key++;
	//$element['target'] = 'mainframe';
	if(isset($element['link']) and  !empty($element['link']))
	$_text = "<a href=\"" . htmlspecialchars($element['link']) . "\" target='".$element['target']."' title='".htmlspecialchars($element['text'])."'>" . $element['text'] . "</a>";
	else
	$_text = '<span class="nolink">' . $element['text']. '</span>';

	if(isset($element['submenu']))
	{
		if (isset($_COOKIE['img_'.$key]) and !empty($_COOKIE['img_'.$key]))
		{
			$display = 'inline';
			$img = 'images/minus.gif';
		}
		else
		{
			$display = 'none';
			$img = 'images/plus.gif';
		}

		$_output .= "<tr><td height=18><img src='$img' width='13' height='13' id='img_$key' style='cursor:hand;' onclick='Display(this)' border=0></td><td nowrap>&nbsp;<B><span onclick='Display(document.getElementById(\"img_$key\"))' style='cursor:hand;'>" . $_text . "</span></B></td></tr>\n";
		$_output .= "<tr><td></td><td><table id='table_$key' border=0 cellpadding=0 cellspacing=1 align=left style='display:$display;'>\n";

		foreach($element['submenu'] as $_submenu) {
			$_output .=  smarty_function_menu_render_element($_submenu, $level + 1);
		}

		$_output .= "</table></td></tr>\n";
	}
	else
	$_output .= "<tr><td width=0></td><td nowrap>&nbsp;" . $_text . "</td></tr>\n";

	return $_output;
}

function smarty_function_menu($params, $smarty = null)
{
	if(empty($params['data'])) {
		$smarty->trigger_error("menu_init: missing 'data' parameter");
		return false;
	}

	$_id = isset($params['id']) ? $params['id'] : 'nav';
	$_output = "<table id=\"$_id\" cellpadding=0 cellspacing=1>\n";

	foreach($params['data'] as $_element)
	{
		$_output .= smarty_function_menu_render_element($_element, 1);
	}

	$_output .= "</table>\n";

	return $_output;
}
function build_menu_array($source, $parent_id)
{
	global $sql;
	$child_menu = array();

	$query = "select r.role_menu as menu from bcms_admins a inner JOIN bcms_roles r on a.menu = r.id
where a.id = ".$_SESSION['userid'];
	$sql->query($query);
	$usermenu = $sql->fetchAssoc();

$query = "SELECT t.*, t.name1 as name
FROM bcms_menu t
where t.parent = ".$parent_id."
and t.id IN (".$usermenu['menu'].")
ORDER BY t.ord";			

	$sql->query($query);
	if ($sql->numRows() > 0)
	{
		$source = $sql->fetchAll();
		foreach ($source as $value)
		{
			if ($value['parent'] == $parent_id)
			{
				$submenu = build_menu_array($source, $value['id']);
				$AddLink = (strpos($value['url'],'?')>0) ? "&" : "?";
				if (empty($submenu))
				{
					array_push($child_menu, array('text'	=>	$value['name'], 'link'	=>	$value['url'].$AddLink."mid=".MyPiCrypt($value['id']), 'target' => $value['target']));
				}
				else
				{
					array_push($child_menu, array('text'	=>	$value['name'], 'link'	=>	$value['url'].$AddLink."mid=".MyPiCrypt($value['id']), 'submenu'	=>	$submenu));
				}
			}
		}
	}
	return $child_menu;
}
function GetSubjectNameListAll()
{
	global $sql;
	$MyNewArr = '';

	$query = "SELECT * FROM bcms_menu where parent_id = 0 order by parent_id,ord";
	$sql->query($query);
	$SubjMRows = $sql->fetchAll();
	foreach ($SubjMRows as $SubjInd => $SubjVal)
	{
		$query = "SELECT * FROM bcms_menu where parent_id = ".$SubjVal['menu_id']." ORDER by parent_id";
		$sql->query($query);
		$SubjRows = $sql->fetchAll();
		if (count($SubjRows)>0)
		{
			$MyNewArr[] = $SubjVal;
			foreach ($SubjRows as $SubjInd1 => $SubjVal1)
			{
				$MyNewArr[] = $SubjVal1;
				$MyChildArr = GetSubjectChildsNamesList($SubjVal1['menu_id']);
				if (is_array($MyChildArr))
				if (count($MyChildArr) > 0)
				{
					foreach ($MyChildArr as $SubjInd2 => $SubjVal1Child)
					{
						$MyNewArr[] = $SubjVal1Child;
					}
				}
			}
		}
		else
		{
			$MyNewArr[] = $SubjVal;
		}
	}
	return $MyNewArr;
}
function GetSubjectChildsNamesList($subjId)
{
	global $sql;

	$res = '';

	$query = "SELECT * FROM bcms_menu where parent_id = ".$subjId." ORDER by parent_id";

	$sql->query($query);
	$SubjRows = $sql->fetchAll();
	if (count($SubjRows)>0)
	{
		$res = array();
		foreach ($SubjRows as $SubjInd1 => $SubjVal1)
		{
			$res[] = $SubjVal1;
			$MyChildArr = GetSubjectChildsNamesList($SubjVal1['menu_id']);
			if (is_array($MyChildArr))
			if (count($MyChildArr) > 0)
			{
				foreach ($MyChildArr as $SubjInd2 => $SubjVal1Child)
				{
					$res[] = $SubjVal1Child;
				}
			}
		}
	}

	return $res;
}

function GetSubjectNameList($subjId, $fieldName)
{
	global $sql;
	$res = '';
	if ($subjId != 0) {
		$query = 'select parent_id, '.$fieldName.' name from bcms_menu where parent_id = '.$subjId;
		$sql->parse($query);
		$row = $sql->fetchAssoc();
		$res = GetSubjectNameList($row['parent_id'], $fieldName);
		$res .= "<td width=2><img src=images/topbox_left.gif></td><td bgcolor='5088A7' style='PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px'><a href=\"index.php?act=setAction&subj_id=" . MyPiCrypt($subjId) . "\" target='mainframe'class='white'  title='".htmlspecialchars($row['name'])."'>" . htmlspecialchars($row['name']) . "</a></td><td width=2><img src=images/topbox_right.gif></td><td width=2></td>";
	}
	return $res;
}

function GetFormNameListAll()
{
	global $sql;
	$MyNewArr = '';

	$query = "SELECT * FROM bcms_formtypes where parent_id = 0 order by parent_id";
	$sql->query($query);
	$SubjMRows = $sql->fetchAll();
	foreach ($SubjMRows as $SubjInd => $SubjVal)
	{
		$query = "SELECT * FROM bcms_formtypes where parent_id = ".$SubjVal['menu_id']." ORDER by parent_id";
		$sql->query($query);
		$SubjRows = $sql->fetchAll();
		if (count($SubjRows)>0)
		{
			$MyNewArr[] = $SubjVal;
			foreach ($SubjRows as $SubjInd1 => $SubjVal1)
			{
				$MyNewArr[] = $SubjVal1;
				$MyChildArr = GetSubjectChildsNamesList($SubjVal1['menu_id']);
				if (is_array($MyChildArr))
				if (count($MyChildArr) > 0)
				{
					foreach ($MyChildArr as $SubjInd2 => $SubjVal1Child)
					{
						$MyNewArr[] = $SubjVal1Child;
					}
				}
			}
		}
		else
		{
			$MyNewArr[] = $SubjVal;
		}
	}
	return $MyNewArr;
}
function GetFormChildsNamesList($subjId)
{
	global $sql;

	$res = '';

	$query = "SELECT * FROM bcms_formtypes where parent_id = ".$subjId." ORDER by parent_id";

	$sql->query($query);
	$SubjRows = $sql->fetchAll();
	if (count($SubjRows)>0)
	{
		$res = array();
		foreach ($SubjRows as $SubjInd1 => $SubjVal1)
		{
			$res[] = $SubjVal1;
			$MyChildArr = GetFormChildsNamesList($SubjVal1['menu_id']);
			if (is_array($MyChildArr))
			if (count($MyChildArr) > 0)
			{
				foreach ($MyChildArr as $SubjInd2 => $SubjVal1Child)
				{
					$res[] = $SubjVal1Child;
				}
			}
		}
	}

	return $res;
}

function GetFormNameList($subjId, $fieldName)
{
	global $sql;
	$res = '';
	if ($subjId != 0) {
		$query = 'select parent_id, '.$fieldName.' name from bcms_formtypes where parent_id = '.$subjId;
		$sql->parse($query);
		$row = $sql->fetchAssoc();
		$res = GetSubjectNameList($row['parent_id'], $fieldName);
		$res .= "<td width=2><img src=images/topbox_left.gif></td><td bgcolor='5088A7' style='PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px'><a href=\"index.php?act=setAction&subj_id=" . MyPiCrypt($subjId) . "\" target='mainframe'class='white'  title='".htmlspecialchars($row['name'])."'>" . htmlspecialchars($row['name']) . "</a></td><td width=2><img src=images/topbox_right.gif></td><td width=2></td>";
	}
	return $res;
}

function LTableSelectBox($name, $checked = null, $ASuffix = 'Lang')
{
	global $lang;
	$ltable = "<select id='$name' name='$name' style='width:200' onchange='ChangeLangs(\"$ASuffix\", this.selectedIndex);'>";
	for ($i=0; $i<2; $i++)
	{
		$selected_ltable = ($checked == $i) ? "selected" : "";
		$ltable .= "<option value=$i $selected_ltable>".$lang['LTABLE_'.$i];
	}
	$ltable .= "</select>";

	return $ltable;
}

function SubjectParentSelectBox($name, $subjId, $fieldName,$id=false)
{
	global $sql, $lang;
	$subjName = '';
	if ($subjId > 0)
	{
		$query = 'select '.$fieldName.' name from subjstruct where subj_id = '.$subjId;
		$sql->parse($query);
		$subjNameA = $sql->fetchAssoc();
		$subjName = ' ('.$subjNameA['NAME'].')';
	}

	if ($id!=false)
	{
		$IdVal = " id='".$id."'"	;
	}
	else
	{
		$IdVal="";
	}
	$subjParent = "<select name='$name' class='aClassSelect'".$IdVal.">";

	$selected = ($subjId <= 0) ? "selected" : "";
	$subjParent .= "<option value=0 $selected>".$lang['NEW_MENU']."</option>";

	$selected = ($subjId > 0) ? "selected" : "";
	$subjParent .= "<option value=1 $selected>".$lang['SECTION'].$subjName."</option>";

	$subjParent .= "</select>";

	return $subjParent;
}

function GetFieldType($type,$lenght,$addoption)
{
	$mLenght = ($lenght == 0) ? "" : "(".$lenght.")";
	$data = $type.$mLenght;

	if ($addoption == "auto_inc")
	{
		$data .= " unsigned NOT NULL auto_increment";
	}
	else
	{
		if ($type == "INTEGER")
		{
			$data .= " unsigned";
		}
		$data .= " NOT NULL";
	}
	return $data;
}

function GetPrimaryKey($field,$addoption)
{
	foreach ($addoption as $id => $val)
	{
		if ($val == "auto_inc")
		{
			return "PRIMARY KEY  (`".$field[$id]."`)";
		}
	}
}
function DoAdditionalJob($table,$post)
{
	global $sql,$_SESSION;
	switch ($table)
	{
		case "bcms_appeal":
		include("../Mail.php");
		$recipients = $_POST['email'];
		$headers["From"]    = "support@perfectum.uz";
		$headers["To"]      = $_POST['email'];
		$headers["Subject"] = "Ответ на Ваше обращениe";
		$body = $_POST['appeale']."\n-------------------\n".$_POST['answere']."\n С уважением компания Perfectum.";
		$params["host"] = "192.168.1.222";
		$params["port"] = "25";
		$params["auth"] = true;

		$params["username"] = "webmaster";
		$params["password"] = "159753w";
		// Create the mail object using the Mail::factory method
		$mail_object =& Mail::factory("smtp", $params);
		$mail_object->send($recipients, $headers, $body);

		break;

		case "test_teachers":
			#Insert subjects of teacher
			if (isset($_POST['subjects']))
			{

				$Teacher  = $_POST['id'];
				$Subjects  = $_POST['subjects'];

				foreach ($Subjects as $id1 => $val1)
				{
					if ($val1 != 0)
					{
						$SubjectArr[] = $val1;
					}
				}

				$SubjectList = implode(",",$SubjectArr);

				$SelQuery = "select * from test_teachers_subjects where teacher = {$Teacher} and subject IN ({$SubjectList})";
				$sql->query($SelQuery);
				$Result = $sql->fetchAll();
				$pKeyArr = array();

				if (count($Result) > 0)
				{
					foreach ($Result as $rId => $rVal)
					{
						if (in_array($rVal['subject'],$SubjectArr))
						{
							$key = array_search($rVal['subject'],$SubjectArr);
							$pKeyArr[] = $rVal['id'];
							unset($SubjectArr[$key]);
						}
					}
					foreach ($SubjectArr as $cId => $cVal)
					{
						$InsQuery = "insert into test_teachers_subjects (teacher,subject)
						VALUES ({$Teacher},{$cVal})";
						$sql->query($InsQuery);
					}

					$DelQuery = "delete from test_teachers_subjects where teacher = {$Teacher} and subject NOT IN ({$SubjectList})";
					$sql->query($DelQuery);
				}
				else
				{
					foreach ($SubjectArr as $cId => $cVal)
					{
						$InsQuery = "insert into test_teachers_subjects (teacher,subject)
						VALUES ({$Teacher},{$cVal})";
						$sql->query($InsQuery);
					}
				}
			}
		break;
	}
}

function roundNearestHundredUp($number)
{
	return ceil( $number / 100 ) * 100;
}

function getUserAgent($AgentId)
{
	global $sql;
	$query = "SELECT company,name FROM bcms_agents t where t.id = ".$AgentId;
	$sql->query($query);
	$Res = $sql->fetchAssoc();
	if ($sql->numRows() > 0)
	{
		return $Res;
	}
	else
	{
		return 0;
	}
}
function getLastResAgent()
{
	global $sql;
	$query = "SELECT MAX(t.id) resid, (SELECT id FROM bcms_agents a WHERE a.id = t.`agent_id`) agentid FROM bcms_resources t";
	$sql->query($query);
	$Res = $sql->fetchAssoc();
	if ($sql->numRows() > 0)
	{
		set_cookie(' agent',$Res['agentid']);
		set_cookie('resource',$Res['resid']);
	}
}

function getLastRes($agent)
{
	global $sql;
	$query = "SELECT MAX(t.id) resid, (SELECT id FROM bcms_agents a WHERE a.id = t.`agent_id`) agentid FROM bcms_resources t WHERE t.agent_id = ".$agent;
	$sql->query($query);
	$Res = $sql->fetchAssoc();
	if ($sql->numRows() > 0)
	{
		set_cookie('resource',$Res['resid']);
	}
}

function getInfo($resource)
{
	global $sql;
	$query = "SELECT r.name, r.username, a.company FROM bcms_resources r LEFT JOIN bcms_agents a ON r.agent_id = a.id WHERE r.id =  ".$resource;
	$sql->query($query);
	$Res = $sql->fetchAssoc();
	if ($sql->numRows() > 0)
	{
		return $Res;
	}
}

/*
** Uploads an Image.
**
** Params:  $name - Name for uploaded Image
*/

function doUpload($MyFile,$path)
{
	global $_SESSION;
	$error = "";
	$imagedir = $_COOKIE['PicAddPath'].$path."/";
	$ThumbDir = "thumbnails/";
	$IMAGE_DIR = $_SERVER["DOCUMENT_ROOT"].$imagedir;
	$temp = $MyFile["tmp_name"]; #initialize context
	if(is_uploaded_file($temp)) #if File is a legitimate upload ...
	{
		$type = $MyFile["type"];
		$search = (isWindows() ? "eregi" : "ereg");
		$replace = (isWindows() ? "eregi" : "ereg");

		$name = $MyFile["name"];
		$path = basePath($name);

		if(!(file_exists($IMAGE_DIR . $path)))
		{
			$size = $MyFile["size"];
			if(UPLOAD_LIMIT == 0 || $size <= UPLOAD_LIMIT)
			{
				//chmod(IMAGE_DIR,777);
				if(!(@copy($temp, ($IMAGE_DIR . $path))))
				{
					$error = "File \'" . $path . "\' could not be created";
				}
				else
				{
					$types = array("image/gif" => "[.]gif$", "image/jpg" => "[.]jp[e]?g$", "image/jpeg" => "[.]jp[e]?g$", "image/pjpeg" => "[.]jp[e]?g$", "image/png" => "[.]png$", "image/x-png" => "[.]png$");

					// ... if File is a valid image ...
					if(isset($types[$type]))
					{
						include('class.upload.php');
						$handle = new upload($MyFile);
						if ($handle->uploaded)
						{
							// преобразования с файлом, все возможности в ссылке ниже
							$handle->file_new_name_body = str_ireplace(".jpg","",$path);
							$handle->image_resize = true;
							$handle->image_x = 50;
							$handle->image_ratio_y = true;

							$handle->process($IMAGE_DIR .$ThumbDir); // дирекстория для загрузки

							if ($handle->processed)
							{
								echo 'image resized'; // собственно дальнейшая работа с обработанной картинкой на сервере
								$handle->clean();
							} else {
								echo 'error: '. $handle->error; // вывод ошибок (рускоязычный файл ошибок доступен на сайте)
							}
						}
					}
				}
			}
			else
			{
				$error = "File \'" . $path . "\' exceeds " . round((UPLOAD_LIMIT / 1024)) . " KByte size limit";
			}
		}
		else
		{
			$error = "File \'" . $path . "\' already exists";
		}
	}
	else
	{
		$error = "Invalid upload environment";
	}
	return $error;
}


/*
** Returns the Windows status.
**
** Returns: TRUE if server is Windows hosted; FALSE otherwise
*/
function isWindows()
{
	global $_SERVER;
	// return the Windows status
	return isset($_SERVER["WINDIR"]);
}

/*
** Returns a complete Path from the Base.
**
** Params:  $path    - Path to complete
**          $nodes   - Count of Nodes to include
*/
function basePath($path, $nodes = 999) {
	global $base, $dirs;
	// initialize context

	$result = "";
	$count = count($dirs);
	// for ALL desired Nodes ...
	for($index = 0; $nodes > 0 && $index < $nodes && $index < $count; $index++)
	// ... if Node is NOT null ...
	if(strlen($dirs[$index]) > 0)
	// ... append the Node and separator
	$result .= $dirs[$index] . "/";
	// append the Path
	$result .= $path;
	// return the Path
	return $result;
}

function GetDirChilds($imagedir,$dir)
{
	
	$dh  = opendir(str_replace("&","/",$imagedir));
	$string = "";
	while (false !== ($filename = readdir($dh))) {
		if (!strstr($filename,"."))
		{
			$string .= "<option value='".$dir."/".$filename."'>".$dir."/".$filename."</option>";
			$string .= GetDirChilds($imagedir."/".$filename,$dir."/".$filename);
		}
	}
	return $string;
}

function resizeToFile ($sourcefile, $targetfile, $jpegqual,$totalsize)
{

	$picsize=getimagesize("$sourcefile");
	//print_r($picsize);
	$source_x  = $picsize[0];

	$source_y  = $picsize[1];
	//die();
	if ($picsize['mime'] == "image/gif")
	{
		$source_id = imagecreatefromgif($sourcefile);
	}
	else
	{
		$source_id = imageCreateFromJPEG($sourcefile);
	}

	if ($source_y > $totalsize)
	{
		$dest_y = $totalsize;
		$destPercent = round($dest_y/$source_y,2);
		$dest_x = $source_x*$destPercent;
		$target_id=imagecreatetruecolor($dest_x, $dest_y);
		$target_pic=imagecopyresampled($target_id,$source_id,
		0,0,0,0,
		$dest_x,$dest_y,
		$source_x,$source_y);
		imagejpeg ($target_id,"$targetfile",$jpegqual);
	}
	else
	{
		$target_id=imagecreatetruecolor($source_x, $source_y);
		$target_pic=imagecopyresampled($target_id,$source_id, 0,0,0,0, $source_x, $source_y, $source_x, $source_y);
		imagejpeg ($target_id,"$targetfile",$jpegqual);
	}

	return true;
}
function getPareTVs($tbl)
{
	global $sql;
	$query = "SELECT t.tbl2 FROM bcms_pare_tvs t WHERE t.tbl1 = '".$tbl."'";
	$sql->query($query);
	$Res = $sql->fetchAssoc();
	if ($sql->numRows() > 0)
	{
		return $Res['tbl2'];
	}
	else
	{
		return $tbl;
	}
}
function getParent($child)
{
	global $sql;
	$query = "SELECT parent FROM bcms_nodes t WHERE t.id = ".$child;
	$sql->query($query);
	$Res = $sql->fetchAssoc();
	if ($sql->numRows() > 0)
	{
		return $Res['parent'];
	}
	else
	{
		return 0;
	}
}

function RandNumber()
{
	$random_number = rand(0,9);
	return $random_number;
}

function MakePassword()
{
	return RandNumber().RandNumber().RandNumber().RandNumber();
}

function Jump($Page)
{
	header("Location: {$Page}");
}

function CheckRole($mid)
{
	header("Location: {$Page}");
}


function HeadLinks($step,$id,$type)
{
	global $sql, $Dict;
	$TypeFile[1] = "staff.php";
	$TypeFile[2] = "tests.php";
	$TypeFile[3] = "results.php";
	switch($step)
	{
		case "departments":
			$Link = "<a href='".$TypeFile[$type]."' class='back'>".$Dict['region_xtb']."</a>";
		break;

		case "schools":
			$query = "SELECT d.id did, d.region, d.`name1` dname 
							FROM port_departments d 
							WHERE d.region = (SELECT region FROM port_departments WHERE distcity = {$id}) AND distcity =0";
			$sql->query($query);
			$row = $sql->fetchAssoc();
			
			$Link = "<a href='".$TypeFile[$type]."' class='back'>".$Dict['region_xtb']."</a>";
			$Link .= "<a href='".$TypeFile[$type]."?act=departments&rid=".MyPiCrypt($row['region'])."' class='back'>".$row['dname']."</a>";
		break;
		
		case "staff":
			$query = "SELECT t.id, t.`region`, t.`distcity`, t.`school_number`, t.`school_name`,t.`school_type` FROM port_schools t WHERE t.id = ".$id;
			$sql->query($query);
			$School = $sql->fetchAssoc();

			$query = "SELECT d.id did, d.region, d.`name1` dname 
							FROM port_departments d 
							WHERE d.region = (SELECT region FROM port_departments WHERE distcity = {$School['distcity']}) AND distcity =0";
			$sql->query($query);
			$row = $sql->fetchAssoc();

			$query = "SELECT d.id rcid, d.`name1` rcname FROM port_departments d WHERE d.distcity = ".$School['distcity'];
			$sql->query($query);
			$DisCity = $sql->fetchAssoc();
			
			$Link = "<a href='".$TypeFile[$type]."' class='back'>".$Dict['region_xtb']."</a>";
			$Link .= "<a href='".$TypeFile[$type]."?act=departments&rid=".MyPiCrypt($row['region'])."' class='back'>".$row['dname']."</a>";
			$Link .= "<a href='".$TypeFile[$type]."?act=schools&dcid=".MyPiCrypt($School['distcity'])."' class='back'>".$DisCity['rcname']."</a>";
		break;

	}
	return $Link;
}
?>