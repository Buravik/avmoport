<?php
/****************************************************************
*                           		staff.php				 								*
*                          -------------------			  					*
*     begin                : 14.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

define('ARM_IN', true);
include("includes/all_includes.php");

$slang =3;
$Action = isset($_GET['act']) ? $_GET['act'] : "view";
$sDate = (isset($_POST['subdate'])) ? $_POST['subdate'] : date('d.m.Y');

$sql->query('SELECT name3 name, keyword from bcms_s_dictionary');
$Dictionary = $sql->fetchAll();

foreach ($Dictionary as $id => $value)
{
	$Dict[$value['keyword']] = $value['name'];
}
$Access	= $_SESSION['objects'];
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		'PageTitle'		=> $Dict['staff'],
		'Dict'			=> $Dict,
		'Access'		=> $_SESSION['objects'],		
));

$MenuId = 69;
if (!isset($_SESSION['roles'][$MenuId]))
{
	print "<script> location.href = 'main.php'; </script>";
	exit;
}

//print_r($Access);
if (!isset($_GET['act']))
{
	if (isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		$Action = "view";
	}	
	elseif (!isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		$Action = "departments";
		$RegionId = $_SESSION['region_dep']; 
	}
	elseif (!isset($Access['hr']) && !isset($Access['hrr']) && isset($Access['hrd']))
	{
		$Action = "schools";
		$DCId = $_SESSION['distcity_dep'];
 	}
}
else
{
	if (isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		if ($Action == "departments")
		{
			$RegionId = MyPiDeCrypt($_GET['rid']); 
		}
		if ($Action == "schools")
		{
			$DCId = MyPiDeCrypt($_GET['dcid']); 
		}
	}	
	elseif (!isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		if ($Action == "departments")
		{
			$RegionId = $_SESSION['region_dep']; 
		}
		if ($Action == "schools")
		{
			$DCId = MyPiDeCrypt($_GET['dcid']); 
		}

	}
	elseif (!isset($Access['hr']) && !isset($Access['hrr']) && isset($Access['hrd']))
	{
		if ($Action == "schools")
		{
			$DCId = MyPiDeCrypt($_GET['dcid']);
		}
	}
}
//role settings
switch ($Action)
{
	case "view":
		if (!isset($Access['hr']))
		{
			print "<script> location.href = 'main.php'; </script>";
			exit;
		}
		$MyQuery = "SELECT id, region, distcity, name{$slang} name,
					(SELECT COALESCE(SUM(scount),0) FROM v_today_staff_count WHERE region = t.region) scount,
					(SELECT COALESCE(SUM(scount),0) FROM v_staff_count WHERE region = t.region) scount_all
					FROM port_departments t WHERE distcity = 0";
		$sql->query($MyQuery);

		$Departments = $sql->fetchAll();

		$smarty->assign(array(
		'Departments'	=> $Departments
		));
	break;
	
	case "departments":
		if (!isset($Access['hrr']))
		{
			print "<script> location.href = 'main.php'; </script>";
			exit;
		}

		$query = "SELECT d.id did, d.`name{$slang}` dname FROM port_departments d 
						WHERE d.region = ".$RegionId." and distcity = 0";
		$sql->query($query);
		$HeadDepartment = $sql->fetchAssoc();

		/*$MyQuery = "SELECT id, region, distcity, name{$slang} name,
					(SELECT COUNT(*) FROM port_staff WHERE work_place_edu = t.id AND work_place_school = 0) scount 
					FROM port_departments t WHERE region = {$RegionId} and distcity != 0";*/
		$MyQuery = "SELECT id, region, distcity, name{$slang} name,
					(SELECT COALESCE(SUM(scount),0) FROM v_today_staff_count WHERE distcity = t.distcity) scount,
					(SELECT COALESCE(SUM(scount),0) FROM v_staff_count WHERE distcity = t.distcity) scount_all
					FROM port_departments t WHERE region = {$RegionId} and distcity != 0";
		$sql->query($MyQuery);

		$Departments = $sql->fetchAll();
	
		$smarty->assign(array(
		'HeadDepartment'	=> $HeadDepartment,
		'Departments'	=> $Departments,
		'HeadLinks'	=> HeadLinks($Action, $RegionId, 1)
		));
	break;
	
	case "schools":
		if (!isset($Access['hrd']))
		{
			print "<script> location.href = 'main.php'; </script>";
			exit;
		}

		$MyQuery = "SELECT id,name1 name FROM `port_s_citydist` WHERE id = $DCId";
		$sql->query($MyQuery);
		$HeadDepartment = $sql->fetchAssoc();

		$MyQuery = "SELECT t.id, t.school_number, t.school_name, st.name3 stype,
					(SELECT COUNT(*) FROM port_staff WHERE work_place_edu = 0 AND work_place_school = t.id) scount 
					FROM port_schools t 
					LEFT JOIN `port_s_school_types` st ON st.id = t.school_type
					WHERE t.`distcity`= {$DCId}";
		$sql->query($MyQuery);
		$Schools = $sql->fetchAll();
	
		$smarty->assign(array(
		'Schools'			=> $Schools,
		'HeadDepartment'	=> $HeadDepartment,
		'HeadLinks'			=> HeadLinks($Action, $DCId, 1)
		));
	break;
	
	case "staff":
	$GroupId = MyPiDeCrypt($_GET['did']);
	$SysMessage = "";

	if (isset($_POST['SubDel']))
	{
		$StaffId = MyPiDeCrypt($_POST['staffid']);
		$query = "delete from port_staff where id = {$StaffId}";
		$sql->query($query);
	}

	$query = "SELECT t.id, t.`region`, t.`distcity`, t.`school_number`, t.`school_name`,t.`school_type`, st.name{$slang} stypename
				FROM port_schools t
				LEFT JOIN port_s_school_types st ON st.id = t.`school_type`
				WHERE t.id = ".$GroupId;
	$sql->query($query);
	$School = $sql->fetchAssoc();

	$sql->query("SELECT id,name1 name FROM `port_s_nations`");
	$Nations = $sql->fetchAll();

	$sql->query("SELECT id,name1 name FROM `port_s_genders`");
	$Genders = $sql->fetchAll();
		
	$sql->query("SELECT id,name1 name FROM `port_s_regions`");
	$Regions = $sql->fetchAll();
		
	if (isset($School['distcity']))
	{
		$sql->query("SELECT id,name1 name FROM `port_s_citydist` where id = ".$School['distcity']);
		$CityDists = $sql->fetchAll();

		$sql->query("SELECT s.id, s.school_number, st.`name1` school_type FROM `port_schools` s
					LEFT JOIN `port_s_school_types` st ON st.id = s.`school_type`
					WHERE s.distcity = ".$School['distcity']);
		$Schools = $sql->fetchAll();
	}

	$sql->query("SELECT id,name1 name FROM `port_s_univers`");
	$Univers = $sql->fetchAll();

	$query = "SELECT t.id, t.lastname, t.firstname, t.surname, DATE_FORMAT(t.birthdate,'%d.%m.%Y') birthdate, t.last_qual_year, mo_certificat_no, c.`name3` qual_center, g.`name3` gender,
u.`name3` grad_univer, `dip_expertise`, `dip_speciality`, p.`name3` position
FROM `port_staff` t 
LEFT JOIN port_qual_centers c ON c.`id` = t.last_qual_place
LEFT JOIN port_s_genders g ON g.`id` = t.gender
LEFT JOIN port_s_univers u ON u.`id` = t.grad_univer
LEFT JOIN test_s_positions p ON p.id = t.`position`
where work_place_school = {$GroupId} ORDER BY t.position";

	/*echo $query = "SELECT gs.*, s.`name` FROM test_students gs
				LEFT JOIN psych_staff s ON s.`id` = gs.staff_id
				where gs.status ".$StaffSCmd." and gs.sgroup = ".$GroupId;*/
	$sql->query($query);
	$Students = $sql->fetchAll();
	$sql->error();

	$sql->query("SELECT id,name1 name FROM `test_s_positions`");
	$Positions = $sql->fetchAll();
	
	$sql->query("SELECT id,name1 name FROM `port_qual_centers`");
	$QualCenters = $sql->fetchAll();

	$sql->query("SELECT id,name1 name FROM `port_s_classifications`");
	$Classifications = $sql->fetchAll();
	
	$smarty->assign(array(
	'HeadDepartment'=> $School,
	'SysMessage' 		=> isset($_GET['sysmess']) ? base64_decode($_GET['sysmess']) : "",
	'MessType' 			=> isset($_GET['messtype']) ? $lang['MESS_TYPES'][$_GET['messtype']] : "notice",
	'GroupId'	 		=> $GroupId,
	'Students'	  		=> $Students,
	'Nations'			=> $Nations,
	'Genders'			=> $Genders,
	'Regions'			=> $Regions,
	'CityDists'			=> isset($CityDists) ? $CityDists : array(),
	'Univers'			=> $Univers,
	'Positions'			=> $Positions,
	'Schools'			=> isset($Schools) ? $Schools : array(),
	'QualCenters'		=> $QualCenters,
	'Classifications'	=> $Classifications,
	'isDate'			=> 1,
	'isTabs'			=> 1,
	'Today'				=> date('d.m.Y'),
	'HeadLinks'			=> HeadLinks($Action, $GroupId, 1)
	));
		
	$smarty->assign(array(
		'PageIcon'		=> "groups.png",
	));
break;

/*---------------Search-------------*/

	case "search":
	$SysMessage = "";
	
	if (isset($_POST['SubSearch']))
	{
		$query = "SELECT t.id, t.lastname, t.firstname, t.surname,t.work_place_school, DATE_FORMAT(t.birthdate,'%d.%m.%Y') birthdate, t.last_qual_year, mo_certificat_no, c.`name3` qual_center, g.`name3` gender,
u.`name3` grad_univer, `dip_expertise`, `dip_speciality`, p.`name3` position
FROM `port_staff` t 
LEFT JOIN port_qual_centers c ON c.`id` = t.last_qual_place
LEFT JOIN port_s_genders g ON g.`id` = t.gender
LEFT JOIN port_s_univers u ON u.`id` = t.grad_univer
LEFT JOIN test_s_positions p ON p.id = t.`position`
where 0=0";
		
		$Condition = 0;
		if ($_POST['lastname'] != "")
		{
			$Condition++;
			$query .= " and t.lastname = '".$_POST['lastname']."'";
		}
		if ($_POST['firstname'] != "")
		{
			$Condition++;
			$query .= " and t.firstname = '".$_POST['firstname']."'";
		}	
		if ($_POST['surname'] != "")
		{
			$Condition++;
			$query .= " and t.middlename = '".$_POST['surname']."'";
		}
		if ($_POST['passport_cer'] != "")
		{
			$Condition++;
			$query .= " and t.passport_cer = {$_POST['passport_cer']}";
		}
		if ($_POST['passport_num'] != "")
		{
			$Condition++;
			$query .= " and t.passport_num = {$_POST['passport_num']}";
		}
		
		if ($Condition == 0)
		{
			$query .= " limit 100";
			$SysMessage	= "Qidiruv maydonlarini to'ldiring";
			$MessType	= "error";
		}

		$sql->query($query);
		$Students = $sql->fetchAll();
		$sql->error();	

		if ($sql->numRows() == 0)
		{
			if ($SysMessage == "")
			{
				$SysMessage	= "Siz ko'rsatgan ma'lumotlar bo'yicha o'quvchi topilmadi.";
				$MessType	= "error";
			}
		}
	}
	else
	{
		$query = "SELECT t.id, t.lastname, t.firstname, t.surname,t.work_place_school, DATE_FORMAT(t.birthdate,'%d.%m.%Y') birthdate, t.last_qual_year, mo_certificat_no, c.`name3` qual_center, g.`name3` gender,
u.`name3` grad_univer, `dip_expertise`, `dip_speciality`, p.`name3` position
FROM `port_staff` t 
LEFT JOIN port_qual_centers c ON c.`id` = t.last_qual_place
LEFT JOIN port_s_genders g ON g.`id` = t.gender
LEFT JOIN port_s_univers u ON u.`id` = t.grad_univer
LEFT JOIN test_s_positions p ON p.id = t.`position`
order by id desc limit 200";

		$sql->query($query);
		$Students = $sql->fetchAll();
		$SysMessage	= "Oxirgi kiritilgan 200 xodim ro'yxati";
		$MessType	= "notice";
	}

	/*echo $query = "SELECT gs.*, s.`name` FROM test_students gs
				LEFT JOIN psych_staff s ON s.`id` = gs.staff_id
				where gs.status ".$StaffSCmd." and gs.sgroup = ".$GroupId;*/

	$smarty->assign(array(
	'SysMessage' 	=> isset($SysMessage) ? $SysMessage : "",
	'MessType' 	=> isset($MessType) ? $MessType : "notice",
	'Students'	  	=> $Students,
	));
		
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		));
		
break;
/*---------------Search-------------*/



}
$smarty->assign(array(
		'Action'		=> $Action,
));

$smarty->display("staff.tpl");
?>