<?
/****************************************************************
*                           formbuilder.php			 								*
*                          -------------------			  					*
*     begin                : 01.01.2010 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

if (isset($_GET['blang']))
{
	$blang = $_GET['blang'];
	setcookie('blang',$_GET['blang']);
}
else
{
	if (isset($_COOKIE['blang']))
	{
		$blang = $_COOKIE['blang'];
	}
	else
	{
		setcookie('blang',1);
		$blang = 1;
	}
}
header("If-Modified-Since: ".gmdate("D, d M Y H:i:s", time()-43200)." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s", time()+43200)." GMT"); // Дата протухания (через 12 часов)
header("Cache-Control: private");

define('ARM_IN', true);
include("includes/all_includes.php");

//print_r($_COOKIE);
$FormTypeId = isset($_GET['mid']) ? MyPiDeCrypt($_GET['mid']) : 0;

$query = "Select * from bcms_forms where menu like '%".$FormTypeId."%'";
$sql->query($query);
$Section = $sql->fetchAssoc();

$_SESSION['picPath'] = str_replace("&", "/",$Section['picpath']);
setcookie('picPath',$_SESSION['picPath']);

//$query = "Select * from bcms_forms where parent = ".$Section['menu'];
//$sql->query($query);
//$UnderSection = $sql->fetchAll();
//$UnderSectionRowsCount = $sql->numRows();

$UnderSection = array();
$UnderSectionRowsCount = 0;
/*echo base64_encode('select t.*, c.name1 as name
from bcms_teams t, bcms_clubs c
where t.team = c.id');
*/
$AddText = "";
if (isset($_GET['cid']))
{
	$addUrl = '&cid='.$_GET['cid'];
}
if (isset($_GET['parent']))
{
	$addUrlForm = '&parent='.$_GET['parent'];
}
if (count($Section)>0)
{
	$query = "Select * from bcms_fields where form_id = ".$Section['id']." order by id";
	$sql->query($query);
	$Fields = $sql->fetchAll();
	if (isset($_POST['SaveContent']))
	{

		if ($_POST['SaveContent'] == 'Save')
		{
			/*			print_r($_POST);
			die();
			*/			$FieldNameArr = array();
			$FieldsArr = array();
			foreach ($Fields as $id => $val)
			{

				$InputType = $val['InputType'];
				$ConInQuery = "INSERT INTO ".$Section['tablename'] ;
				switch ($InputType)
				{
					case "hidden":
						if ($val['addoptions'] == 'setUser')
						{
							$FieldsArr[] = $val['fieldname'];
							$FieldNameArr[] = $_POST[$val['fieldname']];
						}
						elseif ($val['addoptions'] != 'auto_inc')
						{
							if (is_array($_POST[$val['fieldname']]))
							{
								$FieldNameArr[] = "'".implode(",",$_POST[$val['fieldname']])."'";
							}
							else
							{
								if ($val['addoptions'] == 'SysDate')
								{
									$FieldNameArr[] = time();
								}
								else
								{
									$FieldNameArr[] = ($_POST[$val['fieldname']] !="") ? $_POST[$val['fieldname']] : "0";
								}
							}
							$FieldsArr[] = $val['fieldname'];
						}

						break;

					case "text":
						//echo $_POST[$val['fieldname']];
						$FieldsArr[] = $val['fieldname'];
						$FieldNameArr[] = "'".str_replace(",","",$_POST[$val['fieldname']])."'";
						break;

					case "textarea":
						$FieldsArr[] = $val['fieldname'];
						#$FieldNameArr[] = "'".addslashes($_POST[$val['fieldname']])."'";
						$FieldNameArr[] = "'".str_replace("'","&lsquo;",$_POST[$val['fieldname']])."'";
						break;

					case "html":
						$FieldsArr[] = $val['fieldname'];
						$FieldNameArr[] = "'".str_replace("'","&lsquo;",$_POST[$val['fieldname']])."'";
						//$FieldNameArr[] = "'".addslashes($_POST[$val['fieldname']])."'";
						break;

					case "select":
						if (is_array($_POST[$val['fieldname']]))
						{
							$FieldNameArr[] = "'".implode(",",$_POST[$val['fieldname']])."'";
						}
						else
						{
							$FieldNameArr[] = ($_POST[$val['fieldname']] !="") ? $_POST[$val['fieldname']] : "0";
						}

						$FieldsArr[] = $val['fieldname'];
						break;

					case "date":
						if (isset($_POST[$val['fieldname'].'time']))
						{
							$Date = explode(".",$_POST[$val['fieldname']]);
							$Today = $Date[2]."-".$Date[1]."-".$Date[0]." ".$_POST[$val['fieldname'].'time'];
						}
						else
						{
							$Date = explode(".",$_POST[$val['fieldname']]);
							$Today = $Date[2]."-".$Date[1]."-".$Date[0];
						}

						$FieldsArr[] = $val['fieldname'];
						$FieldNameArr[] = "'".$Today."'";
						break;

					case "radio":
						$FieldsArr[] = $val['fieldname'];
						$FieldNameArr[] = $_POST[$val['fieldname']];
						break;

					case "checkbox":
						if (is_array($_POST[$val['fieldname']]))
						{
							$FieldNameArr[] = "'".implode(",",$_POST[$val['fieldname']])."'";
						}
						else
						{
							$FieldNameArr[] = $_POST[$val['fieldname']];
						}
						$FieldsArr[] = $val['fieldname'];
						break;

					case "file":
						$FieldsArr[] = $val['fieldname'];
						if (isset($_FILES[$val['fieldname']]['size']))
						{
							if($_FILES[$val['fieldname']]['size'] != 0)
							{
								$DirArr = explode("/",$_POST[$val['fieldname']."ad"]);
								if (count($DirArr) > 1)
								{
									unset($DirArr[0]);
									$UploadDir = implode($DirArr,"/")."/";
								}
								else
								{
									$UploadDir = "";
								}

								$ddd = doUpload($_FILES[$val['fieldname']],$_POST[$val['fieldname']."ad"]);
								if ($ddd == '')
								{
									$FieldNameArr[] = "'{$UploadDir}{$_FILES[$val['fieldname']]['name']}'";
								}
								else
								{
									$MessErr = $ddd;
									$MessType = 3;
									$UpFileName = (strpos($ddd,'already exists')) ? $UploadDir.$_FILES[$val['fieldname']]['name'] : "";
									$FieldNameArr[] = "'".$UpFileName."'";
								}
							}
							else
							{
								$FieldNameArr[] = "''";
							}
						}
						else
						{
							if (isset($_POST[$val['fieldname']]))
							{
								$FieldNameArr[] = "'".$_POST[$val['fieldname']]."'";
							}
							else
							{
								$FieldNameArr[] = "''";
							}
						}
						break;

					case "password":
						$FieldsArr[] = $val['fieldname'];
						$FieldNameArr[] = "'".md5($_POST[$val['fieldname']])."'";
						break;
				}
				/*echo $val['fieldname']."=".$_POST[$val['fieldname']]."=".$val['InputType'];
				echo "<br>";*/
			}
			$FieldsString = implode($FieldsArr,",");
			$FieldsNameString = implode($FieldNameArr,",");
			$ConInQuery .= " (".$FieldsString.") VALUES (".$FieldsNameString.")";
/*echo $ConInQuery;
die();
*/			$sql->query($ConInQuery);
			if ($sql->error() != "")
			{
				$MessErr = $sql->error();
				$MessType = 3;
			}
			else
			{

			}
			$_POST['id'] = mysql_insert_id();
			DoAdditionalJob($Section['tablename'],$_POST);
			$smarty->assign(array(
			'MESSAGE' => isset($MessErr) ? $MessErr : $lang['LINE_ADD_SUCCESS'],
			'MESSAGE_TYPE' => isset($MessType) ? $MessType : 1,
			));
		}
		else if ($_POST['SaveContent'] == 'Update')
		{
			$FieldsArr = array();
			$ConInQuery = "UPDATE ".$Section['tablename']." SET ";
			$ConInQueryWhere = " WHERE 0=0";
			foreach ($Fields as $id => $val)
			{

				$InputType = $val['InputType'];
				switch ($InputType)
				{
					case "hidden":
						if ($val['addoptions'] == 'setUser')
						{
							$FieldsArr[] = $val['fieldname']." = ".$_POST[$val['fieldname']];
						}
						else
						{
							if (is_array($_POST[$val['fieldname']]))
							{
								if (count($_POST[$val['fieldname']]) > 1)
								{
									$FieldNameSel = "";
									$thId1 = 0;
									$TempArr = $_POST[$val['fieldname']];
									foreach ($_POST[$val['fieldname']] as $thId => $thVal)
									{
										if ($thVal!=0 or $val['priority'] == 1)
										{
											$FieldNameSel .= ($thId1==0) ? $thVal : ",".$thVal;
											$thId1++;
										}
										else
										{
											unset($TempArr[$thId]);
										}
									}
									$FieldNameSel .= (count($TempArr) == 0 ) ? 0 : "";
									$_POST[$val['fieldname']] = $TempArr;
								}
								else
								{
									$FieldNameSel = implode(",",$_POST[$val['fieldname']]);
								}
								$FieldsArr[] = $val['fieldname']." = '".$FieldNameSel."'";
								//$FieldsArr[] = $val['fieldname']." = "."'".implode(",",$_POST[$val['fieldname']])."'";
							}
							else
							{
								$ConInQueryWhere .= " AND ".$val['fieldname']." = ".$_POST[$val['fieldname']];
							}
						}
						break;

					case "text":
						if ($val['addoptions'] == "dynamic")
						{
							$FieldsArr[] = $val['fieldname']." = "."'".implode(",",$_POST[$val['fieldname']])."'";
						}
						else
						{
							if ($val['sqltype'] == "INTEGER")
							{
								$FieldsArr[] = $val['fieldname']." = ".str_replace(",","",$_POST[$val['fieldname']]);
							}
							else
							{
								$FieldsArr[] = $val['fieldname']." = "."'".str_replace(",","",$_POST[$val['fieldname']])."'";
							}
						}
						break;

					case "textarea":
						$FieldsArr[] = $val['fieldname']." = "."'".$_POST[$val['fieldname']]."'";
						break;

					case "html":
						$FieldsArr[] = $val['fieldname']." = "."'".$_POST[$val['fieldname']."e"]."'";
						break;

					case "select":
					case "radio":
					case "checkbox":
						if (is_array($_POST[$val['fieldname']]))
						{
							//if ($val['fieldname'] == 'call_type')
							//{
							//	print_r($_POST[$val['fieldname']]);
							//}
							if (count($_POST[$val['fieldname']]) > 1)
							{
								$FieldNameSel = "";
								$thId1 = 0;
								$TempArr = $_POST[$val['fieldname']];
								foreach ($_POST[$val['fieldname']] as $thId => $thVal)
								{
									if ($thVal!=0 or $val['priority'] == 1)
									{
										$FieldNameSel .= ($thId1==0) ? $thVal : ",".$thVal;
										$thId1++;
									}
									else
									{
										unset($TempArr[$thId]);
									}
								}
								$FieldNameSel .= (count($TempArr) == 0 ) ? 0 : "";
								$_POST[$val['fieldname']] = $TempArr;
							}
							else
							{
								$FieldNameSel = implode(",",$_POST[$val['fieldname']]);
							}
							$FieldsArr[] = $val['fieldname']." = '".$FieldNameSel."'";
						}
						else
						{
							$FieldNameSel = $_POST[$val['fieldname']];
							$FieldsArr[] = $val['fieldname']." = ".$FieldNameSel;
						}

						break;

					case "date":
						if (isset($_POST[$val['fieldname'].'time']))
						{
							if (strpos($_POST[$val['fieldname']],".") > 0)
							{
								$Date = explode(".",$_POST[$val['fieldname']]);
								$Today = $Date[2]."-".$Date[1]."-".$Date[0]." ".$_POST[$val['fieldname'].'time'];
							}
							else
							{
								$Today = $_POST[$val['fieldname']]." ".$_POST[$val['fieldname'].'time'];
							}
						}
						else
						{
							if (strpos($_POST[$val['fieldname']],".") > 0)
							{
								$Date = explode(".",$_POST[$val['fieldname']]);
								$Today = $Date[2]."-".$Date[1]."-".$Date[0];
							}
							else
							{
								$Today = $_POST[$val['fieldname']];
							}
						}

						$FieldsArr[] = $val['fieldname']." = '".$Today."'";;

						break;

					case "file":

						if (isset($_POST[$val['fieldname']]))
						{
							$FieldsArr[] = $val['fieldname']." = "."'".$_POST[$val['fieldname']]."'";
						}
						else
						{
							$DirArr = explode("/",$_POST[$val['fieldname']."ed"]);
							if (count($DirArr) > 1)
							{
								unset($DirArr[0]);
								$UploadDir = implode($DirArr,"/")."/";
							}
							else
							{
								$UploadDir = "";
							}
							//print_r($_FILES);
							//echo $_FILES[$val['fieldname']]['name'];

							if (isset($_FILES[$val['fieldname']]['size']))
							{
								if($_FILES[$val['fieldname']]['size'] != 0)
								{
									$ddd = doUpload($_FILES[$val['fieldname']],$_POST[$val['fieldname']."ed"]);
									if ($ddd == '')
									{
										$FieldsArr[] = $val['fieldname']." = "."'".$UploadDir.$_FILES[$val['fieldname']]['name']."'";
									}
									else
									{
										$MessErr = $ddd;
										$MessType = 3;
										$UpFileName = (strpos($ddd,'already exists')) ? $UploadDir.$_FILES[$val['fieldname']]['name'] : "";
										$FieldsArr[] = $val['fieldname']." = '".$UpFileName."'";
									}
								}
								else
								{
									$FieldsArr[] = $val['fieldname']." = ''";
								}
							}
						}
						break;

					case "password":
						if ($_POST[$val['fieldname']] != "")
						{
							$FieldsArr[] = $val['fieldname']." = "."'".md5($_POST[$val['fieldname']])."'";
						}
						break;
				}
			}

			$FieldsString = implode($FieldsArr,",");
			$ConInQuery .= $FieldsString.$ConInQueryWhere;

			$sql->query($ConInQuery);
			if ($sql->error() != "")
			{
				$MessErr = $ConInQuery;
				$MessType = 3;
			}
			DoAdditionalJob($Section['tablename'],$_POST);
			
			$smarty->assign(array(
			'MESSAGE' => isset($MessErr) ? $MessErr : $lang['LINE_EDIT_SUCCESS'],
			'MESSAGE_TYPE' => isset($MessType) ? $MessType : 2,
			));
		}
		else
		{
			$ConInQuery = "DELETE FROM ".$Section['tablename']." WHERE id = ".$_POST['id'];
			$sql->query($ConInQuery);
			if ($sql->error() != "")
			{
				$MessErr = $sql->error();
				$MessType = 3;
			}
			DoAdditionalJob($Section['tablename'],$_POST);
			$smarty->assign(array(
			'MESSAGE' => isset($MessErr) ? $MessErr : $lang['LINE_DEL_SUCCESS'],
			'MESSAGE_TYPE' => isset($MessType) ? $MessType : 3,
			));
		}
	}

	$ListMembers = array();
	$ListMembersTypes = array();
	$ListMemberNames = array();
	$ListMemberChild = array();
	$JavaProccVal = "";
	$JavaProccVald = "";
	$JavaSetValues = "";
	$SortSelectBox = "";
	$LangLinks = "";
	$JavaId = 0;
	$SetUserIdAddQuery = "";
	$CouplesArr = array();
	foreach ($Fields as $id => $val)
	{
		$JavaId++;

		$TheFieldsArr[$val['fieldname']] = $val['fieldname'];
		if (isset($CouplesArr[$val['id']]))
		{
			//$InputType = "couple";
			$couplesArrUnset[$id] = 1;
		}
		else
		{
			$InputType = $val['InputType'];
		}
		//echo $val['addoptions']."<br>";
		switch ($InputType)
		{
			case "hidden":
				$TheFieldd[$id] = "<input type=".$InputType." name='".$val['fieldname']."' id='".$val['fieldname']."d'>";
				if ($val['addoptions'] != 'dynamic')
				{
					if ($val['addoptions'] == 'parent & child')
					{
						if (isset($_GET['parent']))
						{
							$ParentNode = $_GET['parent'];
						}
						else
						{
							$ParentNode = 0;
						}
					}
					$TheFielde[$id] = "<input type=".$InputType." name='".$val['fieldname']."' id='".$val['fieldname']."e'>";
					$JavaProccVal .= "document.getElementById('".$val['fieldname']."e').value = newArray[".$JavaId."];\n";
				}
				else
				{
					$DynamicForms[] = array($val['fieldname'],"newArray[".$JavaId."]");
				}
				$JavaProccVald .= "document.getElementById('".$val['fieldname']."d').value = newArray[".$JavaId."];\n";
				if ($val['addoptions'] == 'setUser')
				{
					//echo "Bismillahi !1".$val['fieldname'];
					//$JavaProccVal .= "document.getElementById('".$val['fieldname']."').value = 1;\n";
					$TheField[$id] = "<input type=".$InputType." name='".$val['fieldname']."' id='".$val['fieldname']."' value=".$_SESSION['collegid'].">";
					$SetUserIdAddQuery = $val['fieldname']." = ".$_SESSION['collegid'];
					//$TheField[$id] = "Bismillahi";
				}
				else
				{
					$TheField[$id] = "<input type=".$InputType." name='".$val['fieldname']."' id='".$val['fieldname']."'>";
				}
				//print_r($TheField);
				break;

			case "text":
				if ($val['addoptions'] == 'dynamic')
				{
					$DynamicForms[] = array($val['fieldname'],"newArray[".$JavaId."]");
				}
				else
				{
					if ($val['addoptions'] == 'Money')
					{
						$TheField[$id] = "<input type=".$InputType." name='".$val['fieldname']."' onkeyup='separateThousands(this)' class=flatFields style='width:".$val['width'].";' id='".$val['fieldname']."'>";
						$TheFielde[$id] = "<input type=".$InputType." name='".$val['fieldname']."' onkeyup='separateThousands(this)' class=flatEdit style='width:".$val['width'].";' id='".$val['fieldname']."e'>";
					}
					else
					{
						$TheField[$id] = "<input type=".$InputType." name='".$val['fieldname']."' class=flatFields style='width:".$val['width'].";' id='".$val['fieldname']."'>";
						$TheFielde[$id] = "<input type=".$InputType." name='".$val['fieldname']."' class=flatEdit style='width:".$val['width'].";' id='".$val['fieldname']."e'>";
					}
					$TheFieldd[$id] = "<input type=".$InputType." name='".$val['fieldname']."' onkeyup='separateThousands(this)' class=flatDel style='width:".$val['width'].";' id='".$val['fieldname']."d'>";
					$JavaProccVal .= "document.getElementById('".$val['fieldname']."e').value = newArray[".$JavaId."];\n";
					$JavaProccVald .= "document.getElementById('".$val['fieldname']."d').value = newArray[".$JavaId."];\n";
				}
				break;

			case "textarea":
				$TheField[$id] = "<textarea class='AreaFlat' style='width:".$val['width']."; height:".$val['height'].";' name='".$val['fieldname']."' id='".$val['fieldname']."'></textarea>";
				$TheFielde[$id] = "<textarea class='AreaFlat' style='width:".$val['width']."; height:".$val['height'].";' name='".$val['fieldname']."' id='".$val['fieldname']."e'></textarea>";
				$TheFieldd[$id] = "<textarea class='AreaFlat' style='width:".$val['width']."; height:".$val['height'].";' name='".$val['fieldname']."' id='".$val['fieldname']."d'></textarea>";
				$JavaProccVal .= "document.getElementById('".$val['fieldname']."e').value = newArray[".$JavaId."];\n";
				$JavaProccVald .= "document.getElementById('".$val['fieldname']."d').value = newArray[".$JavaId."];\n";
				break;

			case "html":
				if ($val['addoptions'] == 'elRTE')
				{
					$elTRE =1;
					$TheField[$id] = "<div id='".$val['fieldname']."'></div>";
					$TheFielde[$id] = "<div id='".$val['fieldname']."e'></div>";
					$TheFieldd[$id] = "<div id='".$val['fieldname']."d'></div>";
				}
				else
				{
					$TheField[$id] = "<textarea class='AreaFlat' style='width:".$val['width']."; height:".$val['height'].";' name='".$val['fieldname']."' id='".$val['fieldname']."'></textarea>";
					$TheFielde[$id] = "<textarea class='AreaFlat' style='width:".$val['width']."; height:".$val['height'].";' name='".$val['fieldname']."e' id='".$val['fieldname']."e'></textarea>";
					$TheFieldd[$id] = "<textarea class='AreaFlat' style='width:".$val['width']."; height:".$val['height'].";' name='".$val['fieldname']."d' id='".$val['fieldname']."d'></textarea>";
				}
				if ($val['addoptions'] == 'HTMLArea')
				{
					#$JavaProccVal .= "editor_insertHTML1('".$val['fieldname']."e', newArray[".$JavaId."],'', 0);\n";
					#$JavaProccVald .= "editor_insertHTML1('".$val['fieldname']."d', newArray[".$JavaId."],'', 0);\n";
					$JavaProccVal .= "editor_setHTML('".$val['fieldname']."e', newArray[".$JavaId."]);\n";
					$JavaProccVald .= "editor_setHTML('".$val['fieldname']."d', newArray[".$JavaId."]);\n";

					//$JavaProccVal .= "document.getElementById('".$val['fieldname']."e').value = newArray[".$JavaId."];\n";
					//$JavaProccVald .= "document.getElementById('".$val['fieldname']."d').value = newArray[".$JavaId."];\n";
				}
				elseif ($val['addoptions'] == 'elRTE')
				{
					$JavaProccVal .= "$('#".$val['fieldname']."e').elrte('val', newArray[".$JavaId."]);\n";
					$JavaProccVal .= "$('#".$val['fieldname']."d').elrte('val', newArray[".$JavaId."]);\n";
				}
				else{
					$JavaProccVal .= "var oEditorE = FCKeditorAPI.GetInstance('".$val['fieldname']."e');\n";
					$JavaProccVal .= "oEditorE.InsertHtml(newArray[".$JavaId."]);\n;";
					$JavaProccVald .= "oFCKeditorD.Value = newArray[".$JavaId."];\n";
				}
				break;

			case "select":
				if ($val['addoptions'] == 'parent & child')
				{
					if (isset($_GET['parent']))
					{
						$ParentNode = $_GET['parent'];
					}
					else
					{
						if ($val['fieldname'] == "id" || $val['fieldname'] == "parent")
						{
							$ParentNode = 0;
						}
					}
				}
				if ($val['coupleoptions'] != "")
				{
					$query = "SELECT * FROM bcms_fields where coupleoptions = ".$val['coupleoptions']." and id != ".$val['id']." and form_id = ".$val['form_id'];
					$sql->query($query);
					$cRows = $sql->fetchAll();

					foreach ($cRows as $cId => $cVal)
					{
						$CouplesArr[$cVal['id']] = $cVal['fieldname'];
					}
				}
				if (isset($_POST[$val['fieldname']]))
				{
					$JavaSetValues .= "if (el=document.getElementById('".$val['fieldname']."fc')){ el.value = ".$_POST[$val['fieldname']]."; }";
				}

				$query = "select vquery from bcms_views where tablename = '".$val['stable']."'";
				$sql->query($query);
				$View = $sql->fetchAssoc();

				if ($View['vquery'] != "")
				{
					$query = $View['vquery'];
				}
				else
				{
					if ($val['idOrder'] == "parent")
					{
						$SortByParent = 1;
						$query = "Select ".$val['idField'].",".$val['idValue'].",".$val['idOrder']." from ".$val['stable'];
					}
					else
					{
						$SortByParent = 0;
					$query = "Select ".$val['idField'].",".$val['idValue']." from ".$val['stable'];
					}
				}
				if ($val['idOrder']!="")
				{
					$query .= " Order by ".$val['idOrder'];
				}

				$sql->query($query);
				$SelBoxVal = $sql->fetchAll();

				if ($val['addoptions'] == 'multiple')
				{
					$SelectBox = "<select name=".$val['fieldname']."[] class=free multiple style='width:".$val['width']."; height:".$val['height'].";' id='".$val['fieldname']."fc'>";
				}
				else
				{
					if ($val['addoptions'] == 'parent' || $val['addoptions'] == 'parent & child')
					{
						$SelectBox = "<select style='width:300px;' name=".$val['fieldname']." class=free onchange=getChildBoxVal(".$val['id'].",this.value,'parent','add'); id='".$val['fieldname']."fc'>";
					}
					else
					{
						if ($val['addoptions'] == 'dynamic')
						{
							$ParName = '';
							if ($val['ChildField'] != "" and $val['ChildField'] != 0)
							{
								$ParQuery = "select fieldname from bcms_fields where id = ".$val['ChildField'];
								$sql->query($ParQuery);
								$ParVal = $sql->fetchAssoc();
								$ParName = $ParVal['fieldname'];
							}
							$SelectBox = "<input type=button class='RefDynVal' value=' ++ ' style=width:30px;height=25px; onclick=AddDynamicSBNew(".$val['id'].",'".$val['fieldname']."','add','".$ParName."');>&nbsp;<input type=button value=' + ' style=width:25px;height=25px; onclick=AddDynamicSB(".$val['id'].",'".$val['fieldname']."','add','".$ParName."');><input type=hidden id=".$val['fieldname']."DynCount value=0>";
							//$SelectBox = $DynamicSpan;
						}
						else
						{
							$SelectBox = "<select name=".$val['fieldname']." class=free id='".$val['fieldname']."fc'>";
						}
					}
				}
				if ($val['addoptions'] != 'dynamic')
				{
					$SelectBox .= "<option value=0>--------------</option>";
					$ThisParent = 0;
					
					if ($SortByParent == 1)
					{
						$NewSelBox = array();
						foreach ($SelBoxVal as $SbID => $SbVal)
						{
							$NewSelBox[$SbVal[$val['idOrder']]][$SbVal['id']] = $SbVal;
						}
						function GetParOptions($arr,$ParStep)
						{
							global $NewSelBox, $val,$SelectBox;
							$ParStep .= "---";
							foreach ($arr as $arrid => $arrval)
							{
								$SelectBox .= "<option value=".$arrid.">".$ParStep.substr($arrval[$val['idValue']],0,60)."</option>";
								if (isset($NewSelBox[$arrid]))
								{
									GetParOptions($NewSelBox[$arrid],$ParStep);
								}
							}
						}
						$ParStep = "";
						foreach ($NewSelBox[0] as $nsid => $nsval)
						{
							$SelectBox .= "<option value=".$nsid.">".substr($nsval[$val['idValue']],0,60)."</option>";
							//print_r($NewSelBox[$nsid]);
							if (isset($NewSelBox[$nsid]))
							{
								GetParOptions($NewSelBox[$nsid],$ParStep);
							}
						}
					}
					else
					{
						foreach ($SelBoxVal as $SbID => $SbVal)
						{
							$SelectBox .= "<option value=".$SbVal[$val['idField']].">".substr($SbVal[$val['idValue']],0,60)."</option>";
						}
					}
					$SelectBox .= "</select>";
				}
				/*				if (isset($DynamicSpan))
				{
				$SelectBox .= "</span>";
				}
				*/


				#for edit
				$Tablename = getPareTVs($val['stable']);

				if ($val['idOrder'] == "parent")
				{
					$SortByParent = 1;
					$query = "Select ".$val['idField'].",".$val['idValue'].",".$val['idOrder']." from ".$val['stable'];
				}
				else
				{
					$SortByParent = 0;
					$query = "Select ".$val['idField'].",".$val['idValue']." from ".$val['stable'];
				}
				
				//$query = "Select ".$val['idField'].",".$val['idValue']." from ".$Tablename;
				if ($val['idOrder']!="")
				{
					$query .= " Order by ".$val['idOrder'];
				}
				/*				echo $query;
				echo "<br>";
				*/
				$sql->query($query);
				$SelBoxVal = $sql->fetchAll();

				if ($val['addoptions'] == 'multiple')
				{
					$SelectBoxE = "<select name=".$val['fieldname']."[] class=free multiple style='width:".$val['width']."; height:".$val['height'].";' id='".$val['fieldname']."fe'>";
				}
				else
				{
					if ($val['addoptions'] == 'parent' || $val['addoptions'] == 'parent & child')
					{
						$SelectBoxE = "<select name=".$val['fieldname']." style='width:300px;' class=free onchange=getChildBoxVal(".$val['id'].",this.value,'parent','edit') id='".$val['fieldname']."fe'>";
					}
					else
					{
						if ($val['addoptions'] == 'dynamic')
						{
							$ParName = '';
							if ($val['ChildField'] != "" and $val['ChildField'] != 0)
							{
								$ParQuery = "select fieldname from bcms_fields where id = ".$val['ChildField'];
								$sql->query($ParQuery);
								$ParVal = $sql->fetchAssoc();
								$ParName = $ParVal['fieldname'];
							}

							$SelectBoxE = "<input type=button value=' ++ ' style=width:30px;height=25px; onclick=".'"'."AddDynamicSBNew(".$val['id'].",'".$val['fieldname']."e','edit','".$ParName."')".'"'.">&nbsp;<input type=button value=' + ' style=width:25px;height=25px; onclick=".'"'."AddDynamicSB(".$val['id'].",'".$val['fieldname']."e','edit','".$ParName."')".'"'."><input type=hidden id='".$val['fieldname']."eDynCount' value=0>";
							$DynamicContent = "<input type=button value=' ++ ' style=width:30px;height=25px; onclick=".'"'."AddDynamicSBNew(".$val['id'].",'".$val['fieldname']."e','edit','".$ParName."')".'"'.">&nbsp;<input type=button value=' + ' style=width:25px;height=25px; onclick=".'"'."AddDynamicSB(".$val['id'].",'".$val['fieldname']."e','edit','".$ParName."')".'"'."><input type=hidden id='".$val['fieldname']."eDynCount' value=0>";
							//$SelectBoxE = $DynamicSpanE."<select name=".$val['fieldname']."[] class=free id='".$val['fieldname']."fe'>";

							//$SelectBoxE = "<select name=".$val['fieldname']."[] class=free id='".$val['fieldname']."fe'>";

						}
						else
						{
							$SelectBoxE = "<select name=".$val['fieldname']." class=free id='".$val['fieldname']."fe'>";
						}
					}
				}
				if ($val['addoptions'] != 'dynamic')
				{

					$SelectBoxE .= "<option value=0>--------------</option>";
					if ($SortByParent == 1)
					{
						$NewSelBox = array();
						foreach ($SelBoxVal as $SbID => $SbVal)
						{
							$NewSelBox[$SbVal[$val['idOrder']]][$SbVal['id']] = $SbVal;
						}
						function GetParOptionsE($arr,$ParStep)
						{
							global $NewSelBox, $val,$SelectBoxE;
							$ParStep .= "---";
							foreach ($arr as $arrid => $arrval)
							{
								$SelectBoxE .= "<option value=".$arrid.">".$ParStep.substr($arrval[$val['idValue']],0,60)."</option>";
								if (isset($NewSelBox[$arrid]))
								{
									GetParOptionsE($NewSelBox[$arrid],$ParStep);
								}
							}
						}
						$ParStep = "";
						foreach ($NewSelBox[0] as $nsid => $nsval)
						{
							$SelectBoxE .= "<option value=".$nsid.">".substr($nsval[$val['idValue']],0,60)."</option>";
							//print_r($NewSelBox[$nsid]);
							if (isset($NewSelBox[$nsid]))
							{
								GetParOptionsE($NewSelBox[$nsid],$ParStep);
							}
						}
					}
					else
					{
						foreach ($SelBoxVal as $SbID => $SbVal)
						{
							$SelectBoxE .= "<option value=".$SbVal[$val['idField']].">".substr($SbVal[$val['idValue']],0,60)."</option>";
						}
					}				
					//foreach ($SelBoxVal as $SbID => $SbVal)
					//{
					//	$SelectBoxE .= "<option value=".$SbVal[$val['idField']].">sss".substr($SbVal[$val['idValue']],0,60)."</option>";
					//}
					$SelectBoxE .= "</select>";
				}

				#for delete
				if ($val['addoptions'] == 'multiple')
				{
					$SelectBoxD = "<select name=".$val['fieldname']."[] class=free multiple style='width:".$val['width']."; height:".$val['height'].";' id='".$val['fieldname']."fd'>";
				}
				else
				{
					if ($val['addoptions'] == 'parent' || $val['addoptions'] == 'parent & child')
					{
						$SelectBoxD = "<select name=".$val['fieldname']." class=free onchange=getChildBoxVal(".$val['id'].",this.value,'".$val['fieldname']."','del') id='".$val['fieldname']."fd'>";
					}
					else
					{
						if ($val['addoptions'] == 'dynamic')
						{
							$SelectBoxD = "<select name=".$val['fieldname']."[] class=free id='".$val['fieldname']."fd'>";
						}
						else
						{
							$SelectBoxD = "<select name=".$val['fieldname']." class=free id='".$val['fieldname']."fd'>";
						}
					}
				}
				if ($val['addoptions'] != 'dynamic')
				{
					$SelectBoxD .= "<option value=0>--------------</option>";
					foreach ($SelBoxVal as $SbID => $SbVal)
					{
						$SelectBoxD .= "<option value=".$SbVal[$val['idField']].">".substr($SbVal[$val['idValue']],0,60)."</option>";
					}
					$SelectBoxD .= "</select>";
				}

				$TheField[$id] = "<span id='".$val['fieldname']."'>".$SelectBox."</span>";
				if ($val['addoptions'] == 'dynamic')
				{
					//$TheFielde[$id] = "<span id='".$val['fieldname']."e'>".$SelectBoxE."</span>";
					$TheFielde[$id] = "<span id='".$val['fieldname']."e'>".$SelectBoxE."</span><span style='display:none;' id='".$val['fieldname']."ed'>".$DynamicContent."</span>";
				}
				else
				{
					$TheFielde[$id] = "<span id='".$val['fieldname']."e'>".$SelectBoxE."</span>";
				}
				$TheFieldd[$id] = "<span id='".$val['fieldname']."d'>".$SelectBoxD."</span>";
				if ($val['addoptions'] == 'dynamic')
				{
					/*//$JavaProccVal .= "document.getElementById('".$val['fieldname']."eDynCount').value = newArray[".$JavaId."];\n";
					$JavaProccVal .= "	var nameList".$JavaId." = newArray[".$JavaId."];\n
					var regexp".$JavaId." = ',';\n
					var newArray".$JavaId." = nameList".$JavaId.".split(regexp".$JavaId.");\n
					timerId".$JavaId." = setTimeout(".'"'."EditDynamicSB(".$val['id'].",'".$val['fieldname']."','edit')".'"'.", 1000);
					clearInterval(timerId".$JavaId.");\n";*/
					$DynamicForms[] = array($val['fieldname'],"newArray[".$JavaId."]");
				}
				else
				{
					$JavaProccVal .= "document.getElementById('".$val['fieldname']."fe').value = newArray[".$JavaId."];\n";
				}
				$JavaProccVald .= "document.getElementById('".$val['fieldname']."fd').value = newArray[".$JavaId."];\n";
				break;

			case "date":
				$ss = getdate();
				$Time = $ss['hours'].":".$ss['minutes'].":".$ss['seconds'];

				if ($val['sqltype'] == 'DATETIME')
				{
					$TheField[$id] = "<input type=text name=".$val['fieldname']." class=flatFields maxlength=10 size=10 id='".$val['fieldname']."'>&nbsp;<input type=text class=flatFields name='".$val['fieldname']."time' maxlength=8 size=4 value=".$Time."><INPUT type=button onclick=toggleCalendar('".$val['fieldname']."') class=buttonCalendar>";
					$TheFielde[$id] = "<input type=text name=".$val['fieldname']." class=flatEdit maxlength=10 size=10 id='".$val['fieldname']."e'>&nbsp;<input type=text class=flatEdit name='".$val['fieldname']."time' maxlength=8 size=4 value='' id='".$val['fieldname']."timee'><INPUT type=button onclick=toggleCalendar('".$val['fieldname']."e') class=buttonCalendar>";
					$TheFieldd[$id] = "<input type=text name=".$val['fieldname']." class=flatDel maxlength=10 size=10 id='".$val['fieldname']."d'>&nbsp;<input type=text class=flatDel name='".$val['fieldname']."time' maxlength=8 size=4 value='' id='".$val['fieldname']."timed'><INPUT type=button onclick=toggleCalendar('".$val['fieldname']."d') class=buttonCalendar>";

					$JavaProccVal .= "var nameListTime = newArray[".$JavaId."];";
					$JavaProccVal .= "var regexpTime = ' ';";
					$JavaProccVal .= "var newArrayTime = nameListTime.split(regexpTime);";
					$JavaProccVal .= "document.getElementById('".$val['fieldname']."e').value = newArrayTime[0];\n";
					$JavaProccVal .= "document.getElementById('".$val['fieldname']."timee').value = newArrayTime[1];\n";

					$JavaProccVald .= "var nameListTime = newArray[".$JavaId."];";
					$JavaProccVald .= "var regexpTime = ' ';";
					$JavaProccVald .= "var newArrayTime = nameListTime.split(regexpTime);";
					$JavaProccVald .= "document.getElementById('".$val['fieldname']."d').value = newArrayTime[0];\n";
					$JavaProccVald .= "document.getElementById('".$val['fieldname']."timed').value = newArrayTime[1];\n";
				}
				else
				{
					$TheField[$id] = "<input type=text name=".$val['fieldname']." class=flatFields maxlength=10 size=10 id='".$val['fieldname']."'>&nbsp;<script>new tcal ({'formname': 'FormAdd','controlname': '".$val['fieldname']."'});</script>";
					$TheFielde[$id] = "<input type=text name=".$val['fieldname']." class=flatEdit maxlength=10 size=10 id='".$val['fieldname']."e'>&nbsp;<script>new tcal ({'formname': 'FormEdit','controlname': '".$val['fieldname']."e'});</script>";
					$TheFieldd[$id] = "<input type=text name=".$val['fieldname']." class=flatDel maxlength=10 size=10 id='".$val['fieldname']."d'>&nbsp;<script>new tcal ({'formname': 'FormDel','controlname': '".$val['fieldname']."d'});</script>";
					$JavaProccVal .= "var newDateArrEdd = newArray[".$JavaId."].split('-');";
					$JavaProccVal .= "document.getElementById('".$val['fieldname']."e').value = newDateArrEdd[2]+'.'+newDateArrEdd[1]+'.'+newDateArrEdd[0];\n";
					$JavaProccVald .= "var newDateArrDel = newArray[".$JavaId."].split('-');";
					$JavaProccVald .= "document.getElementById('".$val['fieldname']."d').value =newDateArrDel[2]+'.'+newDateArrDel[1]+'.'+newDateArrDel[0];\n";
					$isDate = 1;

				}

				break;

			case "radio":
				$query = "Select ".$val['idField'].",".$val['idValue']." from ".$val['stable'];
				$sql->query($query);
				$SelBoxVal = $sql->fetchAll();

				$RadioBox = "";
				$RadioBoxE = "";
				$RadioBoxD = "";
				$ArrIndex = 0;
				foreach ($SelBoxVal as $SbID => $SbVal)
				{
					$RadioBox .= "<input type=radio name=".$val['fieldname']." value=".$SbVal[$val['idField']]." id='".$val['fieldname']."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>";
					$RadioBoxE .= "<input type=radio name=".$val['fieldname']." value=".$SbVal[$val['idField']]." id='".$val['fieldname'].$SbVal[$val['idField']]."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>";
					$RadioBoxD .= "<input type=radio name=".$val['fieldname']." value=".$SbVal[$val['idField']]." id='".$val['fieldname'].$SbVal[$val['idField']]."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>";
				}

				$TheField[$id] = $RadioBox;
				$TheFielde[$id] = $RadioBoxE;
				$TheFieldd[$id] = $RadioBoxD;

				$JavaProccVal .= "var nameList".$id." = newArray[".$JavaId."];\n";
				$JavaProccVal .= "var regexp".$id." = ',';\n";
				$JavaProccVal .= "var newArray".$id." = nameList".$id.".split(regexp".$id.");\n";

				$JavaProccVal .= "window.status = newArray".$id."[0];\n";
				$JavaProccVal .= "for (i in newArray".$id.") {\n";
				$JavaProccVal .= " document.getElementById('".$val['fieldname']."'+newArray".$id."[i]).checked = true;\n";
				$JavaProccVal .= "}\n";

				$JavaProccVald .= "var nameList".$id." = newArray[".$JavaId."];\n";
				$JavaProccVald .= "var regexp".$id." = ',';\n";
				$JavaProccVald .= "var newArray".$id." = nameList".$id.".split(regexp".$id.");\n";

				$JavaProccVald .= "window.status = newArray".$id."[0];\n";
				$JavaProccVald .= "for (i in newArray".$id.") {\n";
				$JavaProccVald .= " document.getElementById('".$val['fieldname']."'+newArray".$id."[i]).checked = true;\n";
				$JavaProccVald .= "}\n";

				break;

			case "checkbox":
				$query = "select vquery from bcms_views where tablename = '".$val['stable']."'";
				$sql->query($query);
				$View = $sql->fetchAssoc();

				if ($View['vquery'] != "")
				{
					$query = $View['vquery'];
				}
				else
				{
					if ($val['idOrder'] == "parent")
					{
						$SortByParent = 1;
						$query = "Select ".$val['idField'].",".$val['idValue'].",".$val['idOrder']." from ".$val['stable'];
					}
					else
					{
						$SortByParent = 0;
					$query = "Select ".$val['idField'].",".$val['idValue']." from ".$val['stable'];
					}
				}
				if ($val['idOrder']!="")
				{
					$query .= " Order by ".$val['idOrder'];
				}
				$sql->query($query);
				$SelBoxVal = $sql->fetchAll();

				$RadioBox = "";
				$RadioBoxE = "";
				$RadioBoxD = "";
				$ArrIndex = 0;

				if ($val['addoptions'] == 'OneColumn')
				{
					$AddText = "<br>";
				}

				
			if ($SortByParent == 1)
			{
				$NewSelBoxSort = array();
				
				foreach ($SelBoxVal as $SbID => $SbVal)
				{
					$NewSelBoxSort[$SbVal[$val['idOrder']]][$SbVal['id']] = $SbVal;
				}

				function GetParOptionsSort($arr,$ParStep)
				{
					global $NewSelBoxSort, $val,$SortSelectBox,$AddText,$RadioBoxE,$RadioBox,$RadioBoxD;
					$ParStep .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					foreach ($arr as $arrid => $arrval)
					{
					$RadioBox .= $ParStep."<input type=checkbox name=".$val['fieldname']."[] value=".$arrval[$val['idField']]." id='".$val['fieldname']."'> <span class=FlatVal>".$arrval[$val['idValue']]."</span>".$AddText;
					$RadioBoxE .= $ParStep."<input type=checkbox name=".$val['fieldname']."[] value=".$arrval[$val['idField']]." id='".$val['fieldname'].$arrval[$val['idField']]."'> <span class=FlatVal>".$arrval[$val['idValue']]."</span>".$AddText;
					$RadioBoxD .= $ParStep."<input type=checkbox name=".$val['fieldname']."[] value=".$arrval[$val['idField']]." id='".$val['fieldname'].$arrval[$val['idField']]."'> <span class=FlatVal>".$arrval[$val['idValue']]."</span>".$AddText;

						if (isset($NewSelBoxSort[$arrid]))
						{
							GetParOptionsSort($NewSelBoxSort[$arrid],$ParStep);
						}
					}
				}
				$ParStep = "";
				foreach ($NewSelBoxSort[0] as $nsid => $nsval)
				{
					
					$RadioBox .= "<span style='background-color:silver;padding:4px;'><input type=checkbox name=".$val['fieldname']."[] value=".$nsval[$val['idField']]." id='".$val['fieldname']."'> <span class=FlatVal><b style='color:black'>".$nsval[$val['idValue']]."</b></span>".$AddText."</span>";
					$RadioBoxE .= "<span style='background-color:silver;padding:4px;'><input type=checkbox name=".$val['fieldname']."[] value=".$nsval[$val['idField']]." id='".$val['fieldname'].$nsval[$val['idField']]."'> <span class=FlatVal style='color:black'><b>".$nsval[$val['idValue']]."</b></span>".$AddText."</span>";
					$RadioBoxD .= "<input type=checkbox name=".$val['fieldname']."[] value=".$nsval[$val['idField']]." id='".$val['fieldname'].$nsval[$val['idField']]."'> <span class=FlatVal><b>".$nsval[$val['idValue']]."</b></span>".$AddText;
					
					//$SortSelectBox .= "<option value=".$nsid." style='background: #e4eaf2; color: #000;' disabled>".substr($nsval[$val['idValue']],0,60)."</option>";
					//print_r($NewSelBox[$nsid]);
					if (isset($NewSelBoxSort[$nsid]))
					{
						GetParOptionsSort($NewSelBoxSort[$nsid],$ParStep);
					}
				}
			}
			else
			{
				foreach ($SelBoxVal as $SbID => $SbVal)
				{
					$RadioBox .= "<input type=checkbox name=".$val['fieldname']."[] value=".$SbVal[$val['idField']]." id='".$val['fieldname']."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>".$AddText;
					$RadioBoxE .= "<input type=checkbox name=".$val['fieldname']."[] value=".$SbVal[$val['idField']]." id='".$val['fieldname'].$SbVal[$val['idField']]."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>".$AddText;
					$RadioBoxD .= "<input type=checkbox name=".$val['fieldname']."[] value=".$SbVal[$val['idField']]." id='".$val['fieldname'].$SbVal[$val['idField']]."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>".$AddText;
				}
			}				
				$TheField[$id] = "<span id='".$val['fieldname']."Chbx'>".$RadioBox."</span>";
				$TheFielde[$id] = "<span id='".$val['fieldname']."Chbxe'>".$RadioBoxE."</span>";
				$TheFieldd[$id] = "<span id='".$val['fieldname']."Chbxd'>".$RadioBoxD."</span>";

				$JavaProccVal .= "var nameList".$id." = newArray[".$JavaId."];\n";
				$JavaProccVal .= "var regexp".$id." = ',';\n";
				$JavaProccVal .= "var newArray".$id." = nameList".$id.".split(regexp".$id.");\n";

				$JavaProccVal .= "window.status = newArray".$id."[0];\n";
				$JavaProccVal .= "for (i in newArray".$id.") {\n";
				$JavaProccVal .= "if (document.getElementById('".$val['fieldname']."'+newArray".$id."[i])){\n";
				$JavaProccVal .= " document.getElementById('".$val['fieldname']."'+newArray".$id."[i]).checked = true;\n";
				$JavaProccVal .= "}\n";
				$JavaProccVal .= "}\n";

				$JavaProccVald .= "var nameList".$id." = newArray[".$JavaId."];\n";
				$JavaProccVald .= "var regexp".$id." = ',';\n";
				$JavaProccVald .= "var newArray".$id." = nameList".$id.".split(regexp".$id.");\n";

				$JavaProccVald .= "window.status = newArray".$id."[0];\n";
				$JavaProccVald .= "for (i in newArray".$id.") {\n";
				$JavaProccVald .= "if (document.getElementById('".$val['fieldname']."'+newArray".$id."[i])){\n";
				$JavaProccVald .= " document.getElementById('".$val['fieldname']."'+newArray".$id."[i]).checked = true;\n";
				$JavaProccVald .= "}\n";
				$JavaProccVald .= "}\n";

				break;

			case "file":
				$elTRE =1;
				if (isset($_COOKIE['picPath']))
				{
					$imagedir = $_SERVER["DOCUMENT_ROOT"] ."/".$_COOKIE['picPath']."/";
					$PicPath = $_COOKIE['picPath'];
				}
				else
				{
					$imagedir = $_SERVER["DOCUMENT_ROOT"] ."/".$_SESSION['picPath']."/";
					$PicPath = $_SESSION['picPath'];
				}

				$DirSelBox = "";
				$DirSelBox .= "<option value='".$PicPath."'>".$PicPath."</option>";
				$DirSelBox .= GetDirChilds($imagedir,$PicPath);
				$DirSelBox .= "</select>";

				$DirSelBoxA = "<select name='".$val['fieldname']."ad' class=free>".$DirSelBox;
				$DirSelBoxU = $DirSelBox;

				$smarty->assign(array(
				'DirSelBoxA'		=>$DirSelBoxA,
				'DirSelBoxU'		=>$DirSelBoxU,
				));

				$TheField[$id] = "<span id='".$val['fieldname']."'>".$DirSelBoxA."<br><input type=".$InputType." name='".$val['fieldname']."' class='flatFields' style='width:".$val['width'].";'><input type=button value='Расмни танлаш' onclick=ChooseFile('".$val['fieldname']."','');></span>";
				$TheFielde[$id] = "<span id='".$val['fieldname']."e'>".$DirSelBoxU."<br><input type=".$InputType." name='".$val['fieldname']."' class='flatEdit' style='width:".$val['width'].";'><input type=button value='Расмни танлаш' onclick=ChooseFile('".$val['fieldname']."','e');></span>";
				$TheFieldd[$id] = "<span id='".$val['fieldname']."d'><input type=".$InputType." name='".$val['fieldname']."' class='flatDel' style='width:".$val['width'].";'><input type=button value='Расмни танлаш' onclick=dialog2('".$val['fieldname']."');></span>";

				//$JavaProccVal .= "document.getElementById('".$val['fieldname']."ep').innerHTML = '<img src=../pictures/' + newArray[".$JavaId."] +' border=0>';";
				$PicPathArr = explode("/",$_SESSION['picPath']);
				$PicPath = $PicPathArr[0];
				$JavaProccVal .= "var ElementCurrHTML = document.getElementById('".$val['fieldname']."e').innerHTML;\n";
				$JavaProccVal .= "if (newArray[".$JavaId."] == '') {\n";
				$JavaProccVal .= "BackFileForm1(".'"'.$val['fieldname'].'"'.");\n";
				$JavaProccVal .= "} else {\n";
				$JavaProccVal .= "document.getElementById('".$val['fieldname']."e').innerHTML = '<img src=../".$PicPath."/'+newArray[".$JavaId."]+' border=0><br><input type=text name=".$val['fieldname']." value='+newArray[".$JavaId."]+' class=flatFields><input type=button value=Cancel onclick=BackFileForm1(".'"'.$val['fieldname'].'"'.");>';\n";
				$JavaProccVal .= "}\n";

				$JavaProccVald .= "var ElementCurrHTML = document.getElementById('".$val['fieldname']."d').innerHTML;\n";
				$JavaProccVald .= "document.getElementById('".$val['fieldname']."d').innerHTML = '<img src=../".$PicPath."/'+newArray[".$JavaId."]+' border=0><br><input type=text name=".$val['fieldname']." value='+newArray[".$JavaId."]+' class=flatDel><input type=button value=Cancel onclick=BackFileForm2(".'"'.$val['fieldname'].'"'.");>';\n";
				break;

			case "password":
				$TheField[$id] = "<input type=".$InputType." name='".$val['fieldname']."' class='flatFields' style='width:".$val['width'].";' id='".$val['fieldname']."'>";
				$TheFielde[$id] = "<input type=".$InputType." name='".$val['fieldname']."' class='flatFields' style='width:".$val['width'].";' id='".$val['fieldname']."e'>";
				$TheFieldd[$id] = "<input type=".$InputType." name='".$val['fieldname']."' class='flatFields' style='width:".$val['width'].";' id='".$val['fieldname']."d'>";
				break;

		}
		if ($val['ListMember'])
		{
			if ($val['InputType'] == 'select')
			{

				$query = "select selquery from bcms_views where tablename = '".$val['stable']."'";
				//echo "<br>";
				$sql->query($query);
				$View = $sql->fetchAssoc();

				if ($View['selquery'] != "")
				{
					if ($val['idField'] == $val['idValue'] && $val['idField'] == $val['idOrder'])
					{
						$ListMembersQuery[] = "(select ".$val['idValue']." from ".$val['stable']." s where s.".$val['idField']." = t.".$val['fieldname']." limit 1) ".$val['fieldname'];
					}
					else
					{
						$SelQuery = str_replace('@var@',"t.".$val['fieldname'],$View['selquery']);
						//echo  str_replace('@fieldname@',$val['fieldname'],$SelQuery);
						//echo "<br>";
						$ListMembersQuery[] = str_replace('@fieldname@',$val['fieldname'],$SelQuery);
					}
				}
				else
				{
					$TableName = getPareTVs($val['stable']);
					$ListMembersQuery[] = "(select ".$val['idValue']." from ".$TableName." s where s.".$val['idField']." = t.".$val['fieldname']." limit 1) ".$val['fieldname'];
				}

				$ListMembers[] = $val['fieldname'];
				$ListMembersTypes[] = $val['addoptions'];
				$ListMemberNames[] = $val['name_e'];
			}
			elseif ($val['InputType'] == 'date')
			{
				$ListMembers[] = $val['fieldname'];;
				$ListMembersTypes[] = $val['addoptions'];
				$ListMembersQuery[] = "DATE_FORMAT(".$val['fieldname'].",'%d.%m.%Y') ".$val['fieldname'];
				$ListMemberNames[] = $val['name_e'];
			}
			else
			{
				$ListMembers[] = $val['fieldname'];
				$ListMembersTypes[] = $val['addoptions'];
				$ListMembersQuery[] = $val['fieldname'];
				$ListMemberNames[] = $val['name_e'];
			}
			$ListMembersInputTypes[] = $val['InputType'];
		}

		if ($val['addoptions'] == 'parent')
		{
			$ParentField = $val['fieldname'];
		}

		if ($val['sortoptions'] != "")
		{
			$query = "select vquery from bcms_views where tablename = '".$val['stable']."'";
			$sql->query($query);
			$View = $sql->fetchAssoc();

			if ($View['vquery'] != "")
			{
				$query = $View['vquery'];
			}
			else
			{
				$query = "Select ".$val['idField'].",".$val['idValue'].",".$val['idOrder']." from ".$val['stable'];
				if ($val['stable'] == 'bcms_resources')
				{
					$query .= " where agent =  ".$_SESSION['agentid'];
				}
			}
			$sql->query($query);
			$SelBoxVal = $sql->fetchAll();

			$SortSelectBox .= "<td class=SortName><b>".$val['name_e'].":</b></td><td><select name=".$val['fieldname']." class='sort' id='".$val['fieldname']."fc' onchange=getListBySort(".$Section['id'].",this.value,'".$val['fieldname']."',".$blang.");>";
			$SortSelectBox .= "<option value=0>не сортировать</option>";
			
			if ($SortByParent == 1)
			{
				$NewSelBoxSort = array();
				foreach ($SelBoxVal as $SbID => $SbVal)
				{
					$NewSelBoxSort[$SbVal[$val['idOrder']]][$SbVal['id']] = $SbVal;
				}

				function GetParOptionsSort($arr,$ParStep)
				{
					global $NewSelBoxSort, $val,$SortSelectBox;
					$ParStep .= "---";
					foreach ($arr as $arrid => $arrval)
					{
						$SortSelectBox .= "<option value=".$arrid.">".$ParStep.substr($arrval[$val['idValue']],0,60)."</option>";
						if (isset($NewSelBoxSort[$arrid]))
						{
							GetParOptionsSort($NewSelBoxSort[$arrid],$ParStep);
						}
					}
				}
				$ParStep = "";
				foreach ($NewSelBoxSort[0] as $nsid => $nsval)
				{
					$SortSelectBox .= "<option value=".$nsid." style='background: #e4eaf2; color: #000;'>".substr($nsval[$val['idValue']],0,60)."</option>";
					//print_r($NewSelBox[$nsid]);
					if (isset($NewSelBoxSort[$nsid]))
					{
						GetParOptionsSort($NewSelBoxSort[$nsid],$ParStep);
					}
				}
			}
			else
			{
				foreach ($SelBoxVal as $SbID => $SbVal)
				{
					$SortSelectBox .= "<option value=".$SbVal[$val['idField']].">".$SbVal[$val['idValue']]."</option>";
				}
			}
			//echo $SortSelectBox;
			$SortSelectBox .= "</select></td>";
			
			if ($val['stable'] == 'bcms_lang')
			{
				foreach ($SelBoxVal as $SbID => $SbVal)
				{
					if ($blang == $SbVal[$val['idField']])
					{
						$LangLinks .= " <b>• ".$SbVal[$val['idValue']]."</b>&nbsp;";
					}
					else
					{
						$LangLinks .= " • <a href='formbuilder.php?mid=".$_GET['mid']."&blang=".$SbVal[$val['idField']]."'>".$SbVal[$val['idValue']]."</a>&nbsp;";
					}
				}
				$SortSelectBox ="";
				$LangAddQuery = " lang = ".$blang." ";
			}
		}
		$ListMemberChild[$id] = $val['comment_e'];
	}
	if (isset($DynamicForms))
	{
		//print_r($DynamicForms);
		foreach ($DynamicForms as $dId => $dVal)
		{
			$DynFieldNameArr[] = $dVal[0];
			$DynFieldValsArr[] = $dVal[1];
		}
		$DynFieldName = implode("<s>",$DynFieldNameArr);
		$DynFieldVals = implode("+'<s>'+",$DynFieldValsArr);
		$JavaProccVal .= 'var MyValueList = '.$DynFieldVals.';';
		$JavaProccVal .= 'SetDynamicValues("'.$DynFieldName.'",MyValueList,"'.$Section['tablename'].'",newArray[1]);';
		//$JavaProccVal .= 'SetDynamicValues("'.$DynFieldName.'","aa"'.');';
	}

	if ($UnderSectionRowsCount > 0)
	{
		foreach ($UnderSection as $usind => $usval)
		{
			$ListMemberNames[] = $usval['name_e'];
			//$ListMembers[] = "<a href=formbuilder.php?mid=".MyPiCrypt($usval['menu_id'])."&pmid=".MyPiCrypt($usval['parent_id']).">".$usval['name_e']."</a>";
			$ListMembers[] = "mid_path_link";
			$ListMembersQuery[] = "cast('".MyPiCrypt($usval['MenuId'])."' as char) mid_path_link";
		}
	}
	$RowsInPage = 100;

	#<---------PageList
	$query = "Select count(*) as RowsCount from ".$Section['tablename']." t";
	if (isset($_GET['cid']) and isset($ParentField))
	{
		$query .= " where ".$ParentField." = ".MyPiDeCrypt($_GET['cid']);
		if (isset($LangAddQuery))
		{
			$query .= " AND ".$LangAddQuery;
		}
	}

	if (isset($LangAddQuery))
	{
		$query .= " WHERE ".$LangAddQuery;
	}

	if (isset($_GET['setconst']))
	{
		$ConstantArr = explode(",",$_GET['setconst']);
		foreach ($ConstantArr as $id => $val)
		{

			if (isset($_COOKIE[$val]) and $_COOKIE[$val] != "")
			{
				$query .= " and ".$val." = ".$_COOKIE[$val];
			}
			else
			{
				$query .= " and ".$val." = 0";
			}

		}

	}

	if (isset($ParentNode))
	{
		$UpLink = "";
		$Parent = isset($_GET['parent']) ? $_GET['parent'] : 0;
		$query .= " where parent = ".$ParentNode;
		$UpLink = '<a href="formbuilder.php?mid	='.$_GET['mid'].'&parent='.getParent($Parent).'" targen=mainframe>Юкори даражага</a>';

		$ListMemberNames[] = $UpLink;
		$ListMembers[] = 'nodecount';
		$ListMembersQuery[] = "parent,(select count(*) from ".$Section['tablename']." where parent = t.id) nodecount ";
	}

	$sql->query($query);

	$result = $sql->fetchAssoc();
	$RowsCount = $result['RowsCount'];
	$MyPagesList = "";
	$CicleCount = 0;
	$LimitBegin = 0;
	$PagesCount = 0;
	while ($RowsCount > 0)
	{
		$CicleCount++;
		$PagesCount++;
		$MyPagesList .= "<span>&nbsp;<a href='#' class='PageList' onclick=getListBySort(".$Section['id'].",0,'".$LimitBegin.",".$RowsInPage."',".$blang.");>".$CicleCount."</a>&nbsp;</span>";
		if ($PagesCount == 30)
		{
			$MyPagesList .= "<br>";
			$PagesCount = 0;
		}

		$RowsCount -=$RowsInPage;
		$LimitBegin += $RowsInPage;
	}
	#PageList--------->
	/*print_r($ListMembersQuery);
	die();*/

	//print_r($TheFieldsArr);
	/*foreach ($Fields as $fkey => $TheFieldVal) {
		if 
	}*/

	
	$query = "Select id,".implode($ListMembersQuery,",")." from ".$Section['tablename']." t";
	//echo "<br>";
	if (isset($_GET['cid']) and isset($ParentField))
	{
		$query .= " where ".$ParentField." = ".MyPiDeCrypt($_GET['cid']);
		if (isset($LangAddQuery))
		{
			$query .= " AND ".$LangAddQuery;
		}
	}
	if (isset($LangAddQuery))
	{
		$query .= " WHERE ".$LangAddQuery;
	}
	if (isset($_GET['names']))
	{
		$addNamesArr = explode(",",$_GET['names']);
		$addValuesArr = explode(",",$_GET['values']);
		$JavaSetValues = "";
		foreach ($addNamesArr as $addId =>$addVal)
		{
			$JavaSetValues .= "if (el=document.getElementById('".$addVal."fc')){el.value = '".$addValuesArr[$addId]."';}";
			if (isset($LangAddQuery))
			{
				$query .= " AND ".$addVal." = ".$addValuesArr[$addId];
			}
			else
			{
				$query .= " WHERE ".$addVal." = ".$addValuesArr[$addId];
			}
		}
	}
	if (strpos($query,"WHERE") == "")
	{
		$query .= " WHERE 0=0 ";
	}
	if ($SetUserIdAddQuery != "")
	{
		if (isset($LangAddQuery))
		{
			$query .= " AND ".$SetUserIdAddQuery;
		}
		else
		{
			$query .= " AND ".$SetUserIdAddQuery;
		}
	}

	$TitleAdd = "";
	//print_r($_COOKIE[session_id()]);
	$ThisCookie = $_COOKIE[session_id()];
	if (isset($ThisCookie['sortmenu']) && $ThisCookie['sortmenu'] != "0")
	{
		if (isset($ThisCookie['sortid']) && $ThisCookie['sortid']!=0)
		{
			if (isset($TheFieldsArr[$ThisCookie['sortby']]))	
			{
				$query .= " AND {$ThisCookie['sortby']} = {$ThisCookie['sortid']}";
			}
		}
	}

	if (isset($_GET['setconst']))
	{
		$ConstantArr = explode(",",$_GET['setconst']);
		foreach ($ConstantArr as $id => $val)
		{

			if (isset($_COOKIE[$val]) and $_COOKIE[$val] != "")
			{
				$query .= " and ".$val." = ".$_COOKIE[$val];
			}
			else
			{
				$smarty->assign(array(
				'MESSAGE' => $lang['CHOOSE_ID'][$val],
				'MESSAGE_TYPE' => 3,
				));

				$query .= " and ".$val." = 0";
			}

		}

		/*		switch ($_GET['setconst'])
		{
		case "lot":
		break;
		case "customer":
		$query .= " and customer = ".$_COOKIE['customer'];
		break;
		}
		*/

	}
	//echo $query;
	if ($_SESSION['login'] != "root")
	{
			if ($Section['tablename'] == 'bcms_admins')
			{
				$query .= " and username != 'root'";
			}

			if ($Section['tablename'] == 'bcms_roles')
			{
				$query .= " and id != 1";
			}
	}

	if (isset($ParentNode))
	{
		$query .= " and parent = ".$ParentNode;
	}


	if ($Section['ordfield'] != '')
	{
		$OrdCmd = ($Section['ordtype'] == 1) ? " asc" : " desc";
		$query .= " ORDER BY ".$Section['ordfield'].$OrdCmd;
	}
	else
	{
		$query .= " ORDER BY id desc";
	}

	$query .= " limit ".$RowsInPage;

	//echo $query;
	//die();
	$sql->query($query);
	$Rows = $sql->fetchAll();

	//echo $JavaProccVal;
	if (isset($couplesArrUnset))
	{
		foreach ($couplesArrUnset as $uid => $uval)
		{
			unset($Fields[$uid]);
			unset($TheField[$uid]);
			unset($TheFielde[$uid]);
		}
	}

	$sql->query("select * from bcms_system");
	$sql->fetchAssoc();

	$sql->query("select * from bcms_system");
	$sql->fetchAssoc();

	//echo $Section['tablename'];
	$smarty->assign(array(
	'Section'		=>$Section,
	'Fields'		=>$Fields,
	'TheField'		=>$TheField,
	'TheFielde'		=>$TheFielde,
	'TheFieldd'		=>$TheFieldd,
	'SHOWDIALOG'	=>1,
	'PageTitle'		=>$Section['name1'].$TitleAdd,
	'PageIcon'		=>(isset($lang[str_replace("test_","",$Section['tablename'])])) ? $lang[str_replace("test_","",$Section['tablename'])] : "main.png",
	'ContentRows'	=>(count($Rows) > 0) ? $Rows : "",
	'ListMembers'	=>(count($ListMemberNames) > 0) ? $ListMemberNames : "",
	'ListMember'		=>(count($ListMembers) > 0) ? $ListMembers : "",
	'ListMembersTypes'	=>(count($ListMembersTypes) > 0) ? $ListMembersTypes : "",
	'ListMemberChild'	=> $ListMemberChild,
	'ListMembersInputTypes'	=> $ListMembersInputTypes,
	'JavaProccVal'	=>$JavaProccVal,
	'JavaProccVald'	=>$JavaProccVald,
	'JavaSetValues'	=>$JavaSetValues,
	//'JavaSetValues'	=>$JavaSetAddValues,
	'SortSelectBox'	=>$SortSelectBox,
	'LangLinks'		=>$LangLinks,
	'MyPagesList'	=>$MyPagesList,
	'addUrl'		=>isset($addUrl) ? $addUrl : "",
	'addUrlForm'	=>isset($addUrlForm) ? $addUrlForm : "",
	'isDate'		=>isset($Time) ? 1 : 0,
	'elTRE'			=>isset($elTRE) ? 1 : 0,
	'isDate'		=>isset($isDate) ? 1 : 0,
	));
}
$smarty->assign("base", $smarty->fetch("base.tpl"));
$smarty->assign("bottom", $smarty->fetch("bottom.tpl"));
$smarty->display("formbuilder.tpl");
?>