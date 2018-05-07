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

$Action = isset($_GET['act']) ? $_GET['act'] : "rep1";
$sDate = (isset($_POST['subdate'])) ? $_POST['subdate'] : date('d.m.Y');

$sql->query('SELECT name'.$slang.' name, keyword from bcms_s_dictionary');
$Dictionary = $sql->fetchAll();
$Access	= $_SESSION['objects'];
foreach ($Dictionary as $id => $value)
{
	$Dict[$value['keyword']] = $value['name'];
}

//echo $Action;
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		'PageTitle'		=> $Dict['reports'],
		'Access'			=> $_SESSION['objects'],
		'Dict'				=> $Dict));


if (!isset($_GET['act']))
{
	if (isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		$Action = "rep1";
	}	
	elseif (!isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		$Action = "rep2";
		$RegionId = $_SESSION['region_dep']; 
	}
	elseif (!isset($Access['hr']) && !isset($Access['hrr']) && isset($Access['hrd']))
	{
		$Action = "rep3";
		$DCId = $_SESSION['distcity_dep'];
 	}
}
else
{
	if (isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		if ($Action == "rep2")
		{
			echo $RegionId = MyPiDeCrypt($_GET['rid']); 
		}
		if ($Action == "rep3")
		{
			$DCId = MyPiDeCrypt($_GET['dcid']); 
		}
	}	
	elseif (!isset($Access['hr']) && isset($Access['hrr']) && isset($Access['hrd']))
	{
		if ($Action == "rep2")
		{
			$RegionId = $_SESSION['region_dep']; 
		}
		if ($Action == "rep3")
		{
			$DCId = MyPiDeCrypt($_GET['dcid']); 
		}

	}
	elseif (!isset($Access['hr']) && !isset($Access['hrr']) && isset($Access['hrd']))
	{
		if ($Action == "rep3")
		{
			$DCId = MyPiDeCrypt($_GET['dcid']);
		}
	}
}
//role settings
switch ($Action)
{
	case "rep1":

	$query = "SELECT r.`name1` regionname, s.`region`, COUNT(*) scount ,
			(SELECT COUNT(*) FROM port_schools ps WHERE ps.region = s.region) school_count
			FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			LEFT JOIN port_s_regions r ON r.`id` = s.`region`
			GROUP BY s.`region`";
	$sql->query($query);
	$Reports1 = $sql->fetchAll();

	foreach ($Reports1 as $rkey1 => $Rep1) {
		$Results1[$Rep1['region']]	= array($Rep1['regionname'],$Rep1['scount'],$Rep1['school_count']);
	}	
	
	$query = "SELECT s.`region`, s.`school_type`, COUNT(*) scount, 
				(SELECT COUNT(*) FROM port_schools ps WHERE ps.region = s.region AND ps.`school_type` = s.`school_type`) school_count
				FROM port_staff t
				LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
				GROUP BY s.`region`, s.`school_type`";
				
	$sql->query($query);
	$Reports2 = $sql->fetchAll();

	foreach ($Reports2 as $rkey2 => $Rep2) {
		$Results2[$Rep2['region']][$Rep2['school_type']]	= $Rep2['scount'];
	}	

	$query = "SELECT ps.region, ps.school_type, COUNT(*) school_count FROM port_schools ps 
				GROUP BY ps.region, ps.school_type	";

	$sql->query($query);
	$SchoolCounts = $sql->fetchAll();

	foreach ($SchoolCounts as $skey => $sCounts) {
		$Schools[$sCounts['region']][$sCounts['school_type']]	= $sCounts['school_count'];
	}	

	$query = "SELECT s.`region`, s.`school_type`, t.`position`, COUNT(*) scount FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			GROUP BY s.`region`, s.`school_type`, t.`position`";
	$sql->query($query);
	$Reports3 = $sql->fetchAll();

	foreach ($Reports3 as $rkey3 => $Rep3) {
		$Results3[$Rep3['region']][$Rep3['school_type']][$Rep3['position']]	= $Rep3['scount'];
	}	

	$query = "SELECT s.`school_type`, t.`position`, COUNT(*) scount
				FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			GROUP BY s.`school_type`, t.`position`";
	$sql->query($query);
	$Staffs = $sql->fetchAll();

	foreach ($Staffs as $stkey => $Staff) {
		$StaffTotal[$Staff['school_type']][$Staff['position']]	= $Staff['scount'];
	}	

	$query = "SELECT s.`school_type`, COUNT(*) scount, 
			(SELECT COUNT(*) FROM port_schools ps WHERE ps.`school_type` = s.`school_type`) school_count
			FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			GROUP BY s.`school_type`";
	$sql->query($query);
	$SchoolsCount = $sql->fetchAll();

	foreach ($SchoolsCount as $sckey => $School) {
		$SchoolTotal[$School['school_type']]	= array($School['school_count'], $School['scount']);
	}	

	$query = "SELECT id, name3 sname FROM port_s_school_types";
	$sql->query($query);
	$SchoolTypes = $sql->fetchAll();

	$query = "SELECT id, short_name sname FROM `test_s_positions`";
	$sql->query($query);
	$Positions = $sql->fetchAll();

  	$smarty->assign(array(
	'Results1'	=> $Results1,
	'Results2'	=> $Results2,
	'Results3'	=> $Results3,
	'Schools'	=> $Schools,
	'StaffTotal'	=> $StaffTotal,
	'SchoolTotal'	=> $SchoolTotal,
	'SchoolTypes'	=> $SchoolTypes,
	'Positions'		=> $Positions,
	'isDate'		=> 1,
	));
		
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		'Action'		=> $Action,
		));
