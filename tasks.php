<?php
/****************************************************************
*                           		tasks.php				 								*
*                          -------------------			  					*
*     begin                : 06.03.2015 y												*
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
		'PageIcon'		=> "tests.png",
		'PageTitle'		=> $Dict['test_sets'],
		'Action'		=> $Action,
		'Access'		=> $_SESSION['objects'],
		'Dict'			=> $Dict));

switch ($Action)
{
	case "view":
	if (isset($_POST['SubAdd']))
		{
			$Subject = $_POST['subject'];
			$Comment = $_POST['comment'];
			$query = "INSERT INTO test_subject_tests (subject, name) VALUES (".$Subject.", '".$Comment."')";
			$sql->query($query);
			
			if ($sql->error() == "")
			{
				Jump("tasks.php");
			}
		}
		
	if (isset($_POST['SubEdit']))
		{
			$TaskId = MyPiDeCrypt($_POST['sid']);
			$Subject = $_POST['subject'];
			$Comment = $_POST['comment'];
			
			$query = "update test_subject_tests SET
			subject = ".$Subject.",
			name ='".$Comment."'
			where id = ".$TaskId;
			$sql->query($query);
			
			if ($sql->error() == "")
			{
				Jump("tasks.php");
			}
		}
		
	if (isset($_POST['SubDelete']))
		{
			$TaskId = MyPiDeCrypt($_POST['sid']);
			$query = "delete from test_subject_tests where id = ".$TaskId;
			$sql->query($query);
			
			if ($sql->error() == "")
			{
				Jump("tasks.php");
			}
		}
		
	$query = "SELECT id, name".$slang." name FROM test_subjects ORDER BY name".$slang."";
	$sql->query($query);
	$Subjects = $sql->fetchAll();

	$query = "SELECT id, name".$slang." name FROM test_s_lang ORDER BY id";
	$sql->query($query);
	$Languages = $sql->fetchAll();

	$query = "SELECT t.id, t.name tname, s.name".$slang." sname, 
						(SELECT COUNT(*) FROM test_questions WHERE testid = t.id AND LANGUAGE= 1) qcount1,
						(SELECT COUNT(*) FROM test_questions WHERE testid = t.id AND LANGUAGE= 2) qcount2
						FROM test_subject_tests t
						LEFT JOIN test_subjects s ON s.id = t.subject";
	$sql->query($query);
	$Tests = $sql->fetchAll();

	$smarty->assign(array(
	'Tests'	=> $Tests,
	'Subjects'	=> $Subjects,
	'Languages'	=> $Languages,
	));
		
	$smarty->assign(array(
		'PageIcon'		=> "groups.png",
		));
	break;

	case "import":
		$PageTitle = $Dict['import_tests'];
		$FileName = "";

		if (isset($_POST['SubTestFromText']))
		{
			$Question = 0;
			$Ans = 0;
			$LessonId = 0;
			$QuestionId = 0;
			$QuestionLang = $_POST['qlang'];
			$Error = array();
			foreach ($_POST['StringType'] as $sid => $sval)
			{
				switch ($sval)
				{
					case "1":
						$Question++;
						$Ans=0;
						$TestId = $_POST['testid'];
						$QuestionText = str_replace("\'","`",$_POST['TestVals'][$sid]);
						$query  = "INSERT into test_questions (testid, theme, question, degree, active, language) ";
						$query .= "VALUES";
						$query .= " (".MyPiDeCrypt($TestId).", 0, '".$QuestionText."', 3, 1, ".$QuestionLang.")";

						if ($sql->query($query))
						{
							$query = "SELECT LAST_INSERT_ID() last_id";
							$sql->query($query);
							$result = $sql->fetchAssoc();

							$QuestionId = $result['last_id'];
						}
						else
						{
							$sql->error();
							$Error[] = $sql->error();
						}
						break;
						
					case "2":
						$Ans++;
						$Answer = explode('|', $_POST['TrueAnswer'][$Question]);
						$AnswerText = str_replace("\'","`", $_POST['TestVals'][$sid]);
						$TrueAnswer = ($Question == $Answer[0] && $Ans == $Answer[1]) ? 1 : 0;
						$query = "INSERT INTO test_answers (testid, theme, question, answer, degree, istrue)
						VALUES (".MyPiDeCrypt($TestId).", 0, ".$QuestionId.",'".$AnswerText."', 0, ".$TrueAnswer.")";
						
						if (!$sql->query($query))
						{
							$sql->error();
							$Error[] = $sql->error();
						}
						break;

					case "3":
						//$LessonId = $_POST['LessonId'][$sid];
						break;

					case "4":
						break;
				}
			}
			if (count($Error) == 0)
			{
				header('Location: tasks.php');
			}
		}

		if (isset($_POST['SubForm']))
		{
			if (strlen(trim($_POST['theText'])) > 0)
			{
				$MyArr = explode("<br />",nl2br($_POST['theText']));
				$newArr = array();
				$KeyName = 0;
				$ValueName = 0;
				foreach ($MyArr as $id => $val)
				{
					$TrimedString = trim($val);
					if (strpos("_".$TrimedString,"??????? #") == 1)
					{
						$TrimedString = "";
					}
					if ((strpos("_".$TrimedString,"??????:")) == 1)
					{
						$TrimedString = "";
					}

					if ((strpos("_".$TrimedString,"???????? ???? ??")) == 1)
					{
						$TrimedString = "";
					}

					if ($TrimedString != "")
					{
						$IsQuestion = strpos(("_".trim($TrimedString)),'.');
						if (is_numeric($IsQuestion) && $IsQuestion < 4)
						{
							$KeyName++;
							$ValueName = 0;
							$theArr['str_is'] = 1;
							$theArr['str'] = trim(substr(strstr($TrimedString,"."),1));
							$newArr[] = $theArr;
						}
						else
						{
							
							$isTrue = strpos(trim("_".$TrimedString),'*');
							$AnsAtr = trim(substr(strstr(trim($TrimedString),"."),1));
							$ValueName++;
							$theArr['str_is'] = 2;
							$theArr['KeyName'] = $KeyName;
							$theArr['ValueName'] = $KeyName."|".$ValueName;
							
							//echo strlen($AnsAtr);
							
							if (trim($AnsAtr) == "")
							{
								$IsAsnwer = strpos(("_".trim($TrimedString)),')');
								if ($IsAsnwer < 4)
								{
									$AnsAtr = trim(substr(strstr(trim($TrimedString),")"),1));
								}
								if (trim($AnsAtr) == "")
								{
									$theArr['str_is'] = 1;
									$AnsAtr = trim($TrimedString);
								}
							}
							else if (strlen($AnsAtr) > 3)
							{
									$AnsAtr = trim(substr(strstr(trim($TrimedString),")"),1));
							}
							
							$theArr['str'] = $AnsAtr;
							$theArr['is_true'] = $isTrue;
							$newArr[] = $theArr;
						}

					}
				}
			}
		$query = "SELECT id, name".$slang." name FROM test_s_lang ORDER BY id";
		$sql->query($query);
		$Languages = $sql->fetchAll();
	
		//print_r($newArr);
		$smarty->assign(array(
			'Tests'	 =>	$newArr,
			'QuestionLang'	 =>	$_POST['qlang'],
			'Languages'	 		 =>	$Languages,
		));
		}
		break;	
		
	case "update": 
		$PageTitle = $Dict['edit'];
		$FileName = "";
		if (isset($_POST['UpdateTestFromText'])) {
			$Question = 0;
			$Ans = 0;
			$LessonId = 0;
			$QuestionId = 0;
			$Error = array();
			foreach ($_POST['StringType'] as $sid => $sval)
			{
				$var = explode('!', $sval);
				$varl = explode('|', $var[2]);
				if ($var[1] == 1) {
					$QuestionText = str_replace("\'", "`", $_POST['TestVals'][$sid]);
					$query = "UPDATE test_questions SET question = '{$QuestionText}' WHERE id = {$var[0]}";
					if (!$sql->query($query))
					{
						$sql->error();
						$Error[] = $sql->error();
					}
				} else {
					$QuestionText = str_replace("\'", "`", $_POST['TestVals'][$sid]);
					$Answer = explode('|', $_POST['TrueAnswer'][$varl[0]]);
					$TrueAnswer = ($varl[0] == $Answer[0] && $varl[1] == $Answer[1]) ? 1 : 0;
					$limit = $varl[1]-1;
					$query = "SELECT id FROM test_answers WHERE question = {$varl[0]} LIMIT 1 OFFSET {$limit}";
					if ($sql->query($query)) {
						$result = $sql->fetchAssoc();
						$query = "UPDATE test_answers SET answer = '{$QuestionText}', istrue = {$TrueAnswer} WHERE id = {$result['id']}";					
						if (!$sql->query($query))
						{
							$sql->error();
							$Error[] = $sql->error();
						}
					}
				}
			}
			if (count($Error) == 0)
			{
				header('Location: tasks.php');
			} else {
				foreach ($Error as $er) {
					echo $er.'<br>';
				}
			}
		}
		else
		{
			$ValueName = 0;
			$QNumber = 1;
			$newArray = array();
			$RowId = MyPiDeCrypt($_GET['id']);

			$QuestionLang = isset($_GET['qlang']) ? $_GET['qlang'] : 1;
			$query = "SELECT * FROM v_test_subjects WHERE id = {$RowId}";
			$sql->query($query);
			$Subject = $sql->fetchAssoc();

			$query = "SELECT * FROM test_questions WHERE testid = {$RowId} and language= {$QuestionLang}";
			$sql->query($query);
			$questions = $sql->fetchAll();

			$query = "SELECT l.id, l.name1 lname, 
								(SELECT COUNT(*) FROM test_questions WHERE testid = {$RowId} AND LANGUAGE= l.id) qcount
								 FROM test_s_lang l";
			$sql->query($query);
			$Languages = $sql->fetchAll();

			foreach ($questions as $value) {
				$ValueName = 0;
				$theArray['questionNumber'] = $QNumber++;
				$theArray['str_is'] = 1;
				$theArray['str'] = $value['question'];
				$theArray['KeyName'] = $value['id'];
				$theArray['idfield'] = $value['id'];
				$theArray['testid'] = $value['testid'];
				$newArray[] = $theArray;
				$sql->query("SELECT * FROM test_answers WHERE testid = {$RowId} AND question = ".$value["id"]);
				$answers = $sql->fetchAll();
				foreach ($answers as $val) {
					$ValueName++;
					$theArray['str_is'] = 2;
					$theArray['idfield'] = $val['id'];
					
					$theArray['ValueName'] = $value['id']."|".$ValueName;
					
					$theArray['str'] = $val['answer'];
					$theArray['is_true'] = $val['istrue'];
					$newArray[] = $theArray;
				}
			}
			//print_r($newArray);
			$smarty->assign(array(
				'Tests' 			=> $newArray,
				'TestsCount' 	=> count($newArray),
				'Subject' 		=> $Subject,
				'RowId' 			=> $RowId,
				'Languages' 	=> $Languages,
				'QuestionLang' 	=> $QuestionLang,
			));
		}
		break;
		
		case "edit":
		$ValueName = 0;
			$QNumber = 1;
			$newArray = array();
			$RowId = MyPiDeCrypt($_GET['testid']);
			$QuestionId = MyPiDeCrypt($_GET['question']);

			if (isset($_POST['UpdateTestFromText']))
			{
				$QuestionId = MyPiDeCrypt($_POST['questionid']);
				$query = "UPDATE test_questions SET question = '".$_POST['QuestionText']."',
									language = ".$_POST['qlang'].",
									theme = ".$_POST['qtheme'].",
									degree = ".$_POST['qlevel']." 
									where id = ".$QuestionId;
				$sql->query($query);

				if (isset($_POST['question_pic']))
				{
					$query = "select count(*) qpcount from test_question_pics where question_id = ".$QuestionId;
					$sql->query($query);
					$QPic = $sql->fetchAssoc();
					if ($QPic['qpcount'] == 0)
					{
						$query = "insert into test_question_pics (question_id, pic_path) value (".$QuestionId.", '".$_POST['question_pic']."')";
						$sql->query($query);
					}
					else
					{
						$query = "update test_question_pics SET pic_path = '".$_POST['question_pic']."' where question_id = ".$QuestionId;
						$sql->query($query);
					}
				}
				$sql->query("SELECT ta.id, (SELECT COUNT(*) FROM test_answer_pics p WHERE p.answer_id = ta.id) apcount
										FROM test_answers ta
										WHERE question =".$QuestionId);
				$Answers = $sql->fetchAll();
				//print_r($Answers);
				
				foreach ($Answers as $id => $val)
				{
					$AnswerText = $_POST['answer'][$val['id']];
					$query = "UPDATE test_answers SET answer = '".$AnswerText."' where id = ".$val['id'];
					$sql->query($query);

					if (isset($_POST['answerpic_'.$val['id']]))
					{
						if ($val['apcount'] == 0)
						{
							$query = "insert into test_answer_pics (answer_id, pic_path) value (".$val['id'].", '".$_POST['answerpic_'.$val['id']]."')";
							$sql->query($query);
						}
						else
						{
							$query = "update test_answer_pics SET pic_path = '".$_POST['answerpic_'.$val['id']]."' where answer_id = ".$val['id'];
							$sql->query($query);
						}
					}
				}
			}
			//die();
			$query = "SELECT * FROM v_test_subjects WHERE id = {$RowId}";
			$sql->query($query);
			$Subject = $sql->fetchAssoc();

			$query = "SELECT tq.*, qp.pic_path
								FROM test_questions tq
								LEFT JOIN test_question_pics qp ON qp.question_id = tq.`id`
								WHERE tq.id ={$QuestionId}";
			$sql->query($query);
			$Question = $sql->fetchAssoc();

			$sql->query("SELECT ta.*, ap.pic_path
								FROM test_answers ta
								LEFT JOIN test_answer_pics ap ON ap.`answer_id` = ta.`id`
								WHERE ta.question = ".$QuestionId);
			$Answers = $sql->fetchAll();

			$query = "SELECT id, name".$slang." name FROM test_s_lang ORDER BY id";
			$sql->query($query);
			$Languages = $sql->fetchAll();
			
			$query = "SELECT id, name{$slang} name FROM test_subject_themes ORDER BY name{$slang}";
			$sql->query($query);
			$Themes = $sql->fetchAll();

			$query = "SELECT id, name{$slang} name FROM `test_question_degree` ORDER BY id";
			$sql->query($query);
			$Levels = $sql->fetchAll();

			//print_r($newArray);
			$smarty->assign(array(
				'Tests' 			=> $newArray,
				'TestsCount' 	=> count($newArray),
				'Subject' 		=> $Subject,
				'RowId' 			=> $RowId,
				'Question'  	=> $Question,
				'Answers'  	=> $Answers,
				'elTRE'  	=> 1,
				'Languages'  	=> $Languages,
				'Themes'  	=> $Themes,
				'Levels'  	=> $Levels,
			));

		break;
}
$smarty->display("tasks.tpl");
?>