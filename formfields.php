<?
/****************************************************************
*                           formfields.php			 								*
*                          -------------------			  					*
*     begin                : 01.01.2010 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

header("If-Modified-Since: ".gmdate("D, d M Y H:i:s", time()-43200)." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s", time()+43200)." GMT"); // Дата протухания (через 12 часов)
header("Cache-Control: private");

define('ARM_IN', true);
include("includes/all_includes.php");

$FormTypeId = isset($_GET['form_id']) ? MyPiDeCrypt($_GET['form_id']) : 0;

$query = "Select * from bcms_forms where id = ".$FormTypeId;
$sql->query($query);
$Result = $sql->fetchAssoc();


if (isset($_POST['ActType']))
{
	switch ($_POST['ActType'])
	{
		case "enter": // Insert
		$FieldsArr  = array('name_e','comment_e','fieldname','InputType','width','height','priority','stable','idField','idValue','sqltype','sqllen','addoptions','ListMember','sortoptions');
		$FieldsType = array('t',     't',        't',        't',        'n',    'n',     'n',       't',     't',      't',      't',      'n',     't',         'n',         't');

		if (count($_POST['fieldname']) > 0)
		{
			$CycleCount = (count($_POST['fieldname']) == 1) ? count($_POST['fieldname']) : count($_POST['fieldname']);
		}
		else
		{
			$CycleCount = 0;
		}
		for ($i = 0; $i < $CycleCount; $i++)
		{
			$InsertFields = "(".$FormTypeId.",";
			foreach ($FieldsArr as $fId => $fVal)
			{
				switch ($FieldsType[$fId])
				{
					case "t":
						$InsertFields .= (isset($_POST[$fVal][$i])) ? "'".$_POST[$fVal][$i]."'" : "''";
						break;
					case "n":
						$InsertFields .= (isset($_POST[$fVal][$i])) ? (($_POST[$fVal][$i] != "") ? $_POST[$fVal][$i] : 0) : "0";
						break;
				}
				$InsertFields .= ($fVal == 'sortoptions') ? "" : ",";
			}
			$InsertFields .= ")";
			$FieldNames = implode($FieldsArr,",");
			$queries[$i] = "INSERT INTO bcms_fields (form_id,".$FieldNames.") VALUES ".$InsertFields;

			$FildType = GetFieldType($_POST['sqltype'][$i],$_POST['sqllen'][$i],$_POST['addoptions'][$i]);
			$querySql[$i] = "ALTER TABLE `".$Result['tablename']."` ADD `".$_POST['fieldname'][$i]."` ".$FildType;
		}

		if (count($queries) > 0)
		{
			foreach ($queries as $qId => $qVal)
			{
				$sql->query($qVal);
				if ($sql->error() != "")
				{
					$SQLError[] = $sql->error();
				}
			}

		}

		$MessErr="";
		if (!isset($_POST['AddToBase']))
		{
			$primaryKey = GetPrimaryKey($_POST['fieldname'],$_POST['addoptions']);
			$CreateQuery = "CREATE TABLE  `".$Result['tablename']."` (";
			foreach ($_POST['fieldname'] as $id => $val)
			{
				$FildType = GetFieldType($_POST['sqltype'][$id],$_POST['sqllen'][$id],$_POST['addoptions'][$id]);

				if ($primaryKey == "")
				{
					$lSymbol = (count($_POST['fieldname'])-1 == $id) ? "" : ",";
				}
				else
				{
					$lSymbol = ",";
				}

				$CreateQuery .= "`".$val."` ".$FildType.$lSymbol;
			}

			$CreateQuery .= $primaryKey;
			$CreateQuery .= ")  ENGINE=InnoDB DEFAULT CHARSET=cp1251;";

			$query = $CreateQuery;
			$sql->query($query);
			$sqlCreateErr = $sql->error();
		}
		else
		{
			if (count($querySql) > 0)
			{
				foreach ($querySql as $qsId => $qsVal)
				{
					$sql->query($qsVal);
					if ($sql->error() != "")
					{
						$sqlCreateErr[] = $sql->error();
					}
				}

			}
		}

		if (isset($SQLError))
		{
			$MessErr = implode("<li>",$SQLError);
		}
		if (isset($sqlCreateErr))
		{
			$MessErr .= (is_array($sqlCreateErr)) ? implode("<li>",$sqlCreateErr) : $sqlCreateErr;
		}

		$smarty->assign(array(
		'MESSAGE' => $MessErr != "" ? $MessErr : $lang['FIELD_ADD_SUCCESS'],
		'MESSAGE_TYPE' => 1,
		));

		break;

		case "edit":
			// Insert
			$FieldsArr  = array('name_e','comment_e','fieldname','InputType','width','height','priority','stable','idField','idValue','sqltype','sqllen','addoptions','ListMember','ChildField','sortoptions','idParent','idOrder','doubleoptions','coupleoptions');
			$FieldsType = array('t',     't',        't',        't',        'n',    'n',     'n',       't',     't',      't',      't',      'n',     't',         'n',		   'n',		    't',           't',      't',      't',            't');

			if (count($_POST['fieldname']) > 0)
			{
				$CycleCount = (count($_POST['fieldname']) == 1) ? count($_POST['fieldname']) : count($_POST['fieldname']);
			}
			else
			{
				$CycleCount = 0;
			}
			for ($i = 0; $i < $CycleCount; $i++)
			{
				$InsertFields = "";
				foreach ($FieldsArr as $fId => $fVal)
				{
					$InsertFields .= $fVal." = ";
					switch ($FieldsType[$fId])
					{
						case "t":
							$InsertFields .= (isset($_POST[$fVal][$i])) ? "'".$_POST[$fVal][$i]."'" : "''";
							break;
						case "n":
							$InsertFields .= (isset($_POST[$fVal][$i])) ? (($_POST[$fVal][$i] != "") ? $_POST[$fVal][$i] : 0) : "0";
							break;
					}
					$InsertFields .= ($fVal == 'coupleoptions') ? "" : ",";
				}
				$FieldNames = implode($FieldsArr,",");
				$queries[$i] = "UPDATE bcms_fields SET ".$InsertFields." WHERE id = ".$_POST['idfield'][$i];
				//echo "<br>";

				$FildType = GetFieldType($_POST['sqltype'][$i],$_POST['sqllen'][$i],$_POST['addoptions'][$i]);
				$querySql[$i] = "ALTER TABLE `".$Result['tablename']."` CHANGE `".$_POST['fieldname_old'][$i]."` `".$_POST['fieldname'][$i]."` ".$FildType;
				//ALTER TABLE `cms_memb` CHANGE `login` `login` VARCHAR( 32 ) DEFAULT NULL
			}
			//die();
			if (count($queries) > 0)
			{
				foreach ($queries as $qId => $qVal)
				{
					$sql->query($qVal);
					if ($sql->error() != "")
					{
						$SQLError[] = $sql->error();
					}
				}
			}
			$sql->query("SHOW TABLES");
			$Tables = $sql->fetchAll();
			$TableCreated = 0;
			foreach ($Tables as $TabInd => $TabVal)
			{
				if ($TabVal['Tables_in_'.SYSTEM_BASE] == $Result['tablename'])
				{
					$TableCreated = 1;
				}
			}
			if ($TableCreated == 0)
			{

				$primaryKey = GetPrimaryKey($_POST['fieldname'],$_POST['addoptions']);
				$CreateQuery = "CREATE TABLE  `".$Result['tablename']."` (";
				foreach ($_POST['fieldname'] as $id => $val)
				{
					$FildType = GetFieldType($_POST['sqltype'][$id],$_POST['sqllen'][$id],$_POST['addoptions'][$id]);

					if ($primaryKey == "")
					{
						$lSymbol = (count($_POST['fieldname'])-1 == $id) ? "" : ",";
					}
					else
					{
						$lSymbol = ",";
					}

					$CreateQuery .= "`".$val."` ".$FildType.$lSymbol;
				}

				$CreateQuery .= $primaryKey;
				$CreateQuery .= ")  ENGINE=InnoDB DEFAULT CHARSET=cp1251;";

				$query = $CreateQuery;
				$sql->query($query);
				$sqlCreateErr = $sql->error();
			}

			if ($sql->error() != "")
			{
				$SQLError[] = $sql->error();
			}

			if (count($querySql) > 0)
			{
				foreach ($querySql as $qsId => $qsVal)
				{
					$sql->query($qsVal);
					if ($sql->error() != "")
					{
						echo $qsVal;
						echo "<br><br>";
						$sqlCreateErr[] = $sql->error();
					}
				}
			}
			$MessErr = "";
			if (isset($SQLError))
			{
				$MessErr = implode("<li>",$SQLError);
			}
			if (isset($sqlCreateErr))
			{
				$MessErr .= (is_array($sqlCreateErr)) ? implode("<li>",$sqlCreateErr) : $sqlCreateErr;
			}

			$smarty->assign(array(
			'MESSAGE' => $MessErr != "" ? $MessErr : $lang['FIELD_EDIT_SUCCESS'],
			'MESSAGE_TYPE' => 2,
			));
			break;



		case "delete":
			$query = "SHOW COLUMNS FROM ".$Result['tablename'];
			$sql->query($query);
			$FieldCount = $sql->numRows();

			if ($FieldCount == 1)
			{
				$querySql = "DROP TABLE `".$Result['tablename']."`";
				$sql->query($querySql);
				$SQLDelErr = $sql->error();
			}
			else
			{
				$querySql = "ALTER TABLE `".$Result['tablename']."` DROP `".$_POST['fieldname_old'][0]."`";
				$sql->query($querySql);
				$SQLDelErr = $sql->error();
			}

			if ($SQLDelErr == "")
			{
				$query = "DELETE from bcms_fields where id = ".$_POST['idfield'][0];
				$sql->query($query);
				$fielDelErr = $sql->error();
			}


			$MessErr = $fielDelErr.$SQLDelErr;

			$smarty->assign(array(
			'MESSAGE' => $MessErr != "" ? $MessErr : $lang['FIELD_DEL_SUCCESS'],
			'MESSAGE_TYPE' => 3,
			));
			break;
	}

}


$query = "SELECT * FROM bcms_fields where form_id = ".$FormTypeId." order by id";
$sql->query($query);
$FieldList = $sql->fetchAll();
$FieldCount = $sql->numRows();
$query = "SHOW TABLES FROM ".SYSTEM_BASE;
$sql->query($query);
$TableList = $sql->fetchAll();
$FieldTypes = array('text','textarea','html','select','date','radio','checkbox','file','hidden','password','submit','reset','button','image');
$SQLTypes = array('INTEGER','VARCHAR','TINYTEXT','TEXT','DATE','DATETIME','TIMESTAMP','TIME','MEDIUMTEXT','LONGTEXT','FLOAT');
$AddOptions = array('multiple','auto_inc','parent','parent & child','child','dynamic','setUser','FcEditor','HTMLArea','elRTE','OneColumn','OneCol & All','Money','SysDate','Anchor','Fields');
$SortOptions = array('sort1','sort2','sort3');
$DoubleOptions = array('1','2','3','4','5','6','7','8','9','10');
//$SortOptions = array('sort1','sort2','sort3','double1','double2','double3','double4','double5','double6','double7','double8','double9','double10');

if ($Result['id'] != "")
{
	$showDialog =1;
	$smarty->assign(array(
	'PageTitle'			=> "<font color=525252>".$lang['FORMS']."</font> / ".$Result['name1'],
	'SHOWDIALOG'		=>	$showDialog,
	'FieldTypes'		=>	$FieldTypes,
	'TableList'			=>	$TableList,
	'SQLTypes'			=>	$SQLTypes,
	'AddOptions'		=>	$AddOptions,
	'SortOptions'		=>	$SortOptions,
	'DoubleOptions'		=>	$DoubleOptions,
	'FieldList'		=>	(isset($FieldList)) ? $FieldList : "",
	'DELETING'		=>	$lang['DELETING'],
	'VIEWING'		=>	$lang['VIEWING'],
	'EDITING'		=>	$lang['EDITING'],
	'ADDING'		=>	$lang['ADDING'],
	'FieldCount'	=>	$FieldCount,
	'FieldCount'	=>	$FieldCount,
	'TablesInBase'	=>	'Tables_in_'.SYSTEM_BASE,
	));
}
$smarty->assign("base", $smarty->fetch("base.tpl"));
$smarty->assign("bottom", $smarty->fetch("bottom.tpl"));
$smarty->display("formfields.tpl");
?>