break;

case "rep2":
	$query = "SELECT r.`name1` regionname, s.`distcity` region, COUNT(*) scount ,
			(SELECT COUNT(*) FROM port_schools ps WHERE ps.distcity = s.distcity) school_count
			FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			LEFT JOIN port_s_citydist r ON r.`id` = s.`distcity`
			where s.region = {$RegionId}
			GROUP BY s.`distcity`";
	$sql->query($query);
	$Reports1 = $sql->fetchAll();

	foreach ($Reports1 as $rkey1 => $Rep1) {
		$Results1[$Rep1['region']]	= array($Rep1['regionname'],$Rep1['scount'],$Rep1['school_count']);
	}	
	//print_r($Results1);

	$query = "SELECT s.`distcity` region, s.`school_type`, COUNT(*) scount, 
				(SELECT COUNT(*) FROM port_schools ps WHERE ps.distcity = s.distcity AND ps.`school_type` = s.`school_type`) school_count
				FROM port_staff t
				LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
				where s.region = {$RegionId}
				GROUP BY s.`distcity`, s.`school_type`";
				
	$sql->query($query);
	$Reports2 = $sql->fetchAll();

	foreach ($Reports2 as $rkey2 => $Rep2) {
		$Results2[$Rep2['region']][$Rep2['school_type']]	= $Rep2['scount'];
	}	

	$query = "SELECT ps.distcity region, ps.school_type, COUNT(*) school_count FROM port_schools ps 
			where ps.region = {$RegionId}
				GROUP BY ps.distcity, ps.school_type	";

	$sql->query($query);
	$SchoolCounts = $sql->fetchAll();

	foreach ($SchoolCounts as $skey => $sCounts) {
		$Schools[$sCounts['region']][$sCounts['school_type']]	= $sCounts['school_count'];
	}	

	$query = "SELECT s.`distcity` region, s.`school_type`, t.`position`, COUNT(*) scount FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			where s.region = {$RegionId}
			GROUP BY s.`distcity`, s.`school_type`, t.`position`";
	$sql->query($query);
	$Reports3 = $sql->fetchAll();

	foreach ($Reports3 as $rkey3 => $Rep3) {
		$Results3[$Rep3['region']][$Rep3['school_type']][$Rep3['position']]	= $Rep3['scount'];
	}	

	$query = "SELECT s.`school_type`, t.`position`, COUNT(*) scount
				FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			where s.region = {$RegionId}
			GROUP BY s.`school_type`, t.`position`";
	$sql->query($query);
	$Staffs = $sql->fetchAll();

	foreach ($Staffs as $stkey => $Staff) {
		$StaffTotal[$Staff['school_type']][$Staff['position']]	= $Staff['scount'];
	}	

	$query = "SELECT s.`school_type`, COUNT(*) scount, 
			(SELECT COUNT(*) FROM port_schools ps WHERE ps.region = s.region and ps.`school_type` = s.`school_type`) school_count
			FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			where s.region = {$RegionId}
			GROUP BY s.`school_type`";
	$sql->query($query);
	$SchoolsCount = $sql->fetchAll();

	foreach ($SchoolsCount as $sckey => $School) {
		$SchoolTotal[$School['school_type']]	= array($School['school_count'], $School['scount']);
	}	

	$query = "SELECT id, name3 sname FROM port_s_school_types";
	$sql->query($query);
	$SchoolTypes = $sql->fetchAll();

	$query = "SELECT id, short_name sname FROM `test_s_positions`";
	$sql->query($query);
	$Positions = $sql->fetchAll();

  	$smarty->assign(array(
	'Results1'	=> $Results1,
	'Results2'	=> $Results2,
	'Results3'	=> $Results3,
	'Schools'	=> $Schools,
	'StaffTotal'	=> $StaffTotal,
	'SchoolTotal'	=> $SchoolTotal,
	'SchoolTypes'	=> $SchoolTypes,
	'Positions'		=> $Positions,
	'isDate'		=> 1,
	));
		
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		'Action'		=> $Action,
		));
		
