<?php
/****************************************************************
*                           		results.php				 								*
*                          -------------------			  					*
*     begin                : 10.03.2015 y												*
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
		'PageIcon'		=> "results.png",
		'PageTitle'		=> $Dict['results'],
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
		'HeadLinks'	=> HeadLinks($Action, $FacultyId, 3)
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
		'HeadLinks'	=> HeadLinks($Action, $DirId, 3)
		));
		break;
		
	case "controls":
	$GroupId = MyPiDeCrypt($_GET['gid']);

	if (isset($_POST['SubResponse']))
	{
		$query = "update test_protocols set responsibles = '".implode(",",$_POST['response'])."' where id = ".$_POST['protocol'];
		$sql->query($query);
	}

	$query = "SELECT c.id, ts.name, tb.`name1` block, c.`qcount`, c.`ttime`, c.`point`, c.cgroup control_group, tn.name cgroup, bs.`name1` cstatus FROM test_controls c 
						LEFT JOIN v_test_subjects ts ON ts.id = c.`stestid` 
						LEFT JOIN test_s_blocks tb ON tb.id = c.`block` 
						LEFT JOIN test_s_numbers tn ON tn.id = c.`cgroup` 
						LEFT JOIN bcms_s_status bs ON bs.id = c.`status` 
						WHERE c.`groupid` = ".$GroupId." 
						ORDER BY c.`cgroup`, c.`block`";

	$sql->query($query);
	$Controls = $sql->fetchAll();

	$ControlArr = array();
	$TestArr = array();
  foreach ($Controls as $id => $val)
  {
    $ControlArr[$val['control_group']][] = $val;
    $TestArr[$val['control_group']][] = $val['id'];
  }
	
	$MyQuery = "SELECT * FROM test_protocols WHERE groupid = ".$GroupId;
	$sql->query($MyQuery);
	$Protocols = $sql->fetchAll();

	$ProtocolArr = array();
	foreach ($Protocols as $pid => $pval)
	{
		$ProtocolArr[$pval['controlids']] = $pval;
	}

  $TestList = array();
  foreach ($TestArr as $tid => $tval)
  {
    $TestList[$tid] = implode(",",$tval);
		if (!isset($ProtocolArr[$TestList[$tid]]))
		{
			$sql->query("SELECT responsibles FROM test_protocols ORDER BY id DESC LIMIT 1");
			$Respons = $sql->fetchAssoc();
			
			$sql->query("insert into test_protocols (groupid, controlids, responsibles)
									values
									(".$GroupId.", '".$TestList[$tid]."', '".$Respons['responsibles']."')");
		}
  }
	
	if (!isset($Respons))
	{
		$sql->query("SELECT responsibles FROM test_protocols ORDER BY id DESC LIMIT 1");
		$Respons = $sql->fetchAssoc();
	}
	$MyQuery = "SELECT r.id, r.`name`, r.arch, tr.`name1` rank FROM test_responsibles r
						LEFT JOIN test_s_ranks tr ON tr.`id` = r.`rank`
						ORDER BY arch desc, r.name";
	$sql->query($MyQuery);
	$Responsibles = $sql->fetchAll();	 

	$smarty->assign(array(
	'ControlArr'	=> $ControlArr,
	'TestList'	=> $TestList,
	'GroupId'		=> $GroupId,
	'ProtocolArr'		=> $ProtocolArr,
	'Responsibles'		=> $Responsibles,
	'Respons'		=> explode(",",$Respons['responsibles']),
	'HeadLinks'	=> HeadLinks($Action, $GroupId, 3)
	));
		
$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		));
		
break;

  case "results":
    $GroupId = MyPiDeCrypt($_GET['gid']);
    $TestList = $_GET['tlist'];
    
    $OrdBy = "1";
    $AZ = "az";
    
    $OrdByArr[1] = "total_points";
    $OrdByArr[2] = "name";
    $AZArr['az'] = " desc";
    $AZArr['za'] = " asc";
 
 
    if (isset($_GET['ordby']))
    {
      $OrdBy = $_GET['ordby']; 
    }
    
		$sql->query("select * from v_settings");
		$Settings = $sql->fetchAssoc();

		$VedSCmd = $Settings['vcmd'];
		$VedSett = $Settings['vedomst'];
	
    $query = "SELECT r.*, s.name FROM test_results r
                right JOIN v_students s ON (s.`userid` = r.`studentid` AND s.groupid = r.`groupid`)
                WHERE r.groupid = ".$GroupId." AND r.controlid = '".$TestList."'
                AND r.rstatus = 1
						 AND s.status ".$VedSCmd." 
                order by ".$OrdByArr[$OrdBy]." ".$AZArr[$AZ];
    $sql->query($query);
    $Results = $sql->fetchAll();
		    
    $query = "SELECT responsibles FROM test_protocols WHERE groupid = ".$GroupId." AND controlids = '".$TestList."'";
    $sql->query($query);
    $Protocols = $sql->fetchAssoc();

	$ResponseArr = explode(",",$Protocols['responsibles']);
		
    $query = "SELECT r.*, tr.name1 rname
						FROM test_responsibles r
						LEFT JOIN test_s_ranks tr ON tr.id = r.rank
						WHERE r.id IN (".$Protocols['responsibles'].")";

    $sql->query($query);
    $Response = $sql->fetchAll();
		
		$Responsibles = array();
		foreach ($ResponseArr as $id => $val)
		{
			foreach ($Response as $rid => $rval)
			{
				if ($val == $rval['id'])
				{
					$Responsibles[] = $rval;
				}
			}
		}

		$query = "SELECT mark,minimum, maximal, name1 name FROM test_s_ratings ORDER BY mark DESC";
    $sql->query($query);
    $Marks = $sql->fetchAll();
    
    $ResultIds = array();
    foreach($Results as $rid => $rval)
    {
      $ResultIds[] = $rval['id'];
    }
    
    $ResultList = implode(",",$ResultIds);
    $query = "SELECT resultid, controlid, true_answers, false_answers, points FROM test_results_by_tests WHERE resultid IN (".$ResultList.")";
    $sql->query($query);
    $ResultsByTest = $sql->fetchAll();
    foreach ($ResultsByTest as $id => $val)
    {
			$ControlResults[$val['resultid']][$val['controlid']] = $val;
    }
    
    $query = "SELECT tc.id, ts.name1 name, tc.`block`, tc.`point`
                FROM test_controls tc 
                LEFT JOIN test_subjects ts ON ts.`id` = tc.`subject` 
                WHERE tc.id IN (".$TestList.") AND tc.`groupid` = ".$GroupId."
                ORDER BY tc.`block`";
    $sql->query($query);
    $Controls = $sql->fetchAll();
    
    //$resByControl = array();
    $ControlNames = array();
    $MaxPoints = 0;
    foreach ($Controls as $id => $val)
    {
      $ControlNames[$val['id']] = $val['name'];
      $val['name'] = str_replace(" ","<br>",$val['name']);
      $ControlInfo[$val['id']] = $val;
      $MaxPoints+=$val['point'];
    }
		
    $query = "SELECT minimum FROM test_s_ratings WHERE mark = 3";
		$sql->query($query);
		$Rating = $sql->fetchAssoc();
    
    $query = "SELECT g.id, f.`name1` fname, d.`name1`dname, g.name1 gname FROM test_groups g 
              LEFT JOIN test_directions d ON d.`id` = g.`direction`
              LEFT JOIN test_faculties f ON f.`id` = g.`faculty`
              WHERE g.id = ".$GroupId;
    $sql->query($query);
    $FDGNames = $sql->fetchAssoc();
    
	  $MarkCalc = array();
		$MarkCalc[5] = 0;
		$MarkCalc[4] = 0;
		$MarkCalc[3] = 0;
		$MarkCalc[2] = 0;
		foreach($Results as $rid => $rval)
    {
      $ResultIds[] = $rval['id'];
			$ThisPercent = round($rval['total_points']/$MaxPoints*100,1);
			foreach ($Marks as $mid => $mval)
			{
				if ($mval['minimum'] <= $ThisPercent && $ThisPercent < $mval['maximal'])
				{
					$MarkCalc[$mval['mark']] +=1;
					break;
				}
			}
    }
  
	$query = "SELECT t.`id`, t.`name`, t.`photo`, s.id subjectid, s.`name1` SUBJECT, tp.`name1` POSITION, tr.`name1` rank,
	(SELECT SUM(p.`point`) FROM `v_test_rating_points` p WHERE p.`group_id` = {$GroupId} and p.teacher_id = t.`id`) rating

			FROM test_control_teachers p 
			LEFT JOIN test_teachers t ON t.`id` = p.teacher
			LEFT JOIN test_subjects s ON s.`id` = p.subject
			LEFT JOIN test_s_positions tp ON tp.`id` = t.`position`
			LEFT JOIN test_s_ranks tr ON tr.`id` = t.`degree`
			WHERE p.test IN ({$TestList})"; 
	$sql->query($query);
	$TeachersAll = $sql->fetchAll();

	foreach ($TeachersAll as $tkey => $Teacher) {
		$query = "SELECT COUNT(*) FROM `v_test_rating_points` p 
		WHERE p.`group_id` = {$GroupId} AND p.teacher_id = {$Teacher['id']}
		GROUP BY p.`student_id`";
		$sql->query($query);
		$Teacher['rates_count'] = $sql->numRows();
		$Teachers[] = $Teacher;
	}

	$smarty->assign(array(
	'Results'	=> $Results,
	'ControlResults'	=> $ControlResults,
	'ControlNames'	=> implode(", ",$ControlNames),
	'ControlInfo'	=> $ControlInfo,
	'MaxPoints'	=> $MaxPoints,
	'MinPoints'	=> ($MaxPoints*$Rating['minimum'])/100,
	'FDGNames'	=> $FDGNames,
	'MarkCalc'	=> $MarkCalc,
	'Marks'	=> $Marks,
	'Responsibles'	=> $Responsibles,
	'Teachers'	=> $Teachers,
	));
		
  break;

	case "appeal":
		$GroupId = MyPiDeCrypt($_GET['gid']);
    $TestList = $_GET['tlist'];
		
		$query = "SELECT r.id, r.groupid, s.name, s.userid FROM test_results r 
							left JOIN v_students s ON s.`userid` =  r.`studentid`
							WHERE r.`groupid` = ".$GroupId."
							AND r.`controlid` = '".$TestList."'
							ORDER BY s.`name`";
		$sql->query($query);
		$StudentResults = $sql->fetchAll();
		
	//echo $Action;
	$smarty->assign(array(
		'StudentResults'	=> $StudentResults,
		'HeadLinks'	=> HeadLinks($Action, $GroupId, 3)		
		));		
		break;
	
	case "answers":
		$StudentId = MyPiDeCrypt($_GET['sid']);
		$ResultId = MyPiDeCrypt($_GET['rid']);
		$query = "SELECT r.id, s.`name`
FROM test_results r
LEFT JOIN v_students s ON s.`userid` = r.`studentid`
WHERE 
							r.id = ".$ResultId."
							AND r.studentid = ".$StudentId;
							
		$sql->query($query);
		$Result = $sql->fetchAssoc();
		if (isset($Result['id']))
		{
			$query = "SELECT tq.id, tq.`controlid`, s.`name1` cname, q.`question`, a.`answer`, tq.`istrue`
								FROM test_results_by_questions tq
								LEFT JOIN test_controls tc ON tc.`id` = tq.`controlid`
								LEFT JOIN test_subjects s ON s.`id` = tc.subject
								LEFT JOIN test_questions q ON q.`id` = tq.`question`
								LEFT JOIN test_answers a ON a.`id` = tq.`answer`
								WHERE tq.resultid = ".$Result['id']."
								ORDER BY tc.`block`";
			$sql->query($query);
			$Answers = $sql->fetchAll();
	$smarty->assign(array(
		'Answers'	=> $Answers,
		'Result'	=> $Result,
		));		
		}
	break;
	
}
$smarty->display("results.tpl");
?>