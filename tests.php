<?php
/****************************************************************
*                           		tests.php				 								*
*                          -------------------			  					*
*     begin                : 08.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

define('ARM_IN', true);
include("includes/all_includes.php");

$Action = isset($_GET['act']) ? $_GET['act'] : "view";
$sDate = (isset($_POST['subdate'])) ? $_POST['subdate'] : date('d.m.Y');

$sql->query('SELECT name'.$slang.' name, keyword from bcms_s_dictionary');
$Dictionary = $sql->fetchAll();

foreach ($Dictionary as $id => $value)
{
	$Dict[$value['keyword']] = $value['name'];
}

$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		'PageTitle'		=> $Dict['tests'],
		'Action'			=> $Action,
		'Access'			=> $_SESSION['objects'],
		'Dict'				=> $Dict));

switch ($Action)
{
	case "view":
	$MyQuery = "SELECT id, name".$slang." name FROM test_faculties WHERE active = 1";
	$sql->query($MyQuery);

	$Faculties = $sql->fetchAll();

	$smarty->assign(array(
	'Faculties'	=> $Faculties
	));
		break;
	
	case "directions":
		$FacultyId = MyPiDeCrypt($_GET['fid']); 
		$MyQuery = "SELECT id, faculty, name".$slang." name FROM test_directions WHERE faculty = ".$FacultyId;
		$sql->query($MyQuery);
	
		$Directions = $sql->fetchAll();
	
		$smarty->assign(array(
		'Directions'	=> $Directions,
		'HeadLinks'	=> HeadLinks($Action, $FacultyId, 2)
		));
		break;
	
	case "groups":
		$DirId = MyPiDeCrypt($_GET['did']); 
		if (isset($_POST['SubAdd']))
		{
			$sql->query("SELECT id, faculty FROM test_directions WHERE id = ".$DirId);
			$Direction = $sql->fetchAssoc();
			
			$query = "insert into test_groups (faculty, direction, name1) values (".$Direction['faculty'].",".$Direction['id'].",'".$_POST['groupname']."')";
			$sql->query($query);
			if ($sql->error() == "")
			{
				Jump("staff.php?act=groups&did=".MyPiCrypt($DirId));
			}
		}	

		$MyQuery = "SELECT id, direction, name".$slang." name FROM test_groups WHERE direction = ".$DirId;
		$sql->query($MyQuery);
		$Groups = $sql->fetchAll();

		$smarty->assign(array(
		'Groups'	=> $Groups,
		'HeadLinks'	=> HeadLinks($Action, $DirId, 2)
		));
		break;
		
	case "controls":
	$GroupId = MyPiDeCrypt($_GET['gid']);
	if (isset($_POST['SubForm']))
	{
		$Subject = $_POST['subject'];
		$Test = $_POST['stestid'];
		$Block = $_POST['block'];
		$QCount = $_POST['qcount'];
		$TTime = $_POST['ttime'];
		$Point = $_POST['point'];
		$Cgroup = $_POST['cgroup'];
		$Status = $_POST['status'];
		
		if ($_POST['acttype'] == 0)
		{
		$query = "insert into test_controls 
							(groupid, subject, stestid, block, qcount,ttime, point, cgroup, status)
							VALUES
						(".$GroupId.",".$Subject.",".$Test.",".$Block.",".$QCount.",".$TTime.",".$Point.",".$Cgroup.",".$Status.")";
		$sql->query($query);
		}
		else
		{
		$RowId = MyPiDeCrypt($_POST['sid']);
		$query = "update test_controls set
							groupid = ".$GroupId.",
							subject = ".$Subject.",
							stestid = ".$Test.",
							block = ".$Block.",
							qcount = ".$QCount.",
							ttime = ".$QCount.",
							point = ".$Point.",
							cgroup = ".$Cgroup.",
							status = ".$Status."
							where id = ".$RowId;
		$sql->query($query);
			
		}
		Jump("tests.php?act=controls&gid=".MyPiCrypt($GroupId));
	}
	
	if (isset($_POST['SubDel']))
	{
		$RowId = MyPiDeCrypt($_POST['sid']);
		
		$sql->query("delete from test_controls where id = ".$RowId);
		
		Jump("tests.php?act=controls&gid=".MyPiCrypt($GroupId));
	}
	
	$query = "select id, name".$slang." name from test_subjects";
	$sql->query($query);
	$Subjects = $sql->fetchAll();
	
	$query = "select id, name".$slang." name from test_s_blocks";
	$sql->query($query);
	$Blocks = $sql->fetchAll();
	
	$query = "select id, name from test_s_numbers";
	$sql->query($query);
	$Numbers = $sql->fetchAll();
	
	
	$query = "select id, name".$slang." name from bcms_s_status";
	$sql->query($query);
	$Statuses = $sql->fetchAll();
	
	//print_r($Subjects);
	$query = "SELECT c.id, ts.name, tb.`name1` block, c.`qcount`, c.`ttime`, c.`point`, tn.name cgroup, bs.`name1` cstatus FROM test_controls c 
						LEFT JOIN v_test_subjects ts ON ts.id = c.`stestid` 
						LEFT JOIN test_s_blocks tb ON tb.id = c.`block` 
						LEFT JOIN test_s_numbers tn ON tn.id = c.`cgroup` 
						LEFT JOIN bcms_s_status bs ON bs.id = c.`status` 
						WHERE c.`groupid` = ".$GroupId." 
						ORDER BY c.`cgroup`, c.`block`";

	$sql->query($query);
	$Controls = $sql->fetchAll();
	

	foreach ($Controls as $ckey => $cvalue) {
		$query = "SELECT ct.id, tt.name, tt.photo 
					FROM test_control_teachers ct 
					LEFT JOIN test_teachers tt ON tt.id = ct.teacher
					WHERE ct.test = ".$cvalue['id'];
		$sql->query($query);
		$TestTeachers = $sql->fetchAll();
		$TestTeachersArr = array();
		foreach ($TestTeachers as $tkey => $tvalue) {
			$TestTeachersArr[] = $tvalue['name'];
		}
		if (count($TestTeachersArr) > 0)
		{
			$TestTeachersList[$cvalue['id']] = implode(",<br>", $TestTeachersArr);
		}
		else
		{
			$TestTeachersList[$cvalue['id']] = "";
		}
	}

	
	$smarty->assign(array(
	'Controls'	=> $Controls,
	'Subjects'	=> $Subjects,
	'Blocks'		=> $Blocks,
	'Numbers'		=> $Numbers,
	'Statuses'		=> $Statuses,
	'TestTeachersList'	=> isset($TestTeachersList) ? $TestTeachersList : 0,
	'HeadLinks'	=> HeadLinks($Action, $GroupId, 2)
	));
		
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		));
		
break;

case "teachers":
			$TestId = MyPiDeCrypt($_GET['id']);
			if (isset($_POST['SubTeacherAdd']))
			{
				$TestId = MyPiDeCrypt($_POST['testid']); 
				$SubjectId = MyPiDeCrypt($_POST['subjectid']); 
				$Teacher = $_POST['teacher'];

				$query = "insert into test_control_teachers (test,subject,teacher) 
				values (".$TestId.",".$SubjectId.",".$Teacher.")";
				$sql->query($query);
				if ($sql->error() == "")
				{
					Jump("tests.php?act=teachers&id={$_POST['testid']}");
				}
			}
			if (isset($_POST['SubTeacherUpd']))
			{
				$TestTeacherId = MyPiDeCrypt($_POST['sid']); 
				$TestId = MyPiDeCrypt($_POST['testid']); 
				$SubjectId = MyPiDeCrypt($_POST['subjectid']); 
				$Teacher = $_POST['teacher'];


				$query = "update test_control_teachers set 
								teacher    = ".$Teacher."
								where id = ".$TestTeacherId;
				$sql->query($query);

				if ($sql->error() == "")
				{
					Jump("tests.php?act=teachers&id={$_POST['testid']}");
				}
			}	

			if (isset($_POST['SubTeacherDel']))
			{
				$TestTeacherId = MyPiDeCrypt($_POST['sid']); 
				$query = "delete from test_control_teachers where id = ".$TestTeacherId;
				$sql->query($query);
				if ($sql->error() == "")
				{
					Jump("tests.php?act=teachers&id={$_POST['testid']}");
				}
			}	
			
			$query = "SELECT tc.id, ts.name,tc.subject, tc.groupid FROM v_test_subjects ts, test_controls tc
					WHERE ts.subjectid = tc.subject
					AND tc.id = {$TestId}";
			$sql->query($query);
			$Test = $sql->fetchAssoc();

			$query = "SELECT t.id, t.name FROM test_teachers_subjects ts 
						LEFT JOIN test_teachers t ON t.id = ts.teacher
						WHERE ts.subject = (SELECT SUBJECT FROM test_controls WHERE id = {$TestId})
						AND t.status = 1";
			$sql->query($query);
			$Teachers = $sql->fetchAll();
	

			$query = "SELECT ct.id, tt.name, tt.photo 
						FROM test_control_teachers ct 
						LEFT JOIN test_teachers tt ON tt.id = ct.teacher
						WHERE ct.test = {$TestId}";
			$sql->query($query);
			$TestTeachers = $sql->fetchAll();

			$smarty->assign(array(
				'Teachers' 		=> $Teachers,
				'TestTeachers'	=> $TestTeachers,
				'Test' 			=> $Test,
			));

		break;	
}
$smarty->display("tests.tpl");
?>