break;
	
case "rep3":
	$query = "				
SELECT t.id, t.school_number, t.school_name, st.name3 stype,
					(SELECT COUNT(*) FROM port_staff WHERE work_place_edu = 0 AND work_place_school = t.id) scount 
					FROM port_schools t 
					LEFT JOIN `port_s_school_types` st ON st.id = t.school_type
					WHERE t.`distcity`= {$DCId}";
				
	$sql->query($query);
	$Schools = $sql->fetchAll();

	$query = "SELECT s.`id` school_id, t.`position`, COUNT(*) scount FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			WHERE s.`distcity`= {$DCId}
			GROUP BY s.`id`, t.`position` ";

	$sql->query($query);
	$StaffByPosition = $sql->fetchAll();

	foreach ($StaffByPosition as $skey => $sCounts) {
		$StaffCounts[$sCounts['school_id']][$sCounts['position']]	= $sCounts['scount'];
	}	

	$query = "SELECT id, short_name sname FROM `test_s_positions`";
	$sql->query($query);
	$Positions = $sql->fetchAll();

	$query = "SELECT s.`id`, t.`position`, COUNT(*) scount FROM port_staff t
			LEFT JOIN port_schools s ON s.`id` = t.`work_place_school`
			WHERE s.`distcity`= {$DCId}
			GROUP BY t.`position`";
	$sql->query($query);
	$TotalResult = $sql->fetchAll();

	foreach ($TotalResult as $skey => $tCounts) {
		$TotalByPositions[$tCounts['position']]	= $tCounts['scount'];
	}	
	
  	$smarty->assign(array(
	'Schools'	=> $Schools,
	'StaffCounts'	=> $StaffCounts,
	'TotalByPositions'	=> $TotalByPositions,
	'Positions'		=> $Positions,
	'isDate'		=> 1,
	));
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		'Action'		=> $Action,
		));
		
break;
	
}

$smarty->display("reports.tpl");
?>