<?php
/****************************************************************
*                           			ajax.php			 								*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

define('ARM_IN', true);
require_once("includes/error_reporting.php");
require_once("includes/constants.php");
require_once("includes/DB.php");
$sql = new DB(HOST, USERNAME, PASSWORD, SYSTEM_BASE);
$sql->open();
$sql->query('SET NAMES cp1251;');
require_once("includes/functions.php");
require_once("includes/sessions.php");
require_once("includes/check.php");

if (count($_GET) > 0)
{
	$SQLCommands = array('select','drop','concat','union',' and',' or','database','null','benchmark','load_file');

	foreach ($SQLCommands as $sInd => $sVal)
	{
		foreach ($_GET as $ind => $val)
		{
			if (strpos(strtolower($val),$sVal) > 0)
			{
				$_GET[$ind] = 0;
			}
		}
	}
}

$Action = $_GET['act'];

switch ($Action)
{
	case 'ginfo':
		$StudentId = MyPiDeCrypt($_GET['id']);
		$query = "SELECT id, lastname, firstname, surname, birthdate, srank FROM test_students WHERE id = ".$StudentId;

		$sql->query($query);
		$result = $sql->fetchAssoc();

		$res = "0<&sec&>".MyPiCrypt($result['id'])."<&sec&>".$result['lastname']."<&sec&>".$result['firstname']."<&sec&>".$result['surname']."<&sec&>".$result['brithdate']."<&sec&>".$result['srank'];
	break;
	
	case 'groups':
		$GroupId = MyPiDeCrypt($_GET['id']);
		$query = "SELECT id, name1 FROM test_groups WHERE id = ".$GroupId;

		$sql->query($query);
		$result = $sql->fetchAssoc();

		$res = "0<&sec&>".MyPiCrypt($result['id'])."<&sec&>".$result['name1'];
	break;
	
	case 'printpasswd':
		$IdsArr = explode(",", $_GET['ids']);
		foreach ($IdsArr as $id => $val)
		{
			if ($val != 1)
			{
				$StudIds[] = MyPiDeCrypt($val);
			}
		}

		$query = "SELECT lastname, firstname, surname, userid, passwd FROM test_students WHERE id in (".implode(",",$StudIds).")";

		$sql->query($query);
		$result = $sql->fetchAll();
		$Row = "<table align=center border=0 width=100% cellpadding=5 cellspacing=1 bgcolor=BCC7DD>";
		foreach ($result as $id => $val)
		{
			$Row .= "<tr bgcolor='#ffffff'><td>".($id+1)."</td><td>".$val['lastname']." ".$val['firstname']." ".$val['surname']."</td><td>".$val['userid']."</td><td>".$val['passwd']."</td></tr>";
		}
		$Row .= "</table>";
		
		$res = $Row;
	break;	
	case 'delstudent':
		$IdsArr = explode(",", $_GET['ids']);
		foreach ($IdsArr as $id => $val)
		{
			if ($val != 1)
			{
				$StudIds[] = MyPiDeCrypt($val);
			}
		}

		$query = "delete FROM test_students WHERE id in (".implode(",",$StudIds).")";
		$sql->query($query);
	
		$res = $Row;
	break;
	case 'archstudent':
		$IdsArr = explode(",", $_GET['ids']);
		foreach ($IdsArr as $id => $val)
		{
			if ($val != 1)
			{
				$StudIds[] = MyPiDeCrypt($val);
			}
		}

		$query = "update test_students set status = 2 where id in (".implode(",",$StudIds).")";
		$sql->query($query);
	
		$res = $Row;
	break;
	case 'backstudent':
		$IdsArr = explode(",", $_GET['ids']);
		foreach ($IdsArr as $id => $val)
		{
			if ($val != 1)
			{
				$StudIds[] = MyPiDeCrypt($val);
			}
		}

		$query = "update test_students set status = 1 where id in (".implode(",",$StudIds).")";
		$sql->query($query);
	
		$res = $Row;
	break;
	case 'delquest':
		$QuestonId = MyPiDeCrypt($_GET['qid']);
		$query = "delete from test_answers where question = ".$QuestonId;
		$sql->query($query);

		$query = "delete from test_questions where id = ".$QuestonId;
		$sql->query($query);
		
		$res = "1";
	break;	
	
	case 'delquestpic':
		$QuestonId = MyPiDeCrypt($_GET['qid']);
		$query = "delete from test_question_pics where question_id = ".$QuestonId;
		$sql->query($query);

		$res = "1";
	break;	
	case 'delanswerpic':
		$AnswerId = MyPiDeCrypt($_GET['qid']);
		$query = "delete from test_answer_pics where answer_id = ".$AnswerId;
		$sql->query($query);

		$res = "1";
	break;	
	
	case 'delcontrolqa':
		$TestId = MyPiDeCrypt($_GET['cid']);
		$query = "delete from test_answers where testid = ".$TestId;
		$sql->query($query);

		$query = "delete from test_questions where testid = ".$TestId;
		$sql->query($query);
		
		$res = "1";
	break;
	
	case 'gettest':
		$StudentId = $_GET['sid'];
		$query = "SELECT * FROM v_test_subjects WHERE subjectid = ".$StudentId;

		$sql->query($query);
		$result = $sql->fetchAll();

		$options = "";
		foreach ($result as $id => $val)
		{
			$options .= "<option value='".$val['id']."'>".$val['name']."</option>";
		}
		$res = $options;
	break;

	case 'getpoints':
		$GroupId = $_GET['tnumber'];
		$BlockNumber = $_GET['tblock'];
		$query = "SELECT bpoints{$BlockNumber} points, bqcount{$BlockNumber} counts  FROM test_s_numbers WHERE id = ".$GroupId;
		$sql->query($query);
		$result = $sql->fetchAssoc();
		$res = "0<&sec&>{$result['points']}<&sec&>{$result['counts']}";
	break;
	
	case 'gtestinfo':
		$ControlId = MyPiDeCrypt($_GET['id']);
		$query = "SELECT * FROM test_controls WHERE id = ".$ControlId;

		$sql->query($query);
		$result = $sql->fetchAssoc();

		$query = "SELECT * FROM v_test_subjects WHERE subjectid = ".$result['subject'];
		$sql->query($query);
		$Tests = $sql->fetchAll();

		$options = "";
		foreach ($Tests as $id => $val)
		{
			$options .= "<option value='".$val['id']."'>".$val['name']."</option>";
		}
		
		$res = "0<&sec&>".MyPiCrypt($result['id'])."<&sec&>".$result['groupid']."<&sec&>".$result['subject'].
		"<&sec&>".$options."<&sec&>".$result['block']."<&sec&>".$result['qcount']."<&sec&>".$result['ttime'].
		"<&sec&>".$result['point']."<&sec&>".$result['cgroup']."<&sec&>".$result['status']."<&sec&>".$result['stestid'];
	break;

	case 'responsibles':
		$GroupId = $_GET['gid'];
		$ControlIds = $_GET['cid'];
		$sql->query("SELECT id, responsibles FROM test_protocols where groupid = ".$GroupId." and controlids = '".$ControlIds."'");
		$Respons = $sql->fetchAssoc();
			
		$res = $Respons['id'].",".$Respons['responsibles'];
	break;

	case 'task_info':
		$TestTaskId = MyPiDeCrypt($_GET['id']);

		$query = "SELECT COUNT(*) ccount FROM test_controls tc WHERE tc.`stestid` = ".$TestTaskId;
		$sql->query($query);
		$Controls = $sql->fetchAssoc();

		$query = "SELECT id, subject, name, tlang FROM test_subject_tests WHERE id = ".$TestTaskId;
		$sql->query($query);
		$result = $sql->fetchAssoc();

		$res = "0<&sec&>".MyPiCrypt($result['id'])."<&sec&>".$result['subject']."<&sec&>".$result['name']."<&sec&>".$result['tlang']."<&sec&>".$Controls['ccount'];
	break;

	case 'test_teacher':
		$TestTeacher = MyPiDeCrypt($_GET['id']);

		$query = "SELECT * FROM test_control_teachers WHERE id = ".$TestTeacher;
		$sql->query($query);
		$result = $sql->fetchAssoc();

		$res = "0<&sec&>".MyPiCrypt($result['id'])."<&sec&>".MyPiCrypt($result['test'])."<&sec&>".MyPiCrypt($result['subject'])."<&sec&>".$result['teacher'];
	break;

	case 'add_schools':
		$query = "SELECT region, id, school_count FROM  port_s_citydist ORDER BY region, id";
		$sql->query($query);
		$DistCity = $sql->fetchAll();

		foreach ($DistCity as $skey => $Dist) {
			$SchoolCount = $Dist['school_count']+1;
			for ($i=1; $i < $SchoolCount; $i++) { 
			echo $query = "INSERT INTO port_schools (region,distcity,school_number,school_name,school_type,teacher_count,pupil_count,class_count) 
				VALUES ({$Dist['region']},{$Dist['id']},{$i},'',1,0,0,0);";
				echo "<br>";

			}
		}

		$res = "0<&sec&>".MyPiCrypt($result['id'])."<&sec&>".MyPiCrypt($result['test'])."<&sec&>".MyPiCrypt($result['subject'])."<&sec&>".$result['teacher'];
	break;

	case 'get_district':
		$RegionId = $_GET['rid'];
		$query = "SELECT id, name1 name FROM `port_s_citydist` WHERE region = {$RegionId} ORDER BY name1 ";

		$sql->query($query);
		$result = $sql->fetchAll();

		$options = "";
		foreach ($result as $id => $val)
		{
			$options .= "<option value='".$val['id']."'>".$val['name']."</option>";
		}
		$res = $options;
	break;
	
	case 'save_staff':
		$StaffId	=			$_POST['staffid'];
		$FormAction	=			$_POST['formaction'];
		$lastname=				$_POST['lastname'];
		$firstname= 			$_POST['firstname'];
		$surname= 				$_POST['surname'];

		$BirthYear = explode(".", $_POST['birthdate']);
		if (isset($BirthYear['2']))
		{
			$birthdate = $BirthYear['2']."-".$BirthYear['1']."-".$BirthYear['0'];
		}
		else
		{
			$birthdate = "0000-00-00";
		}
		$nation=				$_POST['nation'];
		$gender=				$_POST['gender'];
		$passport_cer=			$_POST['passport_cer'];
		$passport_num=			$_POST['passport_num'];
		$region=				$_POST['region'];
		$distcity=				$_POST['distcity'];
		$email=					$_POST['email'];
		$phone=					$_POST['phone'];
		$grad_univer=			$_POST['grad_univer'];
		$grad_univer_year=		$_POST['grad_univer_year'];
		$dip_expertise=			$_POST['dip_expertise'];
		$dip_speciality=		$_POST['dip_speciality'];
		$dip_series=			$_POST['dip_series'];
		$dip_number=			$_POST['dip_number'];
		$work_place_school=		$_POST['work_place_school'];
		$position=				$_POST['position'];
		$position_year=			($_POST['position_year'] != "") ? $_POST['position_year'] : 0;
		$last_qual_place=		$_POST['last_qual_place'];
		$last_qual_year=		($_POST['last_qual_year'] != "") ? $_POST['last_qual_year'] : 0;
		$mo_certificat_no=		$_POST['mo_certificat_no'];
		$attestation_year=		($_POST['attestation_year'] != "") ? $_POST['attestation_year'] : 0;
		$attestation_result=	$_POST['attestation_result'];
		$attestation_category=	$_POST['attestation_category'];
		$retraining_vuz=		$_POST['retraining_vuz'];
		$retraining_year=		($_POST['retraining_year'] != "") ? $_POST['retraining_year'] : 0;
		$retraining_dip_no=		$_POST['retraining_dip_no'];

		if ($FormAction == "add")
		{
			$query = "INSERT INTO port_staff 
	(lastname,firstname,surname,birthdate,nation,gender,passport_cer,passport_num,grad_univer,grad_univer_year,dip_expertise,dip_speciality,dip_series,dip_number,region,distcity,work_place_edu,work_place_school,position,position_year,last_qual_place,last_qual_year,mo_certificat_no,attestation_year,attestation_result,retraining_vuz,retraining_year,retraining_dip_no,phone,nostrification,photo,email,attestation_category) 
	VALUES ('{$lastname}','{$firstname}','{$surname}','{$birthdate}',{$nation},{$gender},'{$passport_cer}','{$passport_num}',{$grad_univer},'{$grad_univer_year}','{$dip_expertise}','{$dip_speciality}','{$dip_series}','{$dip_number}',{$region},{$distcity},0,{$work_place_school},{$position},{$position_year},{$last_qual_place},'{$last_qual_year}','{$mo_certificat_no}','{$attestation_year}','{$attestation_result}',{$retraining_vuz},'{$retraining_year}','{$retraining_dip_no}','{$phone}','','','{$email}',{$attestation_category})";
		}
		else
		{
			$query = "UPDATE port_staff SET lastname = '{$lastname}',firstname = '{$firstname}',surname = '{$surname}',
			birthdate = '{$birthdate}',nation = {$nation},gender = {$gender},passport_cer = '{$passport_cer}',passport_num = {$passport_num},
			grad_univer = {$grad_univer},grad_univer_year = {$grad_univer_year},dip_expertise = '{$dip_expertise}',dip_speciality = '{$dip_speciality}',
			dip_series = '{$dip_series}',dip_number = '{$dip_number}',region = {$region},distcity = {$distcity},
			work_place_school = {$work_place_school},position = {$position},position_year = {$position_year},last_qual_place = {$last_qual_place},
			last_qual_year = {$last_qual_year},mo_certificat_no = '{$mo_certificat_no}',attestation_year = {$attestation_year},
			attestation_result = '{$attestation_result}',retraining_vuz = {$retraining_vuz},retraining_year = {$retraining_year},
			retraining_dip_no = '{$retraining_dip_no}',phone = '{$phone}',nostrification = '',
			photo = '', email = '{$email}', attestation_category = {$attestation_category} WHERE id = {$StaffId}";
		}
		$sql->query($query);
		//$res = $query;
		if ($sql->error() == "")
		{
			$res = "0";
		}
		else
		{
			$res = "1<&sep&>".$sql->error();
		}
	break;
	case 'staff_info':
		$StaffId = MyPiDeCrypt($_GET['sid']);

		$query = "SELECT id,lastname,firstname,surname,DATE_FORMAT(birthdate,'%d.%m.%Y') birthdate,nation,gender,passport_cer,passport_num,region,distcity,email,phone,		grad_univer,grad_univer_year,dip_expertise,dip_speciality,dip_series,dip_number,work_place_school,position,position_year,last_qual_place,last_qual_year,mo_certificat_no,attestation_year,attestation_result,attestation_category,retraining_vuz,retraining_year,retraining_dip_no 
					FROM port_staff
					WHERE id = ".$StaffId;
		$sql->query($query);
		$Staff = $sql->fetchAssoc();

		$query = "SELECT id, name1 dsname FROM port_s_citydist WHERE region = {$Staff['region']} ORDER BY name1";
		$sql->query($query);
		$Districts = $sql->fetchAll();

		$DistCityOptions = "";
		foreach ($Districts as $dkey => $dvalue) {
			$DistCityOptions .= "<option value='{$dvalue['id']}'>{$dvalue['dsname']}</option>";
		}


		$res = "0<&sec&>".$Staff['lastname']."<&sec&>".$Staff['firstname']."<&sec&>".$Staff['surname']."<&sec&>".$Staff['birthdate']."<&sec&>".$Staff['nation']."<&sec&>".$Staff['gender']."<&sec&>".$Staff['passport_cer']."<&sec&>".$Staff['passport_num']."<&sec&>".$Staff['region']."<&sec&>".$Staff['distcity']."<&sec&>".$Staff['email']."<&sec&>".$Staff['phone']."<&sec&>".$Staff['grad_univer']."<&sec&>".$Staff['grad_univer_year']."<&sec&>".$Staff['dip_expertise']."<&sec&>".$Staff['dip_speciality']."<&sec&>".$Staff['dip_series']."<&sec&>".$Staff['dip_number']."<&sec&>".$Staff['work_place_school']."<&sec&>".$Staff['position']."<&sec&>".$Staff['position_year']."<&sec&>".$Staff['last_qual_place']."<&sec&>".$Staff['last_qual_year']."<&sec&>".$Staff['mo_certificat_no']."<&sec&>".$Staff['attestation_year']."<&sec&>".$Staff['attestation_result']."<&sec&>".$Staff['retraining_vuz']."<&sec&>".$Staff['retraining_year']."<&sec&>".$Staff['retraining_dip_no']."<&sec&>".$Staff['id']."<&sec&>".$DistCityOptions."<&sec&>".$Staff['attestation_category'];

	break;

	case 'staff_short_info':
		$StudId = MyPiDeCrypt($_GET['sid']);

		$query = "SELECT s.id, s.lastname, s.firstname, s.surname FROM port_staff s WHERE s.id = ".$StudId;

		$sql->query($query);
		$result = $sql->fetchAssoc();
		$Name = $result['lastname']." ".$result['firstname']." ".$result['surname'];

		$res = "0<&sec&>".MyPiCrypt($result['id'])."<&sec&>".$Name;
	break;
	case "tmp":
		
		function random0()
{
	$letters_cap = array(1 => "A", "B", "C", "D", "E", "F", "G", "H" ,"I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",	"S", "T", "U", "V", "W", "X", "Y", "Z");
	//$letters_cap = array(1 => "a", "b", "c", "d", "e", "f", "g", "h" ,"i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", 	"t", "u", "v", "w", "x", "y", "z");

	$index = Key($letters_cap);
	$element = Current($letters_cap);
	$index = rand(1,26);
	$random_letter_cap = $letters_cap[$index];
	return $random_letter_cap;
}
function random1()
{
	$random_number = rand(0,9);
	return $random_number;
}
function random_passwd($type,$unv)
{
	$l1 = rand(0,1);
	$lt1 = call_user_func("random".$l1);

	$l2 = rand(0,1);
	$lt2 = call_user_func("random".$l2);

	$l3 = rand(0,1);
	$lt3 = call_user_func("random".$l3);

	$l4 = rand(0,1);
	$lt4 = call_user_func("random".$l4);

	$l5 = rand(0,1);
	$lt5 = call_user_func("random".$l5);

	$l6 = rand(0,1);
	$lt6 = call_user_func("random".$l6);

	$userType[1] = "R";
	$userType[2] = "D";
	$userType[3] = "S";

	return $userType[$type].$unv."-".$lt1.$lt2.$lt3.$lt4.$lt5.$lt6;
}

function CyrLatTR($string, $gost=false)
{
	if($gost)
	{
		$replace = array("А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
                "Е"=>"E","е"=>"e","Ё"=>"E","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i",
                "Й"=>"I","й"=>"i","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n","О"=>"O","о"=>"o",
                "П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t","У"=>"U","у"=>"u","Ф"=>"F","ф"=>"f",
                "Х"=>"Kh","х"=>"kh","Ц"=>"Tc","ц"=>"tc","Ч"=>"Ch","ч"=>"ch","Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch","щ"=>"shch",
                "Ы"=>"Y","ы"=>"y","Э"=>"E","э"=>"e","Ю"=>"Iu","ю"=>"iu","Я"=>"Ia","я"=>"ia","ъ"=>"","ь"=>"");
	}
	else
	{
		$arStrES = array("ае","уе","ое","ые","ие","эе","яе","юе","ёе","ее","ье","ъе","ый","ий");
		$arStrOS = array("аё","уё","оё","ыё","иё","эё","яё","юё","ёё","её","ьё","ъё","ый","ий");        
		$arStrRS = array("а$","у$","о$","ы$","и$","э$","я$","ю$","ё$","е$","ь$","ъ$","@","@");
                    
		$replace = array("&#1178;"=>"Q","&#1179;"=>"q","&#1170;"=>"G`","&#1171;"=>"g`","&#1202;"=>"H","&#1203;"=>"h","А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
                "Е"=>"Ye","е"=>"e","Ё"=>"Ye","ё"=>"e","Ж"=>"J","ж"=>"j","З"=>"Z","з"=>"z","И"=>"I","и"=>"i",
                "Й"=>"Y","й"=>"y","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n",
                "О"=>"O","о"=>"o","П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t",
                "У"=>"U","у"=>"u","Ф"=>"F","ф"=>"f","Х"=>"X","х"=>"x","Ц"=>"Ts","ц"=>"ts","Ч"=>"Ch","ч"=>"ch",
                "Ш"=>"Sh","ш"=>"sh","Щ"=>"Sh","щ"=>"sh","Ъ"=>"","ъ"=>"","Ы"=>"Y","ы"=>"y","Ь"=>"","ь"=>"",
                "Э"=>"E","э"=>"e","Ю"=>"Yu","ю"=>"yu","Я"=>"Ya","я"=>"ya","@"=>"y","$"=>"ye","Ў"=>"O`","ў"=>"o`");
                
		$string = str_replace($arStrES, $arStrRS, $string);
		$string = str_replace($arStrOS, $arStrRS, $string);
	}
        
	return strtr($string,$replace);
}


		$query = "SELECT * FROM v_region_departments";
		$sql->query($query);
		$result = $sql->fetchAll();
		foreach ($result as $rkey => $rvalue) {
			$Unv = rand(1000,9999);
			$Name = CyrLatTR($rvalue['name1']);
			$User = random_passwd(2,$Unv);
			$Passwd = md5("av123");
			/*echo $query = "insert into bcms_admins (name, username, password, menu, region_dep, distcity_dep) values 
			('{$Name}','{$User}','{$Passwd}', 10, {$rvalue['region']},{$rvalue['distcity']})";*/

			echo $query = "UPDATE `port_departments` SET name3 = '{$Name}' WHERE id = {$rvalue['id']}";
			echo '<br>';
			$sql->query($query);


			$res = 0;
		}
	break;
}

	

//echo iconv("cp1251", "UTF-8", $res);
echo $res